class CreateDictionaries:

    def __init__(self, schema):
        self.schema = schema

    def possibleValuesDictionary(self):
        dictionary = {}
        for type in self.schema['types']:
            if str.lower(type['kind']) == 'interface':
                possibleTypes = []
                for field in type['possibleTypes']:
                    possibleTypes.append(field['name'])
                dictionary[type['name']] = possibleTypes
            elif str.lower(type['kind']) == 'enum':
                possibleTypes = []
                for field in type['enumValues']:
                    possibleTypes.append(field['name'])
                dictionary[type['name']] = possibleTypes
        return dictionary