<?php

namespace Masterclass\Entity;

class StoryCollection implements \Iterator, \Countable
{
    /**
     * @var array
     */
    protected $collection = [];

    public function addStory(Story $story)
    {
        $this->collection[] = $story;
    }

    public function removeStory(Story $story)
    {
        foreach($this->collection as $key => $object)
        {
            if ($object === $story) {
                unset($this->collection[$key]);
                return true;
            }
        }
    }

    public function removeStoryById($id)
    {
        foreach($this->collection as $key => $object)
        {
            if ($object->getId() == $id) {
                unset($this->collection[$key]);
                return true;
            }
        }
    }

    public function findStoryWithId($id)
    {
        foreach($this->collection as $collection)
        {
            if($collection->getId() == $id) {
                return $collection;
            }
        }

        return null;
    }

    public function count() {
        return count($this->collection);
    }

    public function current() {
        return current($this->collection);
    }

    public function key() {
        return key($this->collection);
    }

    public function next() {
        return next($this->collection);
    }

    public function rewind() {
        reset($this->collection);
    }

    public function valid() {
        return (bool) $this->current();
    }
}