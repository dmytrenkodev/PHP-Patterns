<?php

// Convert one interface into another that clients expect. Acts as a “translator”.
//
// Use when:
// You need to connect incompatible interfaces.
// + Allows reusing legacy code without modification.
// - Adds an extra layer of abstraction.

// Legacy API
class LegacyPayment
{
    public function sendPayment($amount): bool
    {
        /* legacy call */
    }
}

// New unified interface
interface PaymentInterface
{
    public function pay(float $amount): bool;
}

// Adapter
class LegacyPaymentAdapter implements PaymentInterface
{
    public function __construct(private LegacyPayment $legacy)
    {
    }

    public function pay(float $amount): bool
    {
        return $this->legacy->sendPayment($amount);
    }
}

$payment = new LegacyPaymentAdapter(new LegacyPayment());
$payment->pay(100.0);
