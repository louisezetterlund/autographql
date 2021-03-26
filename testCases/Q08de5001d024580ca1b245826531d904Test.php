<?php
declare(strict_types=1);

namespace GraphQL;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class Q08de5001d024580ca1b245826531d904Test extends WebTestCase
{
    public function testFoo()
    {
        $client = static::createClient();

        $query = <<<'JSON'
{
  "query": "query GetArticleDisclosures($_v0_uuid: String) {\n  article(uuid: $_v0_uuid) {\n    companies {\n      uuid\n      __typename\n    }\n    companyCompliances {\n      uuid\n      name\n      analysts {\n        firstName\n        lastName\n        isShareholder\n        __typename\n      }\n      compliance {\n        hasActiveRedeyeServices\n        hasRedeyeTransactionInPast12Months\n        hasRedeyeMarketMaker\n        hasRedeyeShareholder\n        __typename\n      }\n      __typename\n    }\n    __typename\n  }\n}\n",
  "variables": {
    "_v0_uuid": "b52edede-251f-3a21-be7c-147a38efaf02"
  },
  "operationName": "GetArticleDisclosures"
}
JSON;

        $client->request('POST', '/graphql/', [], [], ["CONTENT_TYPE" => 'application/json'], $query);
        $response = $client->getResponse();
        $responseContent = json_decode($response->getContent(), true)['data'];

        $this->assertEquals(200, $response->getStatusCode());


        
        $this->assertArrayHasKey('article', $responseContent);
        
        if ($responseContent['article']) {
        
        $this->assertArrayHasKey('companies', $responseContent['article']);
        
        $this->assertNotNull($responseContent['article']['companies']);
        
        $this->assertIsArray($responseContent['article']['companies']);
        
        for($g = 0; $g < count($responseContent['article']['companies']); $g++) {
        
        $this->assertNotNull($responseContent['article']['companies'][$g]);
        
        $this->assertArrayHasKey('uuid', $responseContent['article']['companies'][$g]);
        
        $this->assertNotNull($responseContent['article']['companies'][$g]['uuid']);
        
        $this->assertIsString($responseContent['article']['companies'][$g]['uuid']);
        
        }
        
        $this->assertArrayHasKey('companyCompliances', $responseContent['article']);
        
        $this->assertNotNull($responseContent['article']['companyCompliances']);
        
        $this->assertIsArray($responseContent['article']['companyCompliances']);
        
        for($g = 0; $g < count($responseContent['article']['companyCompliances']); $g++) {
        
        if ($responseContent['article']['companyCompliances'][$g]) {
        
        $this->assertArrayHasKey('uuid', $responseContent['article']['companyCompliances'][$g]);
        
        $this->assertNotNull($responseContent['article']['companyCompliances'][$g]['uuid']);
        
        $this->assertIsString($responseContent['article']['companyCompliances'][$g]['uuid']);
        
        $this->assertArrayHasKey('name', $responseContent['article']['companyCompliances'][$g]);
        
        $this->assertNotNull($responseContent['article']['companyCompliances'][$g]['name']);
        
        $this->assertIsString($responseContent['article']['companyCompliances'][$g]['name']);
        
        $this->assertArrayHasKey('analysts', $responseContent['article']['companyCompliances'][$g]);
        
        $this->assertNotNull($responseContent['article']['companyCompliances'][$g]['analysts']);
        
        $this->assertIsArray($responseContent['article']['companyCompliances'][$g]['analysts']);
        
        for($f = 0; $f < count($responseContent['article']['companyCompliances'][$g]['analysts']); $f++) {
        
        if ($responseContent['article']['companyCompliances'][$g]['analysts'][$f]) {
        
        $this->assertArrayHasKey('firstName', $responseContent['article']['companyCompliances'][$g]['analysts'][$f]);
        
        if ($responseContent['article']['companyCompliances'][$g]['analysts'][$f]['firstName']) {
        
        $this->assertIsString($responseContent['article']['companyCompliances'][$g]['analysts'][$f]['firstName']);
        
        }
        
        $this->assertArrayHasKey('lastName', $responseContent['article']['companyCompliances'][$g]['analysts'][$f]);
        
        if ($responseContent['article']['companyCompliances'][$g]['analysts'][$f]['lastName']) {
        
        $this->assertIsString($responseContent['article']['companyCompliances'][$g]['analysts'][$f]['lastName']);
        
        }
        
        $this->assertArrayHasKey('isShareholder', $responseContent['article']['companyCompliances'][$g]['analysts'][$f]);
        
        $this->assertNotNull($responseContent['article']['companyCompliances'][$g]['analysts'][$f]['isShareholder']);
        
        $this->assertIsBool($responseContent['article']['companyCompliances'][$g]['analysts'][$f]['isShareholder']);
        
        }
        
        }
        
        $this->assertArrayHasKey('compliance', $responseContent['article']['companyCompliances'][$g]);
        
        if ($responseContent['article']['companyCompliances'][$g]['compliance']) {
        
        $this->assertArrayHasKey('hasActiveRedeyeServices', $responseContent['article']['companyCompliances'][$g]['compliance']);
        
        if ($responseContent['article']['companyCompliances'][$g]['compliance']['hasActiveRedeyeServices']) {
        
        $this->assertIsBool($responseContent['article']['companyCompliances'][$g]['compliance']['hasActiveRedeyeServices']);
        
        }
        
        $this->assertArrayHasKey('hasRedeyeTransactionInPast12Months', $responseContent['article']['companyCompliances'][$g]['compliance']);
        
        if ($responseContent['article']['companyCompliances'][$g]['compliance']['hasRedeyeTransactionInPast12Months']) {
        
        $this->assertIsBool($responseContent['article']['companyCompliances'][$g]['compliance']['hasRedeyeTransactionInPast12Months']);
        
        }
        
        $this->assertArrayHasKey('hasRedeyeMarketMaker', $responseContent['article']['companyCompliances'][$g]['compliance']);
        
        if ($responseContent['article']['companyCompliances'][$g]['compliance']['hasRedeyeMarketMaker']) {
        
        $this->assertIsBool($responseContent['article']['companyCompliances'][$g]['compliance']['hasRedeyeMarketMaker']);
        
        }
        
        $this->assertArrayHasKey('hasRedeyeShareholder', $responseContent['article']['companyCompliances'][$g]['compliance']);
        
        if ($responseContent['article']['companyCompliances'][$g]['compliance']['hasRedeyeShareholder']) {
        
        $this->assertIsBool($responseContent['article']['companyCompliances'][$g]['compliance']['hasRedeyeShareholder']);
        
        }
        
        }
        
        }
        
        }
        
        }
        

    }
}