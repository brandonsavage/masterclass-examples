<?php

namespace Masterclass\Responder;

use Masterclass\Form\FormBase;

class CreateStoryResponder extends ResponderBase
{
    public function process($type, FormBase $form, $id = null, $error = null)
    {
        if ($type == 'html') {
            return $this->htmlResponse($form, $id, $error);
        } else {
            return $this->jsonResponse($form, $id, $error);
        }
    }

    protected function htmlResponse(FormBase $form, $id, $error)
    {
        if ($error == 'unauthenticated user') {
            $this->response->redirect->to('/user/login');
            return $this->response;
        }

        if ($id) {
            $this->response->redirect->to('/story?id=' . $id);
            return $this->response;
        }

        if($error) {
            $error = 'There was a problemw with the form. Please check your answers and try again.';
        }

        $this->template->setView('story_create');
        $this->template->setLayout('layout');
        $this->template->setData(['error' => $error, 'form' => $form]);
        $this->response->content->set($this->template->__invoke());
        return $this->response;
    }

    protected function jsonResponse(FormBase $form, $id, $error)
    {
        $this->response->content->setType('application/json');

        $results = [
            'success' => false,
            'message' => '',
        ];

        if($error == 'unauthenticated user') {
            $results['message'] = 'The user was not provided!';
            $this->response->content->set(json_encode($results));
            return $this->response;
        }

        if ($id) {
            $results['success'] = true;
            $results['message'] = 'Story was created';
            $results['story_id'] = $id;
            $this->response->content->set(json_encode($results));
            return $this->response;
        }

        $results['message'] = $error;
        $results['form_errors'] = $form->getErrors();
        $this->response->content->set(json_encode($results));
        return $this->response;
    }
}