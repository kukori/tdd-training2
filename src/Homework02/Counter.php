<?php

namespace Tdd\Homework02;

class Counter
{
	const PERSISTENCE_TTL = 3600;

	const PERSISTENCE_KEY_LOGIN_PER_IP = 'persistence_key_login_per_ip';

	const PERSISTENCE_KEY_IS_CAPTCHA_ON = 'persistence_key_is_captcha_on';

	const PERSISTENCE_KEY_LOGIN_PER_IP_RANGE = 'persistence_key_login_per_ip_range';

	const PERSISTENCE_KEY_LOGIN_PER_IP_COUNTRY = 'persistence_key_login_per_ip_country';

	const PERSISTENCE_KEY_LOGIN_PER_IP_USERNAME = 'persistence_key_login_per_ip_country';

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
		$ipCount = $this->calculateLoginPerKey($loginResult, self::PERSISTENCE_KEY_LOGIN_PER_IP . $ip);

		$ipRange = $this->ipRangeCalculator->calculateIpRange($ip);
		$ipRangeCount = $this->calculateLoginPerKey($loginResult, self::PERSISTENCE_KEY_LOGIN_PER_IP_RANGE . $ipRange);

		$ipCountry = $this->geoIpLookup->getCountry($ip);
		$ipCountryCount = $this->calculateLoginPerKey($loginResult, self::PERSISTENCE_KEY_LOGIN_PER_IP_COUNTRY . $ipCountry);

		$usernameCount = $this->calculateLoginPerKey($loginResult, self::PERSISTENCE_KEY_LOGIN_PER_IP_USERNAME . $username);

		if (
			$ipCount >= 3
			|| $ipRangeCount >= 500
			|| $ipCountryCount >= 1000
			|| $usernameCount >= 3
			|| $this->authentication->getUserRegCountry($username) !== $ipCountry
		)
		{
			$isCaptchaNeeded = true;
			$this->persistence->put(true, self::PERSISTENCE_KEY_IS_CAPTCHA_ON);
		}
		return array(
			'loginResult'   => $loginResult,
			'captchaNeeded' => $isCaptchaNeeded
		);
	}

	/**
	 * @param bool $loginResult
	 * @param string $key
	 *
	 * @return int
	 */
	private function calculateLoginPerKey($loginResult, $key)
	{
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
			else
			{
				$count++;
			}
			$this->persistence->put($count, $key, self::PERSISTENCE_TTL);
		}

		return $count;
	}
}