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
	/**
	 * @param $username
	 * @param $ip
	 * @param $loginResult
	 * @param $userCountry
	 * @param $ipCount
	 * @param $ipRangeCount
	 * @param $ipCountryCount
	 * @param $usernameCount
	 * @param $ipRange
	 * @param $ipCountry
	 * @param $result
	 *
	 * @dataProvider checkIpForCaptchaDataProvider
	 */
	public function testCheckIpForCaptcha($username, $ip, $loginResult, $userCountry, $ipCount, $ipRangeCount, $ipCountryCount, $usernameCount, $ipRange, $ipCountry, $result )
	{
		$auth = $this->getAuthenticationMock($loginResult, $userCountry);
		$persistence = $this->getPersistenceMock($ipCount, $ipRangeCount, $ipCountryCount, $usernameCount);
		$ipRangeCalculator = $this->getIpRangeCalculatorMock($ipRange);
		$geoIpLookup =  $this->getGeoIpLookupMock($ipCountry);

		$counter = new Counter($auth, $persistence, $ipRangeCalculator, $geoIpLookup);
		$this->assertEquals($counter->captchaNeeded($username, $ip, $loginResult), $result);
	}

	public function getAuthenticationMock($loginResult = true, $userCountry = 'US')
	{
		$authenticationMock = $this->getMock('Tdd\Homework02\Authentication', array('auth', 'getUserRegCountry'));
		$authenticationMock->expects($this->any())->method('auth')->will($this->returnValue($loginResult));
		$authenticationMock->expects($this->any())->method('getUserRegCountry')->will($this->returnValue($userCountry));

		return $authenticationMock;
	}

	public function getPersistenceMock($ipCount = 0, $ipRangeCount = 0, $ipCountryCount = 0, $usernameCount = 0)
	{
		$persistenceMock = $this->getMock('Tdd\Homework02\Persistence', array('remove', 'get', 'put'));
		$persistenceMock->expects($this->any())->method('remove');
		$persistenceMock->expects($this->any())->method('get')->will($this->onConsecutiveCalls($ipCount, $ipRangeCount, $ipCountryCount, $usernameCount));
		$persistenceMock->expects($this->any())->method('put');

		return $persistenceMock;
	}

	public function getIpRangeCalculatorMock($ipRange = 'blabla')
	{
		$ipRangeCalculatorMock = $this->getMock('Tdd\Homework02\IpRangeCalculator', array('calculateIpRange'));
		$ipRangeCalculatorMock->expects($this->any())->method('calculateIpRange')->will($this->returnValue($ipRange));

		return $ipRangeCalculatorMock;
	}

	public function getGeoIpLookupMock($ipCountry = 'US')
	{
		$geoIpLookupMock = $this->getMock('Tdd\Homework02\GeoIpLookup', array('getCountry'));
		$geoIpLookupMock->expects($this->any())->method('getCountry')->will($this->returnValue($ipCountry));

		return $geoIpLookupMock;
	}

	public function checkIpForCaptchaDataProvider()
	{
		return array(
			array('ati', '192.168.4.17', false, 'US', 2, 0, 0, 0, 'blabla', 'US', true),
			array('ati', '192.168.4.17', false, 'US', 1, 499, 0, 0, 'blabla', 'US', true),
			array('ati', '192.168.4.17', false, 'US', 1, 0, 999, 0, 'blabla', 'US', true),
			array('ati', '192.168.4.17', false, 'US', 1, 0, 0, 2, 'blabla', 'US', true),
			array('ati', '192.168.4.17', false, 'US', 0, 0, 0, 0, 'blabla', 'HU', true),
			array('ati', '192.168.4.17', true, 'US', 2, 499, 999, 2, 'blabla', 'US', false),
		);
	}
}
