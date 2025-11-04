<?php

// Define a one-to-many relationship where dependent objects (observers)
// are automatically notified of state changes.
//
// Use when:
// You need to notify multiple subscribers dynamically.
// + Decouples event source and handlers.
// - Can get complex to trace execution order.

interface Observer
{
    public function update(string $event, $data): void;
}

class EventManager
{
    private array $listeners = [];

    public function subscribe(string $event, Observer $observer): void
    {
        $this->listeners[$event][] = $observer;
    }

    public function publish(string $event, $data = null): void
    {
        foreach ($this->listeners[$event] ?? [] as $listener) {
            $listener->update($event, $data);
        }
    }
}

class LoggerListener implements Observer
{
    public function update(string $event, $data): void
    {
        echo "Event $event received with data: " . json_encode($data) . "\n";
    }
}

$manager = new EventManager();
$manager->subscribe('user.created', new LoggerListener());
$manager->publish('user.created', ['id' => 1]);
