<?php
declare(strict_types=1);

namespace GraphQL;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class Q0a0f1c082d135f158df5f7ca25ff6a07Test extends WebTestCase
{

    /**
     * @runInSeparateProcess
     */
    public function testFoo()
    {
        $client = static::createClient();

        $query = <<<'JSON'
{"query":"query searchPageQuery($_v0_query: String!, $_v1_page: Int) {\n  search(query: $_v0_query, page: $_v1_page) {\n    totalResults\n    query\n    resultItems {\n      id\n      name\n      url\n      __typename\n      ... on CompanyResultItem {\n        tickerSymbol\n        __typename\n      }\n      ... on EventResultItem {\n        startTime\n        endTime\n        __typename\n      }\n      ... on VideoResultItem {\n        timestamp\n        __typename\n      }\n      ... on ResearchArticleResultItem {\n        timestamp\n        authorName\n        authorTitle\n        type\n        __typename\n      }\n    }\n    __typename\n  }\n}\n","variables":{"_v1_page":1,"_v0_query":"Fs"},"operationName":"searchPageQuery"}
JSON;

        $client->request('POST', '/graphql/', [], [], ["CONTENT_TYPE" => 'application/json'], $query);
        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());

        $responseArray = json_decode($response->getContent(), true);

        $this->assertIsArray($responseArray, 'Response is not valid JSON');

        $this->assertArrayNotHasKey('errors', $responseArray, 'Response contains errors');

        $responseContent = $responseArray['data'];


        
        $this->assertArrayHasKey('search', $responseContent);
        
        if ($responseContent['search']) {
        
        $this->assertEquals('SearchResults' , $responseContent['search']['__typename']);
        
        $this->assertArrayHasKey('totalResults', $responseContent['search']);
        
        $this->assertNotNull($responseContent['search']['totalResults']);
        
        $this->assertIsInt($responseContent['search']['totalResults']);
        
        $this->assertArrayHasKey('query', $responseContent['search']);
        
        $this->assertNotNull($responseContent['search']['query']);
        
        $this->assertIsString($responseContent['search']['query']);
        
        $this->assertArrayHasKey('resultItems', $responseContent['search']);
        
        $this->assertNotNull($responseContent['search']['resultItems']);
        
        $this->assertIsArray($responseContent['search']['resultItems']);
        
        for($g = 0; $g < count($responseContent['search']['resultItems']); $g++) {
        
        $this->assertNotNull($responseContent['search']['resultItems'][$g]);
        
        $this->assertContains($responseContent['search']['resultItems'][$g]['__typename'], ['CompanyResultItem', 'EventResultItem', 'VideoResultItem', 'ResearchArticleResultItem']);
        
        $this->assertArrayHasKey('id', $responseContent['search']['resultItems'][$g]);
        
        $this->assertNotNull($responseContent['search']['resultItems'][$g]['id']);
        
        $this->assertIsString($responseContent['search']['resultItems'][$g]['id']);
        
        $this->assertArrayHasKey('name', $responseContent['search']['resultItems'][$g]);
        
        $this->assertNotNull($responseContent['search']['resultItems'][$g]['name']);
        
        $this->assertIsString($responseContent['search']['resultItems'][$g]['name']);
        
        $this->assertArrayHasKey('url', $responseContent['search']['resultItems'][$g]);
        
        if ($responseContent['search']['resultItems'][$g]['url']) {
        
        $this->assertIsString($responseContent['search']['resultItems'][$g]['url']);
        
        }
        
        if ($responseContent['search']['resultItems'][$g]['__typename'] == 'CompanyResultItem') {
        
        $this->assertArrayHasKey('tickerSymbol', $responseContent['search']['resultItems'][$g]);
        
        if ($responseContent['search']['resultItems'][$g]['tickerSymbol']) {
        
        $this->assertIsString($responseContent['search']['resultItems'][$g]['tickerSymbol']);
        
        }
        
        }
        
        if ($responseContent['search']['resultItems'][$g]['__typename'] == 'EventResultItem') {
        
        $this->assertArrayHasKey('startTime', $responseContent['search']['resultItems'][$g]);
        
        $this->assertNotNull($responseContent['search']['resultItems'][$g]['startTime']);
        
        $this->assertIsString($responseContent['search']['resultItems'][$g]['startTime']);
        
        $this->assertArrayHasKey('endTime', $responseContent['search']['resultItems'][$g]);
        
        $this->assertNotNull($responseContent['search']['resultItems'][$g]['endTime']);
        
        $this->assertIsString($responseContent['search']['resultItems'][$g]['endTime']);
        
        }
        
        if ($responseContent['search']['resultItems'][$g]['__typename'] == 'VideoResultItem') {
        
        $this->assertArrayHasKey('timestamp', $responseContent['search']['resultItems'][$g]);
        
        $this->assertNotNull($responseContent['search']['resultItems'][$g]['timestamp']);
        
        $this->assertIsString($responseContent['search']['resultItems'][$g]['timestamp']);
        
        }
        
        if ($responseContent['search']['resultItems'][$g]['__typename'] == 'ResearchArticleResultItem') {
        
        $this->assertArrayHasKey('timestamp', $responseContent['search']['resultItems'][$g]);
        
        $this->assertNotNull($responseContent['search']['resultItems'][$g]['timestamp']);
        
        $this->assertIsString($responseContent['search']['resultItems'][$g]['timestamp']);
        
        $this->assertArrayHasKey('authorName', $responseContent['search']['resultItems'][$g]);
        
        $this->assertNotNull($responseContent['search']['resultItems'][$g]['authorName']);
        
        $this->assertIsString($responseContent['search']['resultItems'][$g]['authorName']);
        
        $this->assertArrayHasKey('authorTitle', $responseContent['search']['resultItems'][$g]);
        
        $this->assertNotNull($responseContent['search']['resultItems'][$g]['authorTitle']);
        
        $this->assertIsString($responseContent['search']['resultItems'][$g]['authorTitle']);
        
        $this->assertArrayHasKey('type', $responseContent['search']['resultItems'][$g]);
        
        $this->assertNotNull($responseContent['search']['resultItems'][$g]['type']);
        
        $this->assertContains($responseContent['search']['resultItems'][$g]['type'], ['INITIATION_COVERAGE', 'RESEARCH_UPDATE', 'RESEARCH_NOTE', 'PREMIUM_NEWS', 'THEME_REPORT', 'INTERVIEW', 'PORTFOLIO_UPDATE', 'PREMIUM_INTERVIEW', 'BUSINESS_COLUMN', 'PREMIUM_INSIGHT', 'ALTERNATIVE_PICK', 'FEATURED_ARTICLE']);
        
        }
        
        }
        
        }
        

    }
}