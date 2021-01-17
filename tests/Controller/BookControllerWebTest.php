<?php


namespace Tests\Controller;


use Symfony\Component\HttpFoundation\Response;
use Tests\Controller\ApiTestCase;

class BookControllerWebTest extends ApiTestCase
{
    public function testBookCanBeCreate()
    {
        $this->markTestSkipped('don`t garbage db');
        $this->client->request('POST',
            '/books/create',
            [],
            [],
            [],
            json_encode([
                'name'=>'test book',
                'author' => [333,555,777]
            ], JSON_UNESCAPED_UNICODE)
        );
        $response = $this->client->getResponse();

        $this->assertResponseStatusCodeSame(Response::HTTP_OK, 'Could not create new book');
    }
}