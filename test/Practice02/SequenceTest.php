<?php
/**
 * Created by PhpStorm.
 * User: kukori
 * Date: 9/16/2014
 * Time: 5:54 PM
 */
namespace Tdd\Test\Practice02;

use Tdd\Practice02\Sequence;
class SequenceTest extends \PHPUnit_Framework_TestCase
{

    private $sequence = null;

    public function testSequenceInit()
    {
        $this->sequence = new Sequence(array(1,4));
        $this->assertEquals(array(1,4),$this->sequence->getElements());
    }

    /**
     * @param array $elements
     *
     * @dataProvider   elementValidationDataProvider
     */
    public function testElementValidation(array $elements)
    {
        $this->sequence = new Sequence($elements);
        $this->assertEquals(true, $this->sequence->validateElements());
    }

    /**
     * @param array $elements
     *
     * @dataProvider   elementValidationToFailDataProvider
     */
    public function testElementValidationToFail(array $elements)
    {
        $this->sequence = new Sequence($elements);
        $this->assertEquals(false, $this->sequence->validateElements());
    }

    public function elementValidationDataProvider()
    {
        return array(
            array(array(1,4)),
            array(array(123,45)),
            array(array(-1,-4)),
        );
    }

    public function elementValidationToFailDataProvider()
    {
        return array(
            array(array(null,4)),
            array(array(123,'vnh45')),
            array(array()),
        );
    }

}
 