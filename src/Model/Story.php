<?php

namespace Masterclass\Model;

use Masterclass\Dbal\AbstractDb;
use PDO;

class Story
{
    /**
     * @var AbstractDb
     */
    protected $db;

    /**
     * @param AbstractDb $db
     */
    public function __construct(AbstractDb $db) {
        $this->db = $db;
    }

    /**
     * @return array
     */
    public function getStoryList()
    {
        $sql = 'SELECT * FROM story ORDER BY created_on DESC';
        $stories = $this->db->fetchAll($sql);

        foreach($stories as $key => $story) {
            $comment_sql = 'SELECT COUNT(*) as `count` FROM comment WHERE story_id = ?';
            $count = $this->db->fetchOne($comment_sql, [$story['id']]);
            $stories[$key]['count'] = $count['count'];
        }

        return $stories;
    }

    /**
     * @param integer $id
     * @return array|bool
     */
    public function getStory($id)
    {
        $story_sql = 'SELECT * FROM story WHERE id = ?';
        return $this->db->fetchOne($story_sql, [$id]);
    }

    public function createNewStory($headline, $url, $creator)
    {
        $sql = 'INSERT INTO story (headline, url, created_by, created_on) VALUES (?, ?, ?, NOW())';
        $this->db->execute($sql, array(
            $headline,
            $url,
            $creator
        ));

        return $this->db->lastInsertId();
    }
}