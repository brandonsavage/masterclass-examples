<?php

namespace Masterclass\Responder;

use Aura\View\View;
use Aura\Web\Response;

abstract class ResponderBase
{
    /**
     * @var Response
     */
    protected $response;

    /**
     * @var View
     */
    protected $template;

    public function __construct(
        Response $response,
        View $view
    ) {
        $this->response = $response;
        $this->template = $view;
    }
}