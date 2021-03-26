class SchemaSearcher:

    def __init__(self, schema):
        self.schema = schema

    def getTypes(self, objectName, wantedField):
        for type in self.schema['types']:
            if str.lower(type['name']) == str.lower(objectName):
                for field in type['fields']:
                    if str.lower(field['name']) == str.lower(wantedField):
                        groundNode = field
                        nodeList = []
                        # Base case for first node, which is special because it has 'type' and not 'ofType'

                        # Check if next type is NON_NULL, because then we'll iterate twice
                        if field['type']['kind'] == 'NON_NULL':
                            nodeList.append({
                                'name': field['name'],
                                'non_null': True,
                                'kind': field['type']['ofType']['kind'],
                                'type': field['type']['ofType']['name']
                            })
                            # Check if we actually need to iterate any more
                            if field['type']['ofType']['ofType'] == None:
                                return nodeList
                            else:
                                groundNode = field['type']['ofType']['ofType']
                        else:
                            # If next type isn't NON_NULL, then we're done with this node
                            nodeList.append({
                                'name': field['name'],
                                'non_null': False,
                                'kind': field['type']['kind'],
                                'type': field['type']['name']
                            })

                            # Check if we actually need to iterate any more
                            if field['type']['ofType'] == None:
                                return nodeList
                            else:
                                groundNode = field['type']['ofType']

                        # First case done, time to iterate

                        while(groundNode['ofType'] != None):
                            if groundNode['kind'] == 'NON_NULL':
                                nodeList.append({
                                    'name': groundNode['name'],
                                    'non_null': True,
                                    'kind': groundNode['ofType']['kind'],
                                    'type': groundNode['ofType']['name']
                                })
                                if groundNode['ofType']['ofType'] == None:
                                    groundNode = None
                                    break
                                groundNode = groundNode['ofType']['ofType']
                            else:
                                nodeList.append({
                                    'name': groundNode['name'],
                                    'non_null': False,
                                    'kind': groundNode['kind'],
                                    'type': groundNode['name']
                                })
                                groundNode = groundNode['ofType']

                        # Catch the last case
                        if groundNode != None:
                            nodeList.append({
                                        'name': groundNode['name'],
                                        'non_null': False,
                                        'kind': groundNode['kind'],
                                        'type': groundNode['name']
                                    })
                        return nodeList

