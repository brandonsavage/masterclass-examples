<?php

namespace Masterclass\Model;

use Masterclass\Dbal\AbstractDb;

class Comment
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
     * @param integer $storyId
     * @return array
     */
    public function getCommentsForStory($storyId)
    {
        $comment_sql = 'SELECT * FROM comment WHERE story_id = ?';
        $comments = $this->db->fetchAll($comment_sql, [$storyId]);
        return $comments;
    }

    /**
     * @param string $username
     * @param integer $storyId
     * @param string $comment
     * @return bool
     */
    public function postNewComment($username, $storyId, $comment)
    {
        $sql = 'INSERT INTO comment (created_by, created_on, story_id, comment) VALUES (?, NOW(), ?, ?)';
        return $this->db->execute($sql, array(
            $username,
            $storyId,
            filter_var($comment, FILTER_SANITIZE_FULL_SPECIAL_CHARS),
        ));
    }
}