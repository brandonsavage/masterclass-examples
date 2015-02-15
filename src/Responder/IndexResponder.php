<?php

namespace Masterclass\Responder;

class IndexResponder extends ResponderBase
{

    public function processResponse(array $stories = [])
    {
        $this->template->setLayout('layout');
        $this->template->setView('index');

        $this->template->setData(['stories' => $stories]);
        $this->response->content->set($this->template->__invoke());
        return $this->response;
    }
}