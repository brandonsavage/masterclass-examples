<?php

namespace Masterclass\Responder;

use Aura\Accept\Accept;
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

    /**
     * @var Accept
     */
    protected $contentNegotiation;

    /**
     * The content types we will accept. Override in base classes.
     *
     * @var array
     */
    protected $accept = [
        'text/html'
    ];

    /**
     * The negotiated types.
     *
     * @var string
     */
    protected $useType = null;

    /**
     * @var The content type to use for the response.
     */
    protected $contentType;

    public function __construct(
        Response $response,
        View $view,
        Accept $accept
    ) {
        $this->response = $response;
        $this->template = $view;
        $this->contentNegotiation = $accept;

        $this->determineResponseType();
    }

    protected function determineResponseType()
    {
        $bestType = $this->contentNegotiation->negotiateMedia($this->accept);
        if ($bestType instanceof \Aura\Accept\Media\MediaValue) {
            $this->contentType = $bestType->getValue();
            $this->useType = $bestType->getSubtype();
            return;
        }

        throw new \Exception('The content type requested was not a valid response type');
    }
}