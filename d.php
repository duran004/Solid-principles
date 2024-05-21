<?php

/**
 * Dependency Inversion Principle
 * - High-level modules should not depend on low-level modules. Both should depend on abstractions.
 */
// BAD CODE
// class MySQLConnection
// {
//     public function save($data)
//     {
//         echo "Save data to MySQL database\n";
//     }
// }

// class OrderManager
// {
//     private $connection;
//     public function __construct(MySQLConnection $connection)
//     {
//         $this->connection = $connection;
//     }
//     public function saveOrder($order)
//     {
//         $this->connection->save($order);
//     }
// }

//GOOD CODE
interface OrderRepositoryInterface
{
    public function save($data);
}

class MySQLConnection implements OrderRepositoryInterface
{
    public function save($data)
    {
        echo "Save data to MySQL database\n";
    }
}
class MSSSQLConnection implements OrderRepositoryInterface
{
    public function save($data)
    {
        echo "Save data to MSSSQL database\n";
    }
}

class RedisConnection implements OrderRepositoryInterface
{
    public function save($data)
    {
        echo "Save data to Redis database\n";
    }
}

class OrderManager
{
    private $connection;
    public function __construct(OrderRepositoryInterface $connection)
    {
        $this->connection = $connection;
    }
    public function saveOrder($order)
    {
        $this->connection->save($order);
    }
}


$order = new OrderManager(new MSSSQLConnection());
$order->saveOrder('order 1');
