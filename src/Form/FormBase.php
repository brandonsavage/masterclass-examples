<?php

namespace Masterclass\Form;

use Aura\Filter\Filter;

abstract class FormBase
{
    /**
     * @var Filter
     */
    protected $filter;

    protected $fields = [];

    protected $suppliedData = [];

    public function __construct(Filter $filter)
    {
        $this->filter = $filter;
        $this->configureValidations();

    }

    public function populateData(array $data = [])
    {
        foreach ($this->fields as $field) {
            if (isset($data[$field])) {
                $this->suppliedData[$field] = $data[$field];
            } else {
                $this->suppliedData[$field] = null;
            }
        }

    }

    public function validate()
    {
        return $this->filter->apply($this->suppliedData);
    }

    public function isValid()
    {
        return $this->validate();
    }

    public function getError($field)
    {
        return implode(' ', $this->filter->getMessages($field));
    }

    public function hasError($field)
    {
        return !empty($this->filter->getMessages($field));
    }

    public function getErrors()
    {
        return $this->filter->getMessages();
    }

    public function getValue($field)
    {
        if(isset($this->suppliedData[$field])) {
            return $this->suppliedData[$field];
        }

        return null;
    }

    abstract protected function configureValidations();

}