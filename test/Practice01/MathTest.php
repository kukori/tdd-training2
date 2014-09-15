<?php

namespace Tdd\Test\Practice01;

use Tdd\Practice01\Math;

/**
 * Class MathTest
 *
 * @package Tdd\Test
 */
class MathTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var Math
	 */
	private $math;

	public function setUp()
	{
		$this->math = new Math();
	}

	/**
	 * @param int $a
	 * @param int $b
	 * @param int $result
	 *
	 * @dataProvider addMethodDataProvider
	 */
	public function testAddTwoNumber($a, $b, $result)
	{
		$this->assertEquals($this->math->add($a, $b), $result);
	}

	/**
	 * @param int $a
	 * @param int $b
	 * @param int $result
	 *
	 * @dataProvider subtractMethodDataProvider
	 */
	public function testSubtractTwoNumber($a, $b, $result)
	{
		$this->assertEquals($this->math->subtract($a, $b), $result);
	}

	public function testOperatorList()
	{
		$this->assertEquals($this->math->getOperators(), array(Math::OPERATOR_ADDITION, Math::OPERATOR_SUBTRACTION));
	}

	/**
	 * @param string $operator
	 * @param int    $a
	 * @param int    $b
	 * @param int    $result
	 *
	 * @dataProvider validOperationDataProvider
	 */
	public function testOperationWithValidData($operator, $a, $b, $result)
	{
		$this->assertEquals($this->math->runOperation($operator, $a, $b), $result);
	}

	/**
	 * @param string $operator
	 *
	 * @dataProvider invalidOperatorDataProvider
	 * @expectedException \InvalidArgumentException
	 */
	public function testOperationWithInvalidOperator($operator)
	{
		$this->math->runOperation($operator, 1, 1);
	}

	/**
	 * Provide test data for add method.
	 *
	 * @return array
	 */
	public function addMethodDataProvider()
	{
		return array(
			array(1, 1, 2),
			array(0, 0, 0),
			array(0, 2, 2)
		);
	}

	/**
	 * Provide test data for subtract method.
	 *
	 * @return array
	 */
	public function subtractMethodDataProvider()
	{
		return array(
			array(1, 1, 0),
			array(0, 0, 0),
			array(0, 2, -2),
			array(3, 1, 2)
		);
	}

	/**
	 * Provide valid test data for math operations.
	 *
	 * @return array
	 */
	public function validOperationDataProvider()
	{
		return array(
			array(Math::OPERATOR_ADDITION, 1, 1, 2),
			array(Math::OPERATOR_ADDITION, 0, 0, 0),
			array(Math::OPERATOR_ADDITION, 0, 2, 2),
			array(Math::OPERATOR_SUBTRACTION, 1, 1, 0),
			array(Math::OPERATOR_SUBTRACTION, 0, 0, 0),
			array(Math::OPERATOR_SUBTRACTION, 0, 2, -2),
			array(Math::OPERATOR_SUBTRACTION, 3, 1, 2)
		);
	}

	/**
	 * Provide invalid operator for math operations.
	 *
	 * @return array
	 */
	public function invalidOperatorDataProvider()
	{
		return array(
			array(new \stdClass()),
			array(32423423),
			array('invalid operator'),
			array(3.343),
			array(null),
			array(false),
			// Fix the runOperation()
			//array(true),
			//array(0),
		);
	}
}
