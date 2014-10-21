<?php
/**
 * Created by PhpStorm.
 * User: kukori
 * Date: 10/14/2014
 * Time: 5:50 PM
 */

use Tdd\Homework02\Counter;
class CounterTest extends \PHPUnit_Framework_TestCase
{

	public function testCheckIpForCaptcha()
	{
		$auth = $this->getAuthenticationMock(false);
		$persistence = $this->getPersistenceMock(2);
		$ipRangeCalculator = $this->getIpRangeCalculatorMock();
		$geoIpLookup =  $this->getGeoIpLookupMock();

		$counter = new Counter($auth, $persistence, $ipRangeCalculator, $geoIpLookup);
		$username = 'ati';
		$password = 'password';
		$ip = '123.123.213.213';
		$this->assertEquals($counter->login($username, $password, $ip), array('loginResult' => false, 'captchaNeeded' => true));
	}

	public function getAuthenticationMock($result = true)
	{
		$authenticationMock = $this->getMock('Tdd\Homework02\Authentication', array('login'));
		$authenticationMock->expects($this->any())->method('login')->will($this->returnValue($result));

		return $authenticationMock;
	}

	public function getPersistenceMock($count = 0)
	{
		$persistenceMock = $this->getMock('Tdd\Homework02\Persistence', array('remove', 'get', 'put'));
		$persistenceMock->expects($this->any())->method('remove');
		$persistenceMock->expects($this->any())->method('get')->will($this->returnValue($count));
		$persistenceMock->expects($this->any())->method('put');

		return $persistenceMock;
	}

	public function getIpRangeCalculatorMock()
	{
		$ipRangeCalculatorMock = $this->getMock('Tdd\Homework02\IpRangeCalculator');
		//$ipRangeCalculatorMock->expects($this->any())->method('login')->will($this->returnValue($result));

		return $ipRangeCalculatorMock;
	}

	public function getGeoIpLookupMock()
	{
		$geoIpLookupMock = $this->getMock('Tdd\Homework02\GeoIpLookup');
		//$geoIpLookupMock->expects($this->any())->method('login')->will($this->returnValue($result));

		return $geoIpLookupMock;
	}


}
