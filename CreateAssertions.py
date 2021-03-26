from assertionDictionary import assertionDict
class CreateAssertions:

    def createAssertions(self, node, listWithVariables, path='', listWithAssertions=[], newName = None):

        type = node.type
        kind = node.kind
        name = node.name
        non_null = node.non_null
        if newName != None:
            myPath = "[" + newName + "]"
            name = newName
        else:
            myPath = "['" + name + "']"
            listWithAssertions.append("$this->assertArrayHasKey('" + name + "', $responseContent" + path + ');' )

        if non_null:
            listWithAssertions.append("$this->assertNotNull($responseContent"+ path + myPath+');')
            if type in assertionDict:
                listWithAssertions.append("$this->" + assertionDict[type] + "($responseContent" + path + myPath + ');')
            if kind in assertionDict:
                listWithAssertions.append("$this->" + assertionDict[kind] + "($responseContent" + path + myPath + ');')
            if kind == 'LIST':
                variabel = listWithVariables.pop()
                listWithAssertions.append(
                    "for(" + variabel + " = 0; " + variabel + " < count($responseContent" + path + myPath + "); " + variabel + "++) {")
                if node.children != []:
                    for child in node.children:
                        listWithAssertions = CreateAssertions.createAssertions(self, child, listWithVariables,
                                                                               path + myPath, listWithAssertions,
                                                                               variabel)
                listWithAssertions.append('}')
                listWithVariables.append(variabel)
            else:
                if node.children != []:
                    for child in node.children:
                        listWithAssertions = CreateAssertions.createAssertions(self, child, listWithVariables,
                                                                               path + myPath, listWithAssertions)
        else:
            listWithAssertions.append("if ($responseContent" + path + myPath + ') {')
            if type in assertionDict:
                listWithAssertions.append("$this->"+ assertionDict[type] + "($responseContent" + path + myPath + ');')
            if kind in assertionDict:
                listWithAssertions.append("$this->"+ assertionDict[kind] + "($responseContent" + path + myPath + ');')
            if kind == 'LIST':
                variabel = listWithVariables.pop()
                listWithAssertions.append("for("+variabel+" = 0; "+variabel+" < count($responseContent"+path+myPath+"); "+variabel+"++) {")
                if node.children != []:
                    for child in node.children:
                        listWithAssertions = CreateAssertions.createAssertions(self, child, listWithVariables, path + myPath, listWithAssertions, variabel)
                listWithAssertions.append('}')
                listWithVariables.append(variabel)
            else:
                if node.children != []:
                    for child in node.children:
                        listWithAssertions = CreateAssertions.createAssertions(self, child,listWithVariables, path + myPath, listWithAssertions)
            listWithAssertions.append('}')

        return listWithAssertions




    def printTree(self, node):

        print('Name of this node: ' + node.name if node.name != None else ' Type of this node: ' + node.type)
        print('Children of this node: ')
        for ch in node.children:
            print(ch.name if ch.name != None else ch.type)
        for child in node.children:
            CreateAssertions.printTree(self, child)