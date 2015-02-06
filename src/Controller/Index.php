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

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var View
     */
    protected $template;
    
    public function __construct(
        Story $story,
        Request $request,
        Response $response,
        View $view
    ) {
        $this->model = $story;
        $this->response = $response;
        $this->template = $view;
    }
    
    public function index() {

        $stories = $this->model->getStoryList();

        $this->template->setLayout('layout');
        $this->template->setView('index');

        $this->template->setData(['stories' => $stories]);
        $this->response->content->set($this->template->__invoke());
        return $this->response;

    }
}

