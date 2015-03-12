<?php

use Tdd\Exam\StringToArrayConverter;
class StringToArrayConverterTest extends \PHPUnit_Framework_TestCase
{
	public function testConvert()
	{
		$string = "a,b,c";
		$resultArray = array ('a', 'b', 'c');
		$converter = new StringToArrayConverter();
		$this->assertEquals($resultArray, $converter->convert($string));
	}
}