<?php

namespace Tdd\Practice01;

/**
 * Class Math
 *
 * @package Tdd\Math
 */
class Math
{
	const OPERATOR_ADDITION    = '+';
	const OPERATOR_SUBTRACTION = '-';

	/**
	 * @param int $a
	 * @param int $b
	 *
	 * @return int
	 */
	public function add($a, $b)
	{
		return $a + $b;
	}

	/**
	 * @param int $a
	 * @param int $b
	 *
	 * @return int
	 */
	public function subtract($a, $b)
	{
		return $a - $b;
	}

	/**
	 * @return array
	 */
	public function getOperators()
	{
		return array(self::OPERATOR_ADDITION, self::OPERATOR_SUBTRACTION);
	}

	/**
	 * @param string $operator
	 * @param int    $a
	 * @param int    $b
	 *
	 * @throws \InvalidArgumentException
	 *
	 * @return int
	 */
	public function runOperation($operator, $a, $b)
	{
		switch ($operator)
		{
			case self::OPERATOR_ADDITION:
				return $this->add($a, $b);
				break;

			case self::OPERATOR_SUBTRACTION:
				return $this->subtract($a, $b);
				break;

			default:
				throw new \InvalidArgumentException();
				break;
		}
	}
}
