<?php

namespace CharlieJackson\Database;

class Database
{
    private $config;
    private $mysql;
    private $mysql_info;
    private $attempted_connection;
    private $connection_status;

    public function __construct($config)
    {
        $this->config = $config;
        $this->getMySQLConfig();
        $this->attempted_connection = false;
    }

    public function getMySQLConfig()
    {
        if (!isset($this->config->getPrivateConfig()->mysql)) {
            $this->mysql_info = false;
        }

        $this->mysql_info = $this->config->getPrivateConfig()->mysql;
    }

    public function connect()
    {
        $this->attempted_connection = true;

        $this->mysql = new \mysqli(
            $this->mysql_info->host,
            $this->mysql_info->user,
            $this->mysql_info->password,
            $this->mysql_info->database
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

    public function insertPosts($posts)
    {
        if (!$this->attempted_connection) {
            $this->connect();
        }

        if (!$this->connection_status) {
            return false;
        }

        foreach ($posts as $post) {
            $type_id = $this->doesTypeExist($post['type']);

            if (!$type_id) {
                $type_id = $this->insertType($post['type']);
            }

            if (!$type_id) {
                return false;
            }

            $post_id = $this->doesPostExist($post['UID'], $type_id);

            if (!$post_id) {
                $post_id = $this->insertPost($post['UID'], $type_id);
            }

            if (!$post_id) {
                return false;
            }

            $response = $this->deletePostMeta($post_id);

            if (!$response) {
                return false;
            }

            foreach ($post['meta'] as $meta) {
                $meta = $this->insertMeta($post_id, $meta['key'], $meta['value']);

                if (!$meta) {
                    return false;
                }
            }
        }
    }

    public function deletePostMeta($post_id)
    {
        $query = '
            DELETE FROM postMeta
            WHERE postID = ?
        ;';

        $stmt = $this->mysql->prepare($query);
        $stmt->bind_param("i", $post_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function insertMeta($post_id, $key, $value)
    {
        $query = '
            INSERT INTO postMeta (postID, metaKey, metaValue, dateAdded, dateUpdated)
            VALUES (?, ?, ?, NOW(), NOW())
        ;';

        $stmt = $this->mysql->prepare($query);
        $stmt->bind_param("iss", $post_id, $key, $value);
        $stmt->execute();

        if ($stmt && $stmt->insert_id) {
            return $stmt->insert_id;
        } else {
            return false;
        }
    }

    public function insertPost($UID, $type_id)
    {
        $query = '
            INSERT INTO posts (UID, typeID, dateAdded, dateUpdated)
            VALUES (?, ?, NOW(), NOW())
        ;';

        $stmt = $this->mysql->prepare($query);
        $stmt->bind_param("si", $UID, $type_id);
        $stmt->execute();

        if ($stmt && $stmt->insert_id) {
            return $stmt->insert_id;
        } else {
            return false;
        }
    }

    public function doesPostExist($UID, $type_id)
    {
        $query = '
            SELECT * 
            FROM posts
            WHERE UID = ? AND typeID = ?
        ;';

        $stmt = $this->mysql->prepare($query);
        $stmt->bind_param("si", $UID, $type_id);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows) {
            $row = $res->fetch_assoc();
            return $row['postID'];
        } else {
            return false;
        }
    }

    public function insertType($type)
    {
        $query = '
            INSERT INTO types (type, dateAdded, dateUpdated)
            VALUES (?, NOW(), NOW())
        ;';

        $stmt = $this->mysql->prepare($query);
        $stmt->bind_param("s", $type);
        $stmt->execute();

        if ($stmt && $stmt->insert_id) {
            return $stmt->insert_id;
        } else {
            return false;
        }
    }

    public function doesTypeExist($type)
    {
        $query = '
            SELECT * 
            FROM types
            WHERE type = ? 
        ;';

        $stmt = $this->mysql->prepare($query);
        $stmt->bind_param("s", $type);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows) {
            $row = $res->fetch_assoc();
            return $row['typeID'];
        } else {
            return false;
        }
    }
}
