<?php
/**
 * Created by PhpStorm.
 * User: kukori
 * Date: 11/16/2014
 * Time: 8:31 AM
 */

namespace Tdd\Homework02;


class Login
{
	private $authentication = null;

	private $counter = null;

	/**
	 * Constructor
	 *
	 * @param Authentication $authentication
	 * @param Counter $counter
	 */
	public function __construct(Authentication $authentication, Counter $counter)
	{
		$this->authentication = $authentication;
		$this->counter = $counter;
	}

	/**
	 * Login.
	 *
	 * @param string $username
	 * @param string $password
	 * @param string $ip
	 *
	 * @return array
	 */
	public function login($username, $password, $ip)
	{
		$captchaNeeded = false;
		$loginResult = $this->authentication->auth($username, $password);
		if($loginResult === false)
		{
			$captchaNeeded = $this->counter->captchaNeeded($username, $ip, $loginResult);
		}
		return array(
			'loginResult' => $loginResult,
			'captchaNeeded' => $captchaNeeded
		);
	}
}