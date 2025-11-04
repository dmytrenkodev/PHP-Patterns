<?php

// A factory that creates families of related objects without specifying their concrete classes.
//
// Use when:
// You have multiple implementations that must work in sync (families of objects).
// + Keeps compatibility between objects.
// - Overkill for simple projects.

interface PaymentFactory
{
    public function createClient(): PaymentClient;

    public function createLogger(): PaymentLogger;
}

class StripeFactory implements PaymentFactory
{
    public function createClient(): PaymentClient
    {
        return new StripeClient();
    }

    public function createLogger(): PaymentLogger
    {
        return new StripeLogger();
    }
}

class PaypalFactory implements PaymentFactory
{
    public function createClient(): PaymentClient
    {
        return new PaypalClient();
    }

    public function createLogger(): PaymentLogger
    {
        return new PaypalLogger();
    }
}

function processPayment(PaymentFactory $factory): void
{
    $client = $factory->createClient();
    $logger = $factory->createLogger();
}
