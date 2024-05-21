<?php

/**
 * Interface Segregation Principle
 * - A client should never be forced to implement an interface that it doesn't use or clients shouldn't be forced to depend on methods they do not use.
 */
// BAD CODE
// interface Order
// {
//     public function calculateTotalPrice();
//     public function downlaodOrder();
//     public function shipOrder();
// }

// class InStoreOrder implements Order
// {
//     public function calculateTotalPrice()
//     {
//         echo "Calculating total price for in store order\n";
//     }
//     public function downlaodOrder()
//     {
//         echo "Downloading in store order\n";
//     }
//     public function shipOrder()
//     {
//         echo "Shipping in store order\n";
//     }
// }

// class OnlineOrder implements Order
// {
//     public function calculateTotalPrice()
//     {
//         echo "Calculating total price for online order\n";
//     }
//     public function downlaodOrder()
//     {
//         echo "Downloading online order\n";
//     }
//     public function shipOrder()
//     {
//         echo "Shipping online order\n";
//     }
// }

// GOOD CODE
interface CalculateOrder
{
    public function calculateTotalPrice();
}
interface DownloadableOrder
{
    public function downlaodOrder();
}
interface ShipableOrder
{
    public function shipOrder();
}

class InStoreOrder implements CalculateOrder
{
    public function calculateTotalPrice()
    {
        echo "Calculating total price for in store order\n";
    }
}

class OnlineOrder implements CalculateOrder, DownloadableOrder, ShipableOrder
{
    public function calculateTotalPrice()
    {
        echo "Calculating total price for online order\n";
    }
    public function downlaodOrder()
    {
        echo "Downloading online order\n";
    }
    public function shipOrder()
    {
        echo "Shipping online order\n";
    }
}
