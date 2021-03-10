import os
import requests

url = 'http://localhost:8000/graphql/'


for f in os.listdir('queries/'):
    payload = open('queries/'+f).read()
    headers = {'content-type': 'application/json'}
    r = requests.post(url, data=payload, headers=headers)
    print(r.status_code)
