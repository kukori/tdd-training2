<?php

namespace Tdd\Homework02;

class Counter
{
	const PERSISTENCE_TTL = 3600;

	const PERSISTENCE_KEY_LOGIN_PER_IP = 'persistence_key_login_per_ip';

	private $authentication = null;

	private $persistence = null;

	private $ipRangeCalculator = null;

	private $geoIpLookup = null;

	/**
	 * Constructor
	 *
	 * @param Authentication $authentication
	 * @param Persistence $persistence
	 * @param IpRangeCalculator $ipRangeCalculator
	 * @param GeoIpLookup $geoIpLookup
	 */
	public function __construct(Authentication $authentication, Persistence $persistence, IpRangeCalculator $ipRangeCalculator, GeoIpLookup $geoIpLookup)
	{
		$this->authentication = $authentication;
		$this->persistence = $persistence;
		$this->ipRangeCalculator = $ipRangeCalculator;
		$this->geoIpLookup = $geoIpLookup;
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
		$isCaptchaNeeded = false;
		$loginResult = $this->authentication->login($username, $password);
		$ipCount = $this->calculateLoginPerIpCount($ip, $loginResult);

		if ($ipCount >= 3)
		{
			$isCaptchaNeeded = true;
		}
		return array($loginResult, $isCaptchaNeeded);
	}

	/**
	 * @param $ip
	 * @param $loginResult
	 *
	 * @return int
	 */
	private function calculateLoginPerIpCount($ip, $loginResult)
	{
		$key = self::PERSISTENCE_KEY_LOGIN_PER_IP . $ip;
		if ($loginResult === true)
		{
			$this->persistence->remove($key);
			$count = 0;
		}
	else
		{
			$count = $this->persistence->get($key);
			if (empty($count))
			{
				$count = 1;
			}
			$count++;
			$this->persistence->put($count, $key);
		}

		return $count;
	}
}