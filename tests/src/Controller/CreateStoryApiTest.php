<?php

namespace Masterclass\Test;

use Aura\Filter\FilterFactory;
use Aura\Web\Response;
use Aura\Web\WebFactory;
use Masterclass\Controller\CreateStoryApi;
use Masterclass\Form\StoryForm;
use Masterclass\Service\CreateStoryService;
use Mockery;

class CreateStoryApiTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Aura\Web\Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var \Mockery\MockInterface
     */
    protected $service;

    /**
     * @var StoryForm
     */
    protected $form;

    /**
     * @var CreateStoryApi
     */
    protected $storyApi;

    protected function customSetup()
    {
        $webFactory = new WebFactory($GLOBALS);
        $this->request = $webFactory->newRequest();
        $this->response = $webFactory->newResponse();

        $this->service = Mockery::mock(CreateStoryService::class);

        $filterFactory = new FilterFactory();

        $this->form = new StoryForm($filterFactory->newFilter());

        $this->storyApi = new CreateStoryApi(
            $this->request,
            $this->response,
            $this->service,
            $this->form
        );
    }

    /**
     * @covers \Masterclass\Controller\CreateStoryApi
     */
    public function testNoUsernameFails()
    {
        $this->customSetup();
        $response = $this->storyApi->create();

        $this->assertInstanceOf(Response::class, $response);

        $content = json_decode($response->content->get(), true);

        $this->assertEquals(false, $content['success']);
        $this->assertTrue(isset($content['message']));
    }

    /**
     * @covers \Masterclass\Controller\CreateStoryApi::create
     */
    public function testInvalidFormFails()
    {
        $_POST['username'] = 'brandon';

        $this->customSetup();

        $response = $this->storyApi->create();
        $content = json_decode($response->content->get(), true);

        $this->assertEquals(false, $content['success']);
        $this->assertEquals('Story was not valid', $content['message']);

        $form = $this->form;
        $this->assertTrue($form->hasError('headline'));
        $this->assertTrue($form->hasError('url'));
    }

    /**
     * @covers \Masterclass\Controller\CreateStoryApi::create
     */
    public function testValidFormCreatesAStory()
    {
        $_POST = [
            'username' => 'brandon',
            'headline' => 'Some Headline',
            'url' => 'http://www.google.com',
        ];

        $this->customSetup();

        $this->service
             ->shouldReceive('createNewStory')
             ->with('Some Headline', 'http://www.google.com', 'brandon')
             ->once()
             ->andReturn(1);

        $response = $this->storyApi->create();
        $content = json_decode($response->content->get(), true);

        $this->assertEquals('application/json', $response->content->getType());
        $this->assertEquals(true, $content['success']);
        $this->assertEquals('Story was created', $content['message']);
        $this->assertEquals(1, $content['story_id']);
    }
}