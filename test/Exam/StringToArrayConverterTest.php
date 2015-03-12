<?php

use Tdd\Exam\StringToArrayConverter;
class StringToArrayConverterTest extends \PHPUnit_Framework_TestCase
{
	/**
	 *
	 * @param string $string
	 * @param array $resultArray
	 *
	 * @dataProvider convertTestDataProvider
	 */
	public function testConvert($string, $resultArray)
	{
		$converter = new StringToArrayConverter();
		$this->assertEquals($resultArray, $converter->convert($string));
	}

	public function convertTestDataProvider()
	{
		return array(
			array('a,b,c', array ('a', 'b', 'c')),
			array('100,982,444,990,1', array ('100', '982', '444', '990', '1')),
			array('Mark,Anthony,marka@lib.de', array ('Mark', 'Anthony', 'marka@lib.de')),
		);
	}
}