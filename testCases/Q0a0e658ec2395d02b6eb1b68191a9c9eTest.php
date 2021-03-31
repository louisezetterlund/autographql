<?php
declare(strict_types=1);

namespace GraphQL;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class Q0a0e658ec2395d02b6eb1b68191a9c9eTest extends WebTestCase
{

    /**
     * @runInSeparateProcess
     */
    public function testFoo()
    {
        $client = static::createClient();

        $query = <<<'JSON'
{"query":"query savedSearchResultsQuery($_v0_ids: [String!]) {\n  searchResults(ids: $_v0_ids) {\n    id\n    name\n    url\n    __typename\n    ... on CompanyResultItem {\n      tickerSymbol\n      __typename\n    }\n    ... on EventResultItem {\n      startTime\n      endTime\n      __typename\n    }\n    ... on VideoResultItem {\n      timestamp\n      __typename\n    }\n    ... on ResearchArticleResultItem {\n      timestamp\n      authorName\n      authorTitle\n      type\n      __typename\n    }\n  }\n}\n","variables":{"_v0_ids":["64652d62-3099-3909-b984-3889c9af065a"]},"operationName":"savedSearchResultsQuery"}
JSON;

        $client->request('POST', '/graphql/', [], [], ["CONTENT_TYPE" => 'application/json'], $query);
        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());

        $responseArray = json_decode($response->getContent(), true);

        $this->assertIsArray($responseArray, 'Response is not valid JSON');

        $this->assertArrayNotHasKey('errors', $responseArray, 'Response contains errors');

        $responseContent = $responseArray['data'];


        
        $this->assertArrayHasKey('searchResults', $responseContent);
        
        if ($responseContent['searchResults']) {
        
        $this->assertIsArray($responseContent['searchResults']);
        
        for($g = 0; $g < count($responseContent['searchResults']); $g++) {
        
        if ($responseContent['searchResults'][$g]) {
        
        $this->assertContains($responseContent['searchResults'][$g]['__typename'], ['CompanyResultItem', 'EventResultItem', 'VideoResultItem', 'ResearchArticleResultItem']);
        
        $this->assertArrayHasKey('id', $responseContent['searchResults'][$g]);
        
        $this->assertNotNull($responseContent['searchResults'][$g]['id']);
        
        $this->assertIsString($responseContent['searchResults'][$g]['id']);
        
        $this->assertArrayHasKey('name', $responseContent['searchResults'][$g]);
        
        $this->assertNotNull($responseContent['searchResults'][$g]['name']);
        
        $this->assertIsString($responseContent['searchResults'][$g]['name']);
        
        $this->assertArrayHasKey('url', $responseContent['searchResults'][$g]);
        
        if ($responseContent['searchResults'][$g]['url']) {
        
        $this->assertIsString($responseContent['searchResults'][$g]['url']);
        
        }
        
        if ($responseContent['searchResults'][$g]['__typename'] == 'CompanyResultItem') {
        
        $this->assertArrayHasKey('tickerSymbol', $responseContent['searchResults'][$g]);
        
        if ($responseContent['searchResults'][$g]['tickerSymbol']) {
        
        $this->assertIsString($responseContent['searchResults'][$g]['tickerSymbol']);
        
        }
        
        }
        
        if ($responseContent['searchResults'][$g]['__typename'] == 'EventResultItem') {
        
        $this->assertArrayHasKey('startTime', $responseContent['searchResults'][$g]);
        
        $this->assertNotNull($responseContent['searchResults'][$g]['startTime']);
        
        $this->assertIsString($responseContent['searchResults'][$g]['startTime']);
        
        $this->assertArrayHasKey('endTime', $responseContent['searchResults'][$g]);
        
        $this->assertNotNull($responseContent['searchResults'][$g]['endTime']);
        
        $this->assertIsString($responseContent['searchResults'][$g]['endTime']);
        
        }
        
        if ($responseContent['searchResults'][$g]['__typename'] == 'VideoResultItem') {
        
        $this->assertArrayHasKey('timestamp', $responseContent['searchResults'][$g]);
        
        $this->assertNotNull($responseContent['searchResults'][$g]['timestamp']);
        
        $this->assertIsString($responseContent['searchResults'][$g]['timestamp']);
        
        }
        
        if ($responseContent['searchResults'][$g]['__typename'] == 'ResearchArticleResultItem') {
        
        $this->assertArrayHasKey('timestamp', $responseContent['searchResults'][$g]);
        
        $this->assertNotNull($responseContent['searchResults'][$g]['timestamp']);
        
        $this->assertIsString($responseContent['searchResults'][$g]['timestamp']);
        
        $this->assertArrayHasKey('authorName', $responseContent['searchResults'][$g]);
        
        $this->assertNotNull($responseContent['searchResults'][$g]['authorName']);
        
        $this->assertIsString($responseContent['searchResults'][$g]['authorName']);
        
        $this->assertArrayHasKey('authorTitle', $responseContent['searchResults'][$g]);
        
        $this->assertNotNull($responseContent['searchResults'][$g]['authorTitle']);
        
        $this->assertIsString($responseContent['searchResults'][$g]['authorTitle']);
        
        $this->assertArrayHasKey('type', $responseContent['searchResults'][$g]);
        
        $this->assertNotNull($responseContent['searchResults'][$g]['type']);
        
        $this->assertContains($responseContent['searchResults'][$g]['type'], ['INITIATION_COVERAGE', 'RESEARCH_UPDATE', 'RESEARCH_NOTE', 'PREMIUM_NEWS', 'THEME_REPORT', 'INTERVIEW', 'PORTFOLIO_UPDATE', 'PREMIUM_INTERVIEW', 'BUSINESS_COLUMN', 'PREMIUM_INSIGHT', 'ALTERNATIVE_PICK', 'FEATURED_ARTICLE']);
        
        }
        
        }
        
        }
        
        }
        

    }
}