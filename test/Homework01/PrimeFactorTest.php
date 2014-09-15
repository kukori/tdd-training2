<?php

namespace Tdd\Test\Homework01;

use Tdd\Homework01\PrimeFactor;

/**
 * Class PrimeFactorTest
 *
 * @package Tdd\Test
 */
class PrimeFactorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PrimeFactor
     */
    private $primeFactor;

    /**
     * SetUp.
     */
    public function setUp()
    {
        $this->primeFactor = new PrimeFactor();
    }

    /**
     * @param $a
     * @param $result
     *
     * @dataProvider   factorizeDataProvider
     */
    public function testFactorize($a, $result)
    {
        $this->assertEquals($this->primeFactor->factorize($a), $result);
    }

    /**
     * Provides data for factorize test.
     *
     * @return array
     */
    public function factorizeDataProvider()
    {
        return array(
            array(2, array(2)),
            array(3, array(3)),
            array(4, array(2, 2)),
            array(6, array(2, 3)),
            array(9, array(3, 3)),
            array(12, array(2, 2, 3)),
            array(15, array(3, 5)),
            array(125, array(5, 5, 5)),
            array(1024, array(2, 2, 2, 2, 2, 2, 2, 2, 2, 2)),
            array(2993, array(41, 73)),
            array(91239213, array(3, 13, 13, 13, 109, 127)),
        );
    }
}