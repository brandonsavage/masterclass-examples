<?php

namespace Masterclass\Controller;

use Aura\View\View;
use Aura\Web\Request;
use Aura\Web\Response;
use Masterclass\Form\StoryForm;
use Masterclass\Model\Story;
use Masterclass\Service\CreateStoryService;

class CreateStory
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var Story
     */
    protected $story;

    /**
     * @var CreateStoryService
     */
    protected $service;

    /**
     * @var StoryForm
     */
    protected $form;

    /**
     * @var View
     */
    protected $template;

    public function __construct(
        Request $request,
        Response $response,
        Story $story,
        CreateStoryService $service,
        StoryForm $form,
        View $template
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->story = $story;
        $this->service = $service;
        $this->form = $form;
        $this->template = $template;
    }

    public function create() {
        if(!isset($_SESSION['AUTHENTICATED'])) {
            $this->response->redirect->to('/users/login');
            return $this->response;
        }

        $form = $this->form;

        $headline = $this->request->post->get('headline');
        $url = $this->request->post->get('url');

        $result = null;
        $error = null;

        $create = $this->request->post->get('create');
        if($create) {
            $form->populateData($this->request->post->get());
            if($form->isValid()) {
                $id = $this->service->createNewStory($headline, $url, $_SESSION['username']);
                $this->response->redirect->to("/story?id=$id");
                return $this->response;
            }
        }

        $this->template->setView('story_create');
        $this->template->setLayout('layout');
        $this->template->setData(['error' => $error, 'form' => $form]);
        $this->response->content->set($this->template->__invoke());
        return $this->response;
    }
}