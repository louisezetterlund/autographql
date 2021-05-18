import os
import requests
import json
import jinja2
import config as cfg
from SchemaSearcher import *
from AstWalker import *
from graphql.parser import GraphQLParser
from CreateAssertions import *
from CreateDictionaries import *

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

searcher = SchemaSearcher(schema)
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

    variables = ['$a', '$b', '$c', '$d', '$e', '$f', '$g']

    try:
        assertions = createAssertions.createAssertions(rootNode[0], variables)
        output = template.render(className=testName, query=jsonPayload, allAssertions=assertions)
        testfile = open('testCases/' + testName + '.php', 'w')
        testfile.write(output)
        testfile.close()
    except:
        continue

