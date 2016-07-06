<?php

namespace CharlieJackson\Wordpress;

class Wordpress
{
    private $config;
    private $mysql;
    private $wordpress_config;
    private $attempted_connection;
    private $connection_status;

    public function __construct($config)
    {
        $this->config = $config;
        $this->getWordpressConfig();
        $this->attempted_connection = false;
    }

    public function getWordpressConfig()
    {
        if (!isset($this->config->getPrivateConfig()->wordpress)) {
            $this->wordpress_config = false;
        }

        $this->wordpress_config = $this->config->getPrivateConfig()->wordpress;
    }

    public function connect()
    {
        $this->attempted_connection = true;

        $this->mysql = new \mysqli(
            $this->wordpress_config->mysql->host,
            $this->wordpress_config->mysql->user,
            $this->wordpress_config->mysql->password,
            $this->wordpress_config->mysql->database
        );

        $this->mysql->set_charset('utf8mb4');

        if ($this->mysql->connect_error) {
            $this->connection_status = false;
        } else {
            $this->connection_status = true;
        }
    }

    public function getConnectionStatus()
    {
        if (!$this->attempted_connection) {
            $this->connect();
        }

        return $this->connection_status;
    }

    public function getPostMeta($post_id)
    {
        $query = '
            SELECT *
            FROM wp_postmeta
            WHERE post_id = ?
        ';

        $stmt = $this->mysql->prepare($query);
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        $res = $stmt->get_result();
        $post_meta = array();

        while ($meta = $res->fetch_assoc()) {
            $post_meta[] = array('key' => $meta['meta_key'], 'value' => $meta['meta_value']);
        }

        return $post_meta;
    }

    public function getPostTerms($post_id)
    {
        $query = '
            SELECT b.taxonomy, c.name, c.slug
            FROM wp_term_relationships as a
            INNER JOIN wp_term_taxonomy as b
            ON a.term_taxonomy_id = b.term_taxonomy_id
            INNER JOIN wp_terms as c
            ON c.term_id = b.term_id
            WHERE a.object_id = ?
        ';

        $stmt = $this->mysql->prepare($query);
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        $res = $stmt->get_result();
        $post_meta = array();

        while ($meta = $res->fetch_assoc()) {
            $post_meta[] = array(
                'term' => $meta['name'],
                'type' => 'wordpress_' . $meta['taxonomy'],
                'slug' => $meta['slug']
            );
        }

        return $post_meta;
    }

    public function getAllPosts()
    {
        if (!$this->attempted_connection) {
            $this->connect();
        }

        if (!$this->connection_status) {
            return false;
        }

        $query = '
            SELECT *
            FROM wp_posts 
            WHERE post_type = "post" AND post_status = "publish"
            ORDER BY post_date DESC
        ';

        $stmt = $this->mysql->prepare($query);
        $stmt->execute();
        $res = $stmt->get_result();
        $posts = array();

        while ($post = $res->fetch_assoc()) {
            $meta = $this->getPostMeta($post['ID']);

            $meta[] = array('key' => 'date_published', 'value' => $post['post_date']);
            $meta[] = array('key' => 'content', 'value' => $post['post_content']);
            $meta[] = array('key' => 'title', 'value' => $post['post_title']);
            $meta[] = array('key' => 'excerpt', 'value' => $post['post_excerpt']);
            $meta[] = array('key' => 'status', 'value' => $post['post_status']);
            $meta[] = array('key' => 'slug', 'value' => $post['post_name']);
            $meta[] = array('key' => 'date_updated', 'value' => $post['post_modified']);
            $meta[] = array('key' => 'type', 'value' => $post['post_type']);

            $terms = $this->getPostTerms($post['ID']);

            $array = array(
                'UID' => $post['ID'],
                'type' => 'wordpress',
                'meta' => $meta,
                'terms' => $terms,
            );

            $posts[] = $array;
        }
        
        return $posts;
    }
}
