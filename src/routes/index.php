<?php

$config = new \CharlieJackson\Config\Config;
$config = $config->getConfig();

// Load twig templating engine
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../views/');
$twig = new Twig_Environment($loader);

// Get the template
$template = $twig->loadTemplate('layouts/loop.twig');

// gzip compress the content for optimization
ob_start("ob_gzhandler");

// Render the template
$content = $template->render(array());

echo $content;
