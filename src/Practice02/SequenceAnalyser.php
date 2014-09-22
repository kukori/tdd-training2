<?php

namespace Tdd\Practice02;

class SequenceAnalyser
{
    private $sequence = null;

    public function __construct(Sequence $sequence)
    {
        $this->sequence = $sequence;
    }

    public function getSequenceMax()
    {
        $elements = $this->sequence->getElements();
        $max = $elements[0];
        foreach ($elements as $element)
        {
            if ($element > $max)
            {
                $max = $element;
            }
        }
        return $max;
    }
}