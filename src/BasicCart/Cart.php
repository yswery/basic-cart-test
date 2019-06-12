<?php

namespace BasicCart;

class Cart
{
    /**
     * An array of multiple Product objects
     *
     * @var array
     */
    protected $productList;


    /**
     * Loads up the ProductList on on instantiation
     */
    public function __construct()
    {
        $this->productList = new ProductList();
    }

    /**
     * Gets a specific item from the cart by $id
     * @param Int $id
     * @return \BasicCart\Cart $this
     * @throws \Exception
     */
    public function addItem($id)
    {
        if ($this->checkProduct($id) !== true) {
            throw new \Exception('Can not find product');
        }

        if (isset($_SESSION['cart'][$id]) === true) {
            $_SESSION['cart'][$id]['count']++;
        } else {
            $_SESSION['cart'][$id]['count'] = 1;
        }

        return $this;
    }

    /**
     * Removes a specific item from the cart by $id
     * @param Int $id
     * @return \BasicCart\Cart $this | Exception
     * @throws \Exception
     */
    public function removeItem($id)
    {
        if ($this->checkProduct($id) !== true) {
            throw new \Exception('Can not find product');
        }

        unset($_SESSION['cart'][$id]);

        return $this;
    }

    /**
     * Clears the full cart and resets it to empty
     * @return \BasicCart\Cart $this
     * @throws \Exception
     */
    public function clearCart()
    {
        $_SESSION['cart'] = [];

        return $this;
    }

    /**
     * Gets all items and their reccuring counts from cart
     * @return array $cartItems
     * @throws \Exception
     */
    public function getItems()
    {
        $cartItems = [];

        foreach ($_SESSION['cart'] as $id => $data) {
            $cartItem = $this->productList->getProduct($id);
            $cartItem->count = $data['count'];

            $cartItems[$id] = $cartItem;
        }

        return $cartItems;
    }

    /**
     * Gets the total cost of all items in cart
     * @return Float $totalCost
     * @throws \Exception
     */
    public function getTotalCost()
    {
        $totalCost = 0.00;

        foreach ($this->getItems() as $cartItem) {
            $totalCost += ($cartItem->price * $cartItem->count);
        }

        return $totalCost;
    }

    /**
     * Check if there is a product with the given $id
     * @return Bool
     * @throws \Exception
     */
    private function checkProduct($id)
    {
        return $this->productList->getProduct($id) ? true : false;
    }
}
