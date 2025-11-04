<?php

// Create new objects by cloning existing ones instead of building from scratch.
//
// Use when:
// You have templates or expensive initialization.
// + Faster than reinitializing from scratch.
// - Deep cloning can get tricky for complex graphs.

class Report
{
    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function __clone()
    {
        // Deep copy for nested structures
        $this->data = unserialize(serialize($this->data));
    }
}

$base = new Report(['title' => 'Monthly', 'rows' => []]);
$copy = clone $base;
$copy->data['title'] = 'Copy of Monthly';
