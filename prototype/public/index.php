<?php 

require_once('../../vendor/autoload.php');
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('../');
$twig = new Twig_Environment($loader);
$template = $twig->loadTemplate('layouts/loop.twig');
$content = $template->render(array());
echo $content;
