<?php

namespace Tdd\Practice02;

class SequenceAnalyser
{
    private $sequence = null;

    private $min = null;

    private $max = null;

    private $elementCount = null;

    private $average = null;

    public function __construct(Sequence $sequence)
    {
        $this->sequence = $sequence;
    }

    private function runAnalyser()
    {
        $sum = 0;
        $elements = $this->sequence->getElements();
        $this->max = $this->min = $elements[0];
        $this->elementCount = count($elements);
        foreach ($elements as $element)
        {
            $sum = $sum + $element;
            if ($element > $this->max)
            {
                $this->max = $element;
            }
            if ($element < $this->min)
            {
                $this->min = $element;
            }
        }
        $this->average = $sum / $this->elementCount;
    }

    private function returnOrCalculate($value)
    {
        if (is_null($this->$value))
        {
            $this->runAnalyser();
        }
    }

    public function getSequenceMax()
    {
        $this->returnOrCalculate('max');
        return $this->max;
    }

    public function getSequenceMin()
    {
        $this->returnOrCalculate('min');
        return $this->min;
    }

    public function getSequenceAverage()
    {
        $this->returnOrCalculate('average');
        return $this->average;
    }

    public function getSequenceElementCount()
    {
        $this->returnOrCalculate('elementCount');
        return $this->elementCount;
    }
}