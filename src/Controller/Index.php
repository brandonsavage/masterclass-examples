<?php

namespace Masterclass\Controller;

use Aura\View\View;
use Aura\Web\Request;
use Aura\Web\Response;
use Masterclass\Model\Story;

class Index {

    /**
     * @var Story
     */
    protected $model;
    
    public function __construct(
        Story $story
    ) {
        $this->model = $story;
    }
    
    public function index()
    {
        $stories = $this->model->getStoryList();
        return ['stories' => $stories];
    }
}

