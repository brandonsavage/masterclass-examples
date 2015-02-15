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

    protected $requestType;

    protected $user;

    public function __construct(
        Request $request,
        CreateStoryService $service,
        StoryForm $form
    ) {
        $this->request = $request;
        $this->service = $service;
        $this->form = $form;

        $this->requestType = $this->request->method->get();

        if (isset($_SESSION['AUTHENTICATED']) && $_SESSION['username']) {
            $this->responseType = 'html';
            $this->user = $_SESSION['username'];
        } else if ($this->request->post->get('username')) {
            $this->responseType = 'json';
            $this->user = $this->request->post->get('username');
        } else {
            $this->user = null;
        }
    }

    public function create() {

        $response = [
            'type' => $this->responseType,
            'form' => $this->form,
            'id' => null,
            'error' => null,
        ];

        if(!$this->user) {
            $response = ['unauthenticated user'];
            return $response;
        }

        $form = $this->form;

        $create = ($this->requestType == 'POST') ? true : false;
        if($create) {
            $headline = $this->request->post->get('headline');
            $url = $this->request->post->get('url');
            $form->populateData($this->request->post->get());
            if($form->isValid()) {
                $id = $this->service->createNewStory($headline, $url, $this->user);
                $response['id'] = $id;
                return $response;
            } else {
                $response['error'] = 'form validation error';
            }
        }

        return $response;
    }
}