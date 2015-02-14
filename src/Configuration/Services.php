<?php

namespace Masterclass\Configuration;

use Aura\Di\Config;
use Aura\Di\Container;
use Masterclass\Model\Story;
use Masterclass\Service\CreateStoryService;

class Services extends Config
{
    public function define(Container $di)
    {
        $di->set('createStory', $di->lazyNew(CreateStoryService::class));

        $di->params[CreateStoryService::class] = [
            'story' => $di->lazyNew(Story::class),
        ];
    }
}