<?php

/**
 * Open Closed Principle
 * - A class should be open for extension but closed for modification.
 */
// BAD CODE
// class Discount
// {
//     public function calculate($amount, $type)
//     {
//         if ($type == 'percent') {
//             return $amount * 0.2;
//         } else if ($type == 'KDV') {
//             return $amount * 0.5;
//         }
//     }
// }

// $discount = new Discount();
// echo $discount->calculate(100, 'percent');
// echo "\n";
// echo $discount->calculate(100, 'KDV');

// GOOD CODE
interface Discount
{
    public function calculate($amount);
}
class NoDiscount implements Discount
{
    public function calculate($amount)
    {
        return $amount;
    }
}
class PercentDiscount implements Discount
{
    public function calculate($amount)
    {
        return $amount * 0.2;
    }
}
class KDVDiscount implements Discount
{
    public function calculate($amount)
    {
        return $amount - $amount / 100 * 20;
    }
}
class Fix50TLDiscount implements Discount
{
    public function calculate($amount)
    {
        return $amount - 50;
    }
}
class Order
{
    private $discount;
    private $amount;
    public function __construct($amount, Discount $discount)
    {
        $this->discount = $discount;
        $this->amount = $amount;
    }
    public function checkout()
    {
        return $this->discount->calculate($this->amount);
    }
}

$order = new Order(100, new KDVDiscount());
echo $order->checkout();
