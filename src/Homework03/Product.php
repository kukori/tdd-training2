<?php

namespace Tdd\Homework03;

/**
 * Product data object / value object.
 */
class Product
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $ean;

    /**
     * @var string
     */
    public $name;
}

/**
 * Representing empty product / null product
 */
class NullProduct extends Product { }
