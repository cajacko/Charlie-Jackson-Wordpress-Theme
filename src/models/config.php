<?php

namespace CharlieJackson\Config;

class Config
{
    public function getConfig()
    {
        $config = file_get_contents('config.json', true);

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
}
