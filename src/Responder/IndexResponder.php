<?php

namespace Masterclass\Responder;

use Masterclass\Entity\StoryCollection;

class IndexResponder extends ResponderBase
{

    public function processResponse(StoryCollection $stories)
    {
        $this->template->setLayout('layout');
        $this->template->setView('index');

        $this->template->setData(['stories' => $stories]);
        $this->response->content->set($this->template->__invoke());
        return $this->response;
    }
}