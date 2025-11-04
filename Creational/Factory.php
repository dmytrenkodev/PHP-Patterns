<?php

// Delegate the creation of objects to subclasses or a factory,
// keeping the client code independent of concrete implementations.
//
// Use when:
// You need to create different types of related objects.
// + Makes code flexible, easier to extend.
// - Logic can grow large — consider Dependency Injection containers instead.

interface Notifier
{
    public function send(string $msg): void;
}

class EmailNotifier implements Notifier
{
    public function send(string $msg): void
    {
        /* send email */
    }
}

class SmsNotifier implements Notifier
{
    public function send(string $msg): void
    {
        /* send SMS */
    }
}

class NotifierFactory
{
    public static function create(string $type): Notifier
    {
        return match ($type) {
            'email' => new EmailNotifier(),
            'sms' => new SmsNotifier(),
            default => throw new InvalidArgumentException("Unknown notifier type"),
        };
    }
}

$notifier = NotifierFactory::create('email');
$notifier->send('Hello!');
