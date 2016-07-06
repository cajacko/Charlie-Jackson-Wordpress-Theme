<?php

// src/public/index.php
namespace CharlieJackson\HomePage;

class HomePageTest extends \PHPUnit_Framework_TestCase
{
    private $client;
    private $config;
    private $response;
    private $body;

    public function setUp()
    {
        $config = new \CharlieJackson\Config\Config;
        $this->config = $config->getConfig();

        $this->client = new \GuzzleHttp\Client([
          'allow_redirects' => false,
          'base_uri' => $this->config->localhost,
          'exceptions' => false
        ]);

        $this->response = $this->client->get('/');
        $this->body = $this->response->getBody()->getContents();
    }

    public function testHomePage200Response()
    {
        $this->assertEquals(200, $this->response->getStatusCode());
    }

    /**
     * @depends testHomePage200Response
     */
    public function testHomePageHasNav()
    {
        $count = cssSelectorCount($this->body, '#SiteNavigation');
        $this->assertEquals(1, $count);
    }
}
