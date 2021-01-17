<?php


namespace Controller;


use Symfony\Component\HttpFoundation\Response;
use Tests\Controller\ApiTestCase;

class AuthorControllerWebTest extends ApiTestCase
{
    public function testAuthorCanBeCreate()
    {
        $this->markTestSkipped('don`t garbage db');
        $this->client->request('POST',
            '/authors/create',
            [],
            [],
            [],
            json_encode([
                'name'=>'test author'
            ], JSON_UNESCAPED_UNICODE)
        );
        $response = $this->client->getResponse();

        $this->assertResponseStatusCodeSame(Response::HTTP_OK, 'Could not create new author');
    }
}