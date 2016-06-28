<?php 

require_once('../../vendor/autoload.php');
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('../');
$twig = new Twig_Environment($loader);
$template = $twig->loadTemplate('layouts/loop.twig');

$posts = array();

$tweets = file_get_contents('../data/twitter-user-profile.json');
$tweets = json_decode($tweets, true);

// print_r($tweets); exit;

function parse_tweet($text){

    //links
    $text = preg_replace(
            '@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@',
             '<a href="$1">$1</a>',
            $text);

    //users
    $text = preg_replace(
            '/@(\w+)/',
            '<a href="http://twitter.com/$1">@$1</a>',
            $text);

    //hashtags
    $text = preg_replace(
            '/\s+#(\w+)/',
            ' <a href="http://search.twitter.com/search?q=%23$1">#$1</a>',
            $text);

    return $text;
}

foreach ($tweets as $tweet) {
    $post = array(
        'type' => 'Tweet',
    );

    if (isset($tweet['in_reply_to_status_id']) && $tweet['in_reply_to_status_id'] != '') {
        break;
    }

    if (isset($tweet['created_at'])) {
        $date = strtotime($tweet['created_at']);
        $date = date('Y-m-d H:i:s', $date);
        $post['date'] = $date;
    }

    if (isset($tweet['text'])) {
        $text = $tweet['text'];
        $text_count = strlen($text);

        if ($text_count > 120) {
            $post['text_count'] = 'Tweet-long';
        } elseif ($text_count > 80) {
            $post['text_count'] = 'Tweet-medium';
        } else {
            $post['text_count'] = 'Tweet-short';
        }

        $post['content'] = parse_tweet($text);
    }

    if (isset($tweet['user']['name'])) {
        $twitter_user_name = $tweet['user']['name'];
        $post['twitter_user_name'] = $twitter_user_name;
    }

    if (isset($tweet['user']['screen_name'])) {
        $twitter_user_screen_name = $tweet['user']['screen_name'];
        $post['twitter_user_screen_name'] = $twitter_user_screen_name;
    }

    if (isset($tweet['user']['profile_image_url'])) {
        $twitter_user_profile_image_url = $tweet['user']['profile_image_url'];
        $post['twitter_user_profile_image_url'] = $twitter_user_profile_image_url;
    }

    if (isset($tweet['extended_entities']['media'])) {
        $count = 0;

        foreach ($tweet['extended_entities']['media'] as $entity) {
            if (isset($entity['media_url'])) {
                $count++;
                $name = 'tweet_image_' . $count;
                $post[$name] = $entity['media_url'];
            }
        }
    }

    if (count($post)) {
        $posts[] = $post;
    }

    // print_r($post);
    // print_r($tweet);
    // exit;
    // break;
}

$icons = array();

$icons['tweet'] = file_get_contents('media/tweet.svg');
$icons['tweet_retweet'] = file_get_contents('media/tweet-retweet.svg');

$content = $template->render(array('posts' => $posts, 'icons' => $icons));
echo $content;
