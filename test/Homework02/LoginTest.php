<?php
/**
 * Created by PhpStorm.
 * User: kukori
 * Date: 11/16/2014
 * Time: 8:32 AM
 */

use Tdd\Homework02\Login;
class LoginTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @param $username
	 * @param $password
	 * @param $ip
	 * @param $loginResult
	 * @param $captchaNeeded
	 * @param $result
	 *
	 * @dataProvider loginTestDataProvider
	 */
	public function testLogin($username, $password, $ip, $loginResult, $captchaNeeded, $result)
	{
		$auth = $this->getAuthenticationMock($loginResult);
		$counter = $this->getCounterMock($captchaNeeded);


		$login = new Login($auth, $counter);
		$this->assertEquals($login->login($username, $password, $ip), $result);
	}

	public function getAuthenticationMock($loginResult = true, $userCountry = 'US')
	{
		$authenticationMock = $this->getMock('Tdd\Homework02\Authentication', array('auth', 'getUserRegCountry'));
		$authenticationMock->expects($this->any())->method('auth')->will($this->returnValue($loginResult));
		$authenticationMock->expects($this->any())->method('getUserRegCountry')->will($this->returnValue($userCountry));

		return $authenticationMock;
	}

	public function getCounterMock($captchaNeeded = false)
	{
		$counterMock = $this->getMockBuilder('Tdd\Homework02\Counter')
			->disableOriginalConstructor()
			->getMock();
		//$counterMock = $this->getMock('Tdd\Homework02\Counter', array('captchaNeeded'));
		$counterMock->expects($this->any())->method('captchaNeeded')->will($this->returnValue($captchaNeeded));

		return $counterMock;
	}

	public function loginTestDataProvider()
	{
		return array(
			array('ati', 'password', '192.168.4.17', false, true, array('loginResult' => false, 'captchaNeeded' => true)),
			array('ati', 'password', '192.168.4.17', true, false, array('loginResult' => true, 'captchaNeeded' => false)),
			array('ati', 'password', '192.168.4.17', false, false, array('loginResult' => false, 'captchaNeeded' => false)),
		);
	}
}
