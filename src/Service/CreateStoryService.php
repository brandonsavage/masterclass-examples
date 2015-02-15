<?php

namespace Masterclass\Service;

use Masterclass\Form\FormBase;
use Masterclass\Model\Story;

class CreateStoryService
{
    /**
     * @var Story
     */
    protected $storyModel;

    public function __construct(Story $story)
    {
        $this->storyModel = $story;
    }

    public function createNewStory($headline, $url, $username)
    {
        $story = new \Masterclass\Entity\Story();
        $story->setHeadline($headline);
        $story->setCreatedBy($username);
        $story->setUrl($url);
        return $this->storyModel->createNewStory($story);
    }
}