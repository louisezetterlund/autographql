<?php
declare(strict_types=1);

namespace GraphQL;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class {{ className }} extends WebTestCase
{
    public function testFoo()
    {
        $client = static::createClient();

        $query = {{ query }};

        $client->request('POST', '/graphql/', [], [], ["CONTENT_TYPE" => 'application/json'], $query);
        $response = $client->getResponse();
        $responseContent = json_decode($response->getContent(), true)['data'];

        $this->assertEquals(200, $response->getStatusCode());


        {% for assertion in allAssertions %}
        {{ assertion }}
        {% endfor %}

    }
}
