<?php

namespace Tdd\Homework01;

/**
 * Class PrimeFactor
 *
 * @package Tdd\PrimeFactor
 */
class PrimeFactor
{
    /**
     * Gives back all the prime factors of a given positive integer.
     *
     * @param int $number
     *
     * @return array
     */
    public function factorize($number)
    {
        $result = array();

        // Print the number of 2s that divide n
        while ($number % 2 == 0)
        {
            $result[] = 2;
            $number = $number / 2;
        }

        // n must be odd at this point.  So we can skip one element (Note i = i +2)
        for ($i = 3; $i <= sqrt($number); $i = $i + 2)
        {
            // While i divides n, print i and divide n
            while ($number % $i == 0)
            {
                $result[] = $i;
                $number = $number / $i;
            }
        }

        // This condition is to handle the case when n is a prime number greater than 2
        if ($number > 2)
        {
            $result[] = $number;
        }

        return $result;
    }
}