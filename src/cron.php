<?php
set_include_path(__DIR__ . '/..');
require('src/app.php');

$config = new \CharlieJackson\Config\Config;
$wordpress = new \CharlieJackson\Wordpress\Wordpress($config);
$database = new \CharlieJackson\Database\Database($config);

$posts = $wordpress->getAllPosts();
$database->insertPosts($posts);
