<?php

namespace Masterclass\Test;

use Aura\View\View;
use Aura\Web\Request;
use Aura\Web\Response;
use Aura\Web\WebFactory;
use Masterclass\Controller\Index;
use Masterclass\Model\Story;
use Mockery;

class IndexTest extends \PHPUnit_Framework_TestCase
{

    public function testIndexLoadsStories()
    {
        $story = Mockery::mock(Story::class);
        $view = Mockery::mock(View::class);
        $view->shouldIgnoreMissing();
        $responseFactory = new WebFactory($GLOBALS);
        $response = $responseFactory->newResponse();

        $view->shouldReceive('setLayout')->once()->with('layout');
        $view->shouldReceive('setView')->once()->with('index');
        $view->shouldReceive('setData')->once()->with(Mockery::type('array'));

        $story->shouldReceive('getStoryList')->once()->andReturn(['story' => 1]);

        $controller = new Index($story, $response, $view);
        $result = $controller->index();

        $this->assertInstanceOf(Response::class, $result);
    }

}