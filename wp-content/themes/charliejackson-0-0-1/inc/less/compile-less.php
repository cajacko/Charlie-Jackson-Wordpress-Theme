<?php
require 'Less.php';

$actual_link = "http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI];
$link = str_replace("less/compile-less.php", "bootstrap/less", $actual_link);

$parser = new Less_Parser();
$parser->parseFile( '../bootstrap/less/bootstrap.less', $link );
$css = $parser->getCss();

echo $css;

file_put_contents ( '../bootstrap/css/bootstrap.min.css' , $css);

?>