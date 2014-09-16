<?php

namespace Tdd\Practice02;

class Sequence
{
    private $elements;

    public function  __construct(array $elements)
    {
        $this->elements = $elements;
    }

    public function getElements()
    {
        return $this->elements;
    }

    public function validateElements()
    {
        foreach($this->elements as $element)
        {
            if(!is_int($element))
            {
                return false;
            }
        }
        return true;
    }
}