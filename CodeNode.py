class CodeNode:

    def __init__(self, name, kind, type, non_null):
        self.name = name
        self.kind = kind
        self.type = type
        self.non_null = non_null
        self.children = []

    def addChild(self, child):
        self.children.append(child)