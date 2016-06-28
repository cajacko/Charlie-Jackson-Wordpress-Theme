<?php 

require_once('../../vendor/autoload.php');
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('../');
$twig = new Twig_Environment($loader);
$template = $twig->loadTemplate('layouts/loop.twig');

// $tweets = file_get_contents('../data/twitter-user-profile.json');
// $tweets = json_decode($tweets, true);

// switch (json_last_error()) {
//     case JSON_ERROR_NONE:
//         echo ' - No errors';
//     break;
//     case JSON_ERROR_DEPTH:
//         echo ' - Maximum stack depth exceeded';
//     break;
//     case JSON_ERROR_STATE_MISMATCH:
//         echo ' - Underflow or the modes mismatch';
//     break;
//     case JSON_ERROR_CTRL_CHAR:
//         echo ' - Unexpected control character found';
//     break;
//     case JSON_ERROR_SYNTAX:
//         echo ' - Syntax error, malformed JSON';
//     break;
//     case JSON_ERROR_UTF8:
//         echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
//     break;
//     default:
//         echo ' - Unknown error';
//     break;
// }

// echo PHP_EOL;

// // var_dump($tweets); exit;
// exit;



$content = $template->render(array());
echo $content;
