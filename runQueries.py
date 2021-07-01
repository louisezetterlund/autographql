import os
import requests
import json
import jinja2
import config as cfg
import sys
import csv
from SchemaSearcher import *
from AstWalker import *
from graphql.parser import GraphQLParser
from CreateAssertions import *
from CreateDictionaries import *

def main():

    moreDetails = False

    if len(sys.argv) > 1 and sys.argv[1] == 'True':
        moreDetails = True
        print("You have chosen to get some more details of your schema coverage. This will be provided in a file in root "
              "called 'individualSchemaCoverage.csv'. The overview of the covered schema will be printed to a file "
              "called 'schemaCoverageDictionary.csv'.")
        with open('individualSchemaCoverage.csv', 'w') as csvfile:
            csvwriter = csv.writer(csvfile)
            csvwriter.writerow(['Testid','Individual coverage'])


    templateLoader = jinja2.FileSystemLoader(searchpath="")
    templateEnv = jinja2.Environment(loader=templateLoader)
    template = templateEnv.get_template(cfg.test_template)

    parser = GraphQLParser()
    encoder = json.JSONEncoder()

    types = requests.get(cfg.graphql_url, data=encoder.encode(cfg.schema_query),
                         headers={'content-type': 'application/json'})

    schema = json.loads(types.content)['data']['__schema']

    createDict = CreateDictionaries(schema)
    possValuesDict = createDict.possibleValuesDictionary()
    schemaCoverageDict = createDict.schemaCoverageDictionary()

    searcher = SchemaSearcher(schema, schemaCoverageDict)
    walker = AstWalker(searcher)
    createAssertions = CreateAssertions(possValuesDict)

    for f in os.listdir('queries/'):
        id = f.split('.json')[0]
        testName = 'Q' + ''.join(id.split('-')) + 'Test'

        payload = open('queries/' + f).read()
        jsonPayload = "<<<'JSON'\n" + payload + "\nJSON"

        dict = json.loads(payload)

        try:
            astree = parser.parse(dict['query'])
        except:
            print('Something is wrong with test ' + id)
            continue

        # Dubbelkolla så definitions[0] är typ Query
        if not type(astree.definitions[0]) == graphql.ast.Query:
            continue

        rootNode = walker.walk(astree.definitions[0], None)

        if moreDetails:
            createSchemaDict = CreateDictionaries(schema)
            individualSchemaCoverageDict = createSchemaDict.schemaCoverageDictionary()
            schemaSearcher = SchemaSearcher(schema, individualSchemaCoverageDict)
            schemaWalker = AstWalker(schemaSearcher)
            schemaWalker.walk(astree.definitions[0], None)
            with open('individualSchemaCoverage.csv', 'a') as csvfile:
                csvwriter = csv.writer(csvfile)
                csvwriter.writerow([id, schemaSearcher.calculateSchemaCoverage()])


        variables = ['$a', '$b', '$c', '$d', '$e', '$f', '$g']

        try:
            assertions = createAssertions.createAssertions(rootNode[0], variables)
            output = template.render(className=testName, query=jsonPayload, allAssertions=assertions)
            testfile = open('testCases/' + testName + '.php', 'w')
            testfile.write(output)
            testfile.close()
        except:
            continue

    if moreDetails:
        with open('schemaCoverageDictionary.csv', 'w') as csvfile:
            csvwriter = csv.writer(csvfile)
            for line in schemaCoverageDict:
                csvwriter.writerow([line + ': ' + str(schemaCoverageDict[line])])

    print("The schema coverage for the generated test suite is: " + str(searcher.calculateSchemaCoverage()*100) + ' %')

if __name__ == '__main__':
    main()