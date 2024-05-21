<?php

/**
 * Single Responsibility Principle
 *  - A class should have only one reason to change, meaning that a class should have only one job.
 */
// BAD CODE
// class Order
// {
//     private $items = [];
//     private $totalPrice = 0;
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
//     public function printOrders()
//     {
//         $output = '';
//         foreach ($this->items as $item) {
//             $output .= $item['name'] . ' ' . $item['price'] . ' ' . $item['quantity'] . "\n";
//         }
//         echo $output;
//     }

//     public function saveDatabase()
//     {
//         // Save to database
//         echo "Saved to database";
//     }
// }

// $order = new Order();
// $order->addItem('Shirt', 50, 2);
// $order->addItem('Pant', 100, 1);
// $order->calculateTotalPrice();
// $order->printOrders();
// $order->saveDatabase();

// GOOD CODE
class Order
{
    private $items = [];
    private $totalPrice = 0;
    public function addItem($name = '', $price = 0, $quantity = 1)
    {
        $this->items[] = ['name' => $name, 'price' => $price, 'quantity' => $quantity];
    }
    public function getItems()
    {
        return $this->items;
    }
}
class OrderPrinter
{
    public function printOrders(Order $order)
    {
        $output = '';
        foreach ($order->getItems() as $item) {
            $output .= $item['name'] . ' ' . $item['price'] . ' ' . $item['quantity'] . "\n";
        }
        echo $output;
    }
}
class OrderCalculate
{
    public function calculateTotalPrice(Order $order)
    {
        $totalPrice = 0;
        foreach ($order->getItems() as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }
        echo $totalPrice . "\n";
    }
}
class OrderRepository
{
    public function saveDatabase(Order $order)
    {
        // Save to database
        echo "Saved to database";
    }
}

$order = new Order();
$order->addItem('Shirt', 50, 2);
$order->addItem('Pant', 100, 1);

$orderPrinter = new OrderPrinter();
$orderPrinter->printOrders($order);

$orderCalculate = new OrderCalculate();
$totalPrice = $orderCalculate->calculateTotalPrice($order);

$orderRepository = new OrderRepository();
$orderRepository->saveDatabase($order);
