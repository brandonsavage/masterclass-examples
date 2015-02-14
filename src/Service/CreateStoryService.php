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
        return (int)$this->storyModel->createNewStory($headline, $url, $username);
    }
}