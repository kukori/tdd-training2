<?php

namespace Tdd\Test\Practice01;

use Tdd\Practice01\Calculator;
use Tdd\Practice01\Math;

/**
 * Class CalculatorTest
 *
 * @package Tdd\Test
 */
class CalculatorTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var Calculator
	 */
	private $calculator;

	public function setUp()
	{
		$math = new Math();

		$this->calculator = new Calculator($math);
	}

	/**
	 * @param string $expression
	 *
	 * @dataProvider invalidExpressionDataProvider
	 * @expectedException \InvalidArgumentException
	 */
	public function testCalculateWithInvalidExpressions($expression)
	{
		$this->calculator->calculate($expression);
	}

	/**
	 * @param string $expression
	 *
	 * @dataProvider numericExpressionDataProvider
	 */
	public function testNumericExpressionReturnsSame($expression)
	{
		$this->assertEquals($expression, $this->calculator->calculate($expression));
	}

	/**
	 * @param string $expression
	 * @param int    $result
	 *
	 * @dataProvider simpleExpressionDataProvider
	 */
	public function testSimpleExpressions($expression, $result)
	{
		$this->assertEquals($result, $this->calculator->calculate($expression));
	}

	/**
	 * @param string $expression
	 * @param int    $result
	 *
	 * @dataProvider complexExpressionDataProvider
	 */
	public function testComplexExpressions($expression, $result)
	{
		$this->assertEquals($result, $this->calculator->calculate($expression));
	}

	/**
	 * Provide invalid expressions for the calculating.
	 *
	 * @return array
	 */
	public function invalidExpressionDataProvider()
	{
		return array(
			array('invalid_expression'),
			array(null),
			array(false),

			// FIXME: Fix the calculate method.
			//array(true),
			//array(new \stdClass()),
		);
	}

	/**
	 * Provide numeric expressions for the calculating.
	 *
	 * @return array
	 */
	public function numericExpressionDataProvider()
	{
		return array(
			array(0),
			array(2321),

			// FIXME: Fix the calculate method.
			//array(322.2323),
			//array(-343),
		);
	}

	/**
	 * Provide simple expressions for the calculating.
	 *
	 * @return array
	 */
	public function simpleExpressionDataProvider()
	{
		return array(
			array('1+1', 2),
			array('0+2', 2),
			array('4-2', 2),
			array('6-6', 0),
		);
	}

	/**
	 * Provide complex expressions for the calculating.
	 *
	 * @return array
	 */
	public function complexExpressionDataProvider()
	{
		return array(
			array('1+1+1', 3),
			array('0+0+0+0+0+0+0+0+0+1', 1),

			// FIXME: Fix the calculate method.
			//array('14-2-2-2-2-2-2-2', 0),
			//array('6-6+2+2-1', 3),
		);
	}
}
