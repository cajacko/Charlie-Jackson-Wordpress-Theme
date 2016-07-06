<?php

// src/public/index.php
namespace CharlieJackson\Config;

class ConfigTest extends \PHPUnit_Framework_TestCase
{
    public function testConfigClassExists()
    {
        $config = new \CharlieJackson\Config\Config;
    }

    /**
     * @depends testConfigClassExists
     */
    public function testGetConfigMethodExists()
    {
        $config = new \CharlieJackson\Config\Config;

        $this->assertTrue(
            method_exists($config, 'getConfig'),
            'Class does not have method getConfig'
        );
    }

    /**
     * @depends testGetConfigMethodExists
     */
    public function testGetConfigReturnsObject()
    {
        $config = new \CharlieJackson\Config\Config;
        $config_json = $config->getConfig();

        $this->assertTrue(is_object($config_json));
    }

    /**
     * @depends testConfigClassExists
     */
    public function testGetPrivateConfigMethodExists()
    {
        $config = new \CharlieJackson\Config\Config;

        $this->assertTrue(
            method_exists($config, 'getPrivateConfig'),
            'Class does not have method getPrivateConfig'
        );
    }

    /**
     * @depends testGetPrivateConfigMethodExists
     */
    public function testGetPrivateConfigReturnsObject()
    {
        $config = new \CharlieJackson\Config\Config;
        $config_json = $config->getPrivateConfig();

        $this->assertTrue(is_object($config_json));
    }

    /**
     * @depends testGetPrivateConfigReturnsObject
     */
    public function testWordpressConfigIsValid()
    {
        $config = new \CharlieJackson\Config\Config;
        $config_json = $config->getPrivateConfig();

        $this->assertTrue(isset($config_json->wordpress));
        $this->assertTrue(isset($config_json->wordpress->mysql));
        $this->assertTrue(isset($config_json->wordpress->mysql->host));
        $this->assertTrue(isset($config_json->wordpress->mysql->user));
        $this->assertTrue(isset($config_json->wordpress->mysql->password));
        $this->assertTrue(isset($config_json->wordpress->mysql->database));
    }
}
