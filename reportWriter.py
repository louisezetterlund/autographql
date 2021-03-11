def testPassed(number, statusCode, reportFile):
    reportFile.write('ok ' + str(number) + ' - Response status code is ' + str(statusCode) + '\n')

def testFailed(number, response, reportFile):
    reportFile.write('not ok ' + str(number) + ' - Response status code is ' + str(response.status_code) + '\n')
    reportFile.write('\t---\n')
    reportFile.write('\tmessage: \'' + response.reason + '\'\n')
    reportFile.write('\tseverity: fail\n')
    reportFile.write('\t---\n')


def summary(failedTests, amountOfTests, reportFile):

    if len(failedTests) > 0:
        reportFile.write('\nFAILED tests ')
        for test in failedTests[:-1]:
            reportFile.write(str(test) + ', ')
        reportFile.write(str(failedTests[-1]) + '\n')

    reportFile.write('Failed ' + str(len(failedTests)) + '/' + str(amountOfTests) + ' tests, ' + str(
        round(100 * (amountOfTests - len(failedTests)) / amountOfTests, 2)) + '% okay')
