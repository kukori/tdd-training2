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

	/**
	 *
	 * @param string $string
	 * @param array $resultArray
	 *
	 * @dataProvider convertTestNotEqualDataProvider
	 */
	public function testNotEqualConvert($string, $resultArray)
	{
		$converter = new StringToArrayConverter();
		$this->assertNotEquals($resultArray, $converter->convert($string));
	}

	public function testException()
	{
		$this->setExpectedException('\InvalidArgumentException');
		$converter = new StringToArrayConverter();
		$converter->convert(array());
	}

	public function convertTestDataProvider()
	{
		return array(
			array('a,b,c', array('a', 'b', 'c')),
			array('100,982,444,990,1', array('100', '982', '444', '990', '1')),
			array('Mark,Anthony,marka@lib.de', array('Mark', 'Anthony', 'marka@lib.de')),
		);
	}

	public function convertTestNotEqualDataProvider()
	{
		return array(
			array('a,b,c', array ('a', 'b')),
			array('100,982,444,990', array ('100', '982', '444', '990', '1')),
			array('Mark,Anthony,marka@lib.hu', array ('Mark', 'Anthony', 'marka@lib.de')),
		);
	}
}