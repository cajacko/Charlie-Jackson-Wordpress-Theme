<?php

function cssSelectorCount($html, $selector)
{
    $crawler = new \Symfony\Component\DomCrawler\Crawler($html);
    $crawler = $crawler->filter($selector);
    return count($crawler);
}
