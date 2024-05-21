<?php

/**
 * Liskov Substitution Principle
 * - Objects in a program should be replaceable with instances of their subtypes without affecting the correctness of the program.
 */
// BAD CODE
// class Order
// {
//     protected $totalPrice = 0;
//     protected $items = [];
//     public function addItem($name = '', $price = 0, $quantity = 1)
//     {
//         $this->items[] = ['name' => $name, 'price' => $price, 'quantity' => $quantity];
//     }
//     public function calculateTotalPrice()
//     {
//         $this->totalPrice = 0;
//         foreach ($this->items as $item) {
//             $this->totalPrice += $item['price'] * $item['quantity'];
//         }
//         return $this->totalPrice;
//     }
// }

// class SpecialOrder extends Order
// {
//     public function addItem($name = '', $price = 0, $quantity = 1)
//     {
//         if ($price < 0) {
//             throw new Exception('Price cannot be negative');
//         }
//         parent::addItem($name, $price, $quantity);
//     }
// }

// class Controller
// {
//     public function __construct(Order $order)
//     {
//         echo $order->calculateTotalPrice() . "\n";
//     }
// }



// $order = new Order();
// $order->addItem('Order Shirt', 50, 2);
// $controller = new Controller($order);

// $specialOrder = new SpecialOrder();
// $specialOrder->addItem('Special Shirt', -150, 2);
// $controller = new Controller($specialOrder);

// GOOD CODE
interface Order
{
    public function addItem($name = '', $price = 0, $quantity = 1);
    public function calculateTotalPrice();
}

class NormalOrder implements Order
{
    protected $totalPrice = 0;
    protected $items = [];
    public function addItem($name = '', $price = 0, $quantity = 1)
    {
        $this->items[] = ['name' => $name, 'price' => $price, 'quantity' => $quantity];
    }
    public function calculateTotalPrice()
    {
        $this->totalPrice = 0;
        foreach ($this->items as $item) {
            $this->totalPrice += $item['price'] * $item['quantity'];
        }
        return $this->totalPrice;
    }
}

class SpecialOrder implements Order
{
    protected $totalPrice = 0;
    protected $items = [];
    public function addItem($name = '', $price = 0, $quantity = 1)
    {
        if ($price < 0) {
            throw new Exception('Price cannot be negative');
        }
        $this->items[] = ['name' => $name, 'price' => $price, 'quantity' => $quantity];
    }
    public function calculateTotalPrice()
    {
        $this->totalPrice = 0;
        foreach ($this->items as $item) {
            $this->totalPrice += $item['price'] * $item['quantity'];
        }
        return $this->totalPrice;
    }
}

class Controller
{
    public function __construct(Order $order)
    {
        echo $order->calculateTotalPrice() . "\n";
    }
}

$order = new NormalOrder();
$order->addItem('Order Shirt', 50, 2);
$controller = new Controller($order);

$specialOrder = new SpecialOrder();
$specialOrder->addItem('Special Shirt', -150, 2);
$controller = new Controller($specialOrder);
