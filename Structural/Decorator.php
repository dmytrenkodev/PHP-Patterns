<?php

// Attach new behaviors to objects dynamically by wrapping them in other objects.
//
// Use when:
// You want to add responsibilities dynamically.
// + Highly flexible, composable.
// - Too many decorators can make debugging hard.

interface Notifier
{
    public function send(string $msg): void;
}

class BasicNotifier implements Notifier
{
    public function send(string $msg): void
    {
        // send basic notification
    }
}

// Decorator adds logging
class LoggingNotifier implements Notifier
{
    public function __construct(private Notifier $notifier)
    {
    }

    public function send(string $msg): void
    {
        error_log("Sending message: $msg");
        $this->notifier->send($msg);
    }
}

$notifier = new LoggingNotifier(new BasicNotifier());
$notifier->send('Hello!');
