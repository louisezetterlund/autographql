import os
import requests
from reportWriter import *

url = 'http://localhost:8000/graphql/'

numberOfTests = len([name for name in os.listdir('queries/')])

report = open('testReport.txt', 'w')
report.write('1..' + str(numberOfTests) + '\n')
testNumber = 1
failedTests = []
for f in os.listdir('queries/'):
    payload = open('queries/'+f).read()
    headers = {'content-type': 'application/json'}
    response = requests.post(url, data=payload, headers=headers)
    if response.ok:
        testPassed(testNumber, response.status_code, report)
    else:
        testFailed(testNumber, response, report)
        failedTests.append(testNumber)
    testNumber+=1

summary(failedTests, numberOfTests, report)
report.close()