<?php

namespace Tdd\Exam;

class StringToArrayConverter
{
	public function convert($string)
	{
		$this->validateString($string);

		return explode(',', $string);
	}

	private function validateString($string)
	{
		if (!is_string($string))
		{
			throw new \InvalidArgumentException('Invalid input, string expected: ' . var_export($string, true));
		}
	}
}