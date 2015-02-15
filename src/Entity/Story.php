<?php

namespace Masterclass\Entity;

class Story
{
    protected $id;

    protected $headline;

    protected $url;

    protected $created_by;

    protected $created_on;

    protected $comment_count;

    public function populate(array $args = [])
    {
        foreach ($args as $key => $value) {
            if(property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * @param mixed $headline
     */
    public function setHeadline($headline)
    {
        $this->headline = $headline;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * @param mixed $created_by
     */
    public function setCreatedBy($created_by)
    {
        $this->created_by = $created_by;
    }

    /**
     * @return mixed
     */
    public function getCreatedOn()
    {
        return $this->created_on;
    }

    /**
     * @param mixed $created_on
     */
    public function setCreatedOn($created_on)
    {
        $this->created_on = $created_on;
    }

    /**
     * @return mixed
     */
    public function getCommentCount()
    {
        return $this->comment_count;
    }

    /**
     * @param mixed $comment_count
     */
    public function setCommentCount($comment_count)
    {
        $this->comment_count = $comment_count;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'headline' => $this->headline,
            'url' => $this->url,
            'created_by' => $this->created_by,
            'created_on' => $this->created_on,
        ];
    }


}