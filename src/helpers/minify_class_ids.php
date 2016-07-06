<?php

function minify_classes()
{

}

function minify_ids()
{

}

function sort_by_length($a, $b)
{
    return strlen($b)-strlen($a);
}

function minify_classes_ids($content)
{

    // var_dump($content); exit;
    $styles = file_get_contents('../public/style.min.css');
    preg_match_all('/(?<=(}|,)\.)[a-zA-Z-]+?(?=(,|\:| |{))/', $styles, $matches);
    $matches = array_unique($matches[0]);

    usort($matches, 'sort_by_length');

    print_r($matches); exit;

    return $content;
}
