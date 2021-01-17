<?php


namespace Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\AbstractBrowser;

class ApiTestCase extends WebTestCase
{
    protected AbstractBrowser $client;

    public function setUp(): void
    {
        parent::setUp();
        $this->client = self::createClient();
    }
}