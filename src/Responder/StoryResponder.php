<?php

namespace Masterclass\Responder;

class StoryResponder extends ResponderBase
{

    public function processResponse(array $story = [], array $comments = [])
    {
        if(empty($story)) {
            $this->response->redirect->to('/');
            return $this->response;
        }

        $this->template->setData(['story' => $story, 'comments' => $comments]);
        $this->template->setView('story');
        $this->template->setLayout('layout');
        $this->response->content->set($this->template->__invoke());
        return $this->response;
    }
}