import graphql
from CodeNode import *
class AstWalker:

    def __init__(self, searcher):
        self.searcher = searcher

    def walk(self, node, daddyObject='Query'):
        codeNodes = []
        if node.selections:
            for child in node.selections:
                if child.name == '__typename':
                    continue
                if type(node) == graphql.ast.Query:
                    nodesToBe = self.searcher.getTypes('Query', child.name)
                else:
                    nodesToBe = self.searcher.getTypes(daddyObject, child.name)
                unconnectedNodes = []

                if nodesToBe != None:
                    for object in nodesToBe:
                        objectNode = CodeNode(object['name'], object['kind'], object['type'], object['non_null'])
                        unconnectedNodes.append(objectNode)

                    if len(unconnectedNodes) > 2:
                        for i in range(0,len(unconnectedNodes)-1):
                            unconnectedNodes[i].addChild(unconnectedNodes[i+1])
                    elif len(unconnectedNodes) == 2:
                        unconnectedNodes[0].addChild(unconnectedNodes[1])

                    nextNode = unconnectedNodes[len(unconnectedNodes)-1]
                    codeNode = unconnectedNodes[0]
                    codeNodes.append(codeNode)

                    childNodes = AstWalker.walk(self, child, nextNode.type)
                    for c in childNodes:
                        nextNode.addChild(c)

        return codeNodes
