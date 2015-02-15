<?php

namespace Masterclass\Controller;

use Aura\View\View;
use Aura\Web\Request;
use Aura\Web\Response;
use Masterclass\Form\StoryForm;
use Masterclass\Model\Story;
use Masterclass\Service\CreateStoryService;

class CreateStoryApi
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
        CreateStoryService $service,
        StoryForm $form
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->service = $service;
        $this->form = $form;
    }

    public function create() {
        $this->response->content->setType('application/json');

        $results = [
            'success' => false,
            'message' => '',
        ];

        if(!$this->request->post->get('username')) {
            $results['message'] = 'The user was not spcified';
            $this->response->content->set(json_encode($results));
            return $this->response;
        }

        $form = $this->form;

        $headline = $this->request->post->get('headline');
        $url = $this->request->post->get('url');

        $result = null;
        $error = null;

        $form->populateData($this->request->post->get());
        if($form->isValid()) {
            $id = $this->service->createNewStory($headline, $url, $this->request->post->get('username'));
            $results['success'] = true;
            $results['message'] = 'Story was created';
            $results['story_id'] = $id;
            $this->response->content->set(json_encode($results));
            return $this->response;
        } else {
            $results = [
                'success' => false,
                'message' => 'Story was not valid',
                'errors' => $form->getErrors(),
            ];

            $this->response->content->set(json_encode($results));
            return $this->response;
        }
    }
}