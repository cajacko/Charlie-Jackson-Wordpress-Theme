<?php

namespace CharlieJackson\Config;

class Config
{
    private $config;

    public function __construct()
    {
        $this->config = $this->getConfigFile('config.json');
    }

    private function getConfigFile($file)
    {
        $config = file_get_contents($file, true);

        if (!$config) {
            return false;
        }

        $config_object = json_decode($config);

        if (null == $config_object) {
            return false;
        }

        if (!is_object($config_object)) {
            return false;
        }

        return $config_object;
    }

    public function getConfig()
    {
        return $this->config;
    }
}
