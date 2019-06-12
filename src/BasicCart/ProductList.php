<?php

namespace BasicCart;

class ProductList
{
    /**
     * An array with the raw product data/lost
     *
     * @var array $product_list
     */
    protected $product_list = [
        [ "name" => "Sledgehammer", "price" => 125.75 ],
        [ "name" => "Axe", "price" => 190.50 ],
        [ "name" => "Bandsaw", "price" => 562.131 ],
        [ "name" => "Chisel", "price" => 12.9 ],
        [ "name" => "Hacksaw", "price" => 18.45 ],
    ];

    /**
     * Get an array of all the Product objects
     * @return array $products
     */
    public function getProducts()
    {
        $products = [];
        foreach ($this->product_list as $productData) {
            $products[] = new Product($productData);
        }

        return $products;
    }

    /**
     * Create the new Product object with loaded data
     * @param Int $id
     * @return \BasicCart\Product $product
     * @throws \Exception
     */
    public function getProduct($id)
    {
        if (isset($this->product_list[$id]) !== true) {
            throw new \Exception('Can not find product');
        }

        return new Product($this->product_list[$id]);
    }
}
