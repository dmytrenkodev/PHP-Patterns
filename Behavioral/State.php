<?php

// Allow an object to change its behavior when its internal state changes.
//
// Use when:
// Object’s logic changes by its internal state.
// + Cleaner transitions, avoids big switch statements.
// - More classes to manage.

interface OrderState
{
    public function proceed(Order $order): void;
}

class NewState implements OrderState
{
    public function proceed(Order $order): void
    {
        $order->setState(new PaidState());
        echo "Order paid\n";
    }
}

class PaidState implements OrderState
{
    public function proceed(Order $order): void
    {
        $order->setState(new ShippedState());
        echo "Order shipped\n";
    }
}

class ShippedState implements OrderState
{
    public function proceed(Order $order): void
    {
        echo "Already shipped\n";
    }
}

class Order
{
    private OrderState $state;

    public function __construct()
    {
        $this->state = new NewState();
    }

    public function setState(OrderState $state): void
    {
        $this->state = $state;
    }

    public function proceed(): void
    {
        $this->state->proceed($this);
    }
}

$order = new Order();
$order->proceed(); // Paid
$order->proceed(); // Shipped
