<?php

namespace CharlieJackson\Wordpress;

class WordpressTest extends \PHPUnit_Framework_TestCase
{
    private $config;

    public function setUp()
    {
        $this->config = new \CharlieJackson\Config\Config;
    }

    public function testWordpressClassExists()
    {
        $wordpress = new \CharlieJackson\Wordpress\Wordpress($this->config);
    }

    /**
     * @depends testWordpressClassExists
     */
    public function testWordpressGetConnectionStatusExists()
    {
        $wordpress = new \CharlieJackson\Wordpress\Wordpress($this->config);

        $this->assertTrue(
            method_exists($wordpress, 'getConnectionStatus'),
            'Class does not have method getConnectionStatus'
        );
    }

    /**
     * @depends testWordpressGetConnectionStatusExists
     */
    public function testWordpressGetConnectionStatusTrue()
    {
        $wordpress = new \CharlieJackson\Wordpress\Wordpress($this->config);
        $this->assertTrue($wordpress->getConnectionStatus());
    }

    /**
     * @depends testWordpressClassExists
     */
    public function testWordpressGetAllPostsMethodExists()
    {
        $wordpress = new \CharlieJackson\Wordpress\Wordpress($this->config);

        $this->assertTrue(
            method_exists($wordpress, 'getAllPosts'),
            'Class does not have method getAllPosts'
        );
    }

    /**
     * @depends testWordpressGetAllPostsMethodExists
     */
    public function testWordpressGetallPostsIsArray()
    {
        $wordpress = new \CharlieJackson\Wordpress\Wordpress($this->config);
        $this->assertTrue(is_array($wordpress->getAllPosts()));
    }
}
