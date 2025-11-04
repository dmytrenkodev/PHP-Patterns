<?php

// Pass a request along a chain of handlers; each handler decides whether to process or pass it on.
//
// Use when:
// You want multiple handlers to process a request in sequence.
// + Flexible, decoupled handlers (like middleware).
// - Harder to debug chain flow.

abstract class Handler
{
    private ?Handler $next = null;

    public function setNext(Handler $handler): Handler
    {
        $this->next = $handler;
        return $handler;
    }

    public function handle($request): void
    {
        $this->next?->handle($request);
    }
}

class AuthHandler extends Handler
{
    /**
     * @throws Exception
     */
    public function handle($request): void
    {
        if (!$request['user']) {
            throw new Exception("Unauthorized");
        }

        echo "Auth passed\n";
        parent::handle($request);
    }
}

class LoggingHandler extends Handler
{
    public function handle($request): void
    {
        echo "Logging request\n";
        parent::handle($request);
    }
}

$auth = new AuthHandler();
$log = new LoggingHandler();
$auth->setNext($log);
$auth->handle(['user' => 'John']);
