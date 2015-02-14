<?php

namespace Masterclass\Form;

class StoryForm extends FormBase
{
    protected $fields = [
        'headline',
        'url',
    ];

    protected function configureValidations()
    {
        $this->filter->validate('headline')->isNot('blank')->asSoftRule('A headline is required!');

        $this->filter->validate('url')->is('url')->asSoftRule('A valid URL is required!');

    }
}