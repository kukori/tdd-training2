<?php
/**
 * Created by PhpStorm.
 * User: kukori
 * Date: 9/16/2014
 * Time: 5:43 PM
 */
namespace Tdd\Test\Practice02;

use Tdd\Practice02\Sequence;
use Tdd\Practice02\SequenceAnalyser;
class SequenceAnalyserTest extends \PHPUnit_Framework_TestCase
{
    private $sequence = null;

    private $sequenceAnalyer = null;

    /**
     * @param array $elements
     * @param int $max
     *
     * @dataProvider sequenceDataProvider
     */
    public function testGetSequenceMax(array $elements, $max)
    {
        $this->sequence = new Sequence($elements);
        $this->sequenceAnalyer = new SequenceAnalyser($this->sequence);
        $this->assertEquals($max, $this->sequenceAnalyer->getSequenceMax());
    }

    public function sequenceDataProvider()
    {
        return array(
            array(array(1,4), 4),
            array(array(123,45), 123),
            array(array(-1,-4), -1),
        );
    }
}
 