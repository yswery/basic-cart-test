<?php

namespace BasicCart;

class Product
{
    /**
     * The name of the product
     *
     * @var string
     */
    public $name;

    /**
     * The array with the raw product data
     *
     * @var array
     */
    public $rawPrice;

    /**
     * Creates a Product object from $productData
     * @param $productData
     */
    public function __construct($productData)
    {
        $this->name = $productData['name'];
        $this->rawPrice = $productData['price'];
    }

    /**
     * Mutator Setter for price to have a refined and rounded number
     * @param $name
     * @return string $price
     */
    public function __get($name)
    {
        if ($name === 'price') {
            return number_format($this->rawPrice, 2);
        }
    }
}
