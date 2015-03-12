<?php

namespace Tdd\Exam;

class StringToArrayConverter
{
	public function convert($string)
	{
		$result = array();
		$this->validateString($string);
		$subResults = explode("\n", $string);
		if (count($subResults) === 1)
		{
			$result = $this->explodeAndTrim($string);
		}
		else
		{
			foreach($subResults as $subResult)
			{
				$result[] = $this->explodeAndTrim($subResult);
			}
		}
		return $result;
	}

	public function explodeAndTrim($string)
	{
		return explode(',', trim($string));
	}

	private function validateString($string)
	{
		if (!is_string($string))
		{
			throw new \InvalidArgumentException('Invalid input, string expected: ' . var_export($string, true));
		}
	}
}