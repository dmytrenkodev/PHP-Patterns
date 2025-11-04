<?php

// Control access to an object by placing a proxy (intermediary)
// that can lazy-load, cache, or control permissions.
//
// Use when:
// You need lazy initialization or access control.
// + Saves resources, adds security.
// - Adds extra complexity.

interface Image
{
    public function display(): void;
}

class RealImage implements Image
{
    public function __construct(private string $file)
    {
        // Simulate heavy loading
        sleep(5);
    }

    public function display(): void
    {
        echo "Displaying {$this->file}\n";
    }
}

class ImageProxy implements Image
{
    private ?RealImage $real = null;

    public function __construct(private string $file)
    {
    }

    public function display(): void
    {
        if ($this->real === null) {
            $this->real = new RealImage($this->file); // Lazy load
        }

        $this->real->display();
    }
}

// Usage
$image = new ImageProxy("photo.jpg");
$image->display(); // Loads once
$image->display(); // Uses cached real image
