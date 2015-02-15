<?php

namespace Masterclass\Model;

use Masterclass\Dbal\AbstractDb;
use Masterclass\Entity\StoryCollection;
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

        $storyObj = new StoryCollection();

        foreach($stories as $key => $story) {
            $comment_sql = 'SELECT COUNT(*) as `count` FROM comment WHERE story_id = ?';
            $count = $this->db->fetchOne($comment_sql, [$story['id']]);
            $stories[$key]['comment_count'] = $count['count'];
        }

        foreach($stories as $story) {
            $obj = new \Masterclass\Entity\Story();
            $obj->populate($story);
            $storyObj->addStory($obj);
        }

        return $storyObj;
    }

    /**
     * @param integer $id
     * @return \Masterclass\Entity\Story
     */
    public function getStory($id)
    {
        $story_sql = 'SELECT * FROM story WHERE id = ?';
        $story_data = $this->db->fetchOne($story_sql, [$id]);
        $story = new \Masterclass\Entity\Story();
        $story->populate($story_data);
        return $story;
    }

    public function createNewStory(\Masterclass\Entity\Story $story)
    {
        $sql = 'INSERT INTO story (headline, url, created_by, created_on) VALUES (?, ?, ?, NOW())';
        $data = $story->toArray();
        $this->db->execute($sql, array(
            $data['headline'],
            $data['url'],
            $data['created_by']
        ));

        return $this->getStory($this->db->lastInsertId());
    }
}