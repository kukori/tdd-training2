<?php

namespace Tdd\Practice01;

use InvalidArgumentException;
use LogicException;

/**
 * Class Calculator
 *
 * @package Tdd\Math
 */
class Calculator
{
	/**
	 * @var Math
	 */
	private $math;

	/**
	 * @var array
	 */
	private $operators;

	/**
	 * @var string
	 */
	private $operatorsRegexp;

	/**
	 * Constructor.
	 *
	 * @param Math $math
	 */
	public function __construct(Math $math)
	{
		$this->math            = $math;
		$this->operators       = $math->getOperators();
		$this->operatorsRegexp = '\\' . implode('\\', $this->operators);
	}

	/**
	 * Calculate the expression.
	 *
	 * @param string $expression
	 *
	 * @throws InvalidArgumentException
	 * @throws LogicException
	 *
	 * @return int
	 */
	public function calculate($expression)
	{
		// Check for invalid expression.
		if (!preg_match('/^([0-9]+[' . $this->operatorsRegexp . '])*[0-9]+$/', $expression))
		{
			throw new InvalidArgumentException('Invalid expression! Bad characters used.');
		}

		// If its only a number, then it is the result.
		if (is_numeric($expression))
		{
			return (int)$expression;
		}

		// Complex expression:
		// - split at every operator,
		// - store the first part,
		// - rerun the method for the second part,
		// - do the operation with the two parts
		$matches = array();
		if (preg_match('/^([0-9]+)([' . $this->operatorsRegexp . '])(.*)/', $expression, $matches))
		{
			return $this->math->runOperation($matches[2], $matches[1], $this->calculate($matches[3]));
		}
		else
		{
			throw new LogicException('There is no way this could happen! (At least in theory.)');
		}
	}
}
