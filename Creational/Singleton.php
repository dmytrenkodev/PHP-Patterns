<?php

// Ensure that a class has only one instance and provide a global access point to it.
//
// Use when:
// You need only one instance (e.g., Logger, Config, Cache manager).
// - Avoid in modern apps — it breaks testability (global state).

final class Logger
{
    private static ?Logger $instance = null;

    // Private constructor prevents direct instantiation
    private function __construct()
    {
    }

    private function __clone()
    {
    }

    // Get the single instance
    public static function getInstance(): Logger
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function log(string $msg): void
    {
        file_put_contents('/tmp/app.log', $msg . PHP_EOL, FILE_APPEND);
    }
}

Logger::getInstance()->log("App started");
