<?php

namespace Masterclass\Controller;

use Aura\View\View;
use Aura\Web\Request;
use Aura\Web\Response;
use Masterclass\Form\StoryForm;
use Masterclass\Model\Comment;
use Masterclass\Model\Story as StoryModel;
use Masterclass\Service\CreateStoryService;

class Story {

    /**
     * @var StoryModel
     */
    protected $storyModel;

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

    /**
     * @var CreateStoryService
     */
    protected $createService;

    /**
     * @var StoryForm
     */
    protected $form;

    public function __construct(
        StoryModel $story,
        Comment $comment,
        Response $response,
        View $view
    ) {
        $this->storyModel = $story;
        $this->commentModel = $comment;
        $this->response = $response;
        $this->template = $view;
    }
    
    public function index() {

        $id = (int)$_GET['id'];

        if(!$id) {
            return [];
        }

        $story = $this->storyModel->getStory($id);

        if(!$story) {
            return [];
        }

        $comments = $this->commentModel->getCommentsForStory($story->getId());

        $comment_count = count($comments);

        $story->setCommentCount($comment_count);

        return ['story' => $story, 'comments' => $comments];


    }
    
}