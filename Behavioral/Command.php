<?php

// Encapsulate a request as an object — allows parameterization, queuing, undo/redo.
//
// Use when:
// You want queueable, repeatable operations.
// + Enables undo/redo, logging, async execution.
// - Adds more boilerplate.

interface Command
{
    public function execute(): void;
}

class SendEmailCommand implements Command
{
    public function __construct(private string $to, private string $body)
    {
    }

    public function execute(): void
    {
        echo "Sending email to {$this->to}\n";
    }
}

class CommandQueue
{
    private array $commands = [];

    public function push(Command $cmd): void
    {
        $this->commands[] = $cmd;
    }

    public function run(): void
    {
        foreach ($this->commands as $cmd) {
            $cmd->execute();
        }
    }
}

$q = new CommandQueue();
$q->push(new SendEmailCommand('user@example.com', 'Welcome!'));
$q->run();
