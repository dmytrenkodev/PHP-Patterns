<?php

// Encapsulate interchangeable algorithms behind a common interface.
//
// Use when:
// You have multiple interchangeable behaviors.
// + Follows Open/Closed Principle (easily extendable).
// - Increases number of small classes.

interface ShippingStrategy
{
    public function calculate(float $weight): float;
}

class FedExStrategy implements ShippingStrategy
{
    public function calculate(float $weight): float
    {
        return 10 + $weight * 1.5;
    }
}

class UPSStrategy implements ShippingStrategy
{
    public function calculate(float $weight): float
    {
        return 8 + $weight * 2.0;
    }
}

class ShippingService
{
    public function __construct(private ShippingStrategy $strategy)
    {
    }

    public function cost(float $weight): float
    {
        return $this->strategy->calculate($weight);
    }
}

$service = new ShippingService(new FedExStrategy());
echo $service->cost(5);
