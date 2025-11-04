<?php

// Provide a simplified interface to a complex subsystem.
//
// Use when:
// You want a single entry point to a complex workflow.
// + Simplifies usage.
// - Can hide too much, making debugging harder.

class UserRegistrationFacade
{
    public function register(array $data): void
    {
        // Internally calls multiple subsystems
        (new UserValidator())->validate($data);
        $user = (new UserRepository())->save($data);
        (new Mailer())->sendWelcome($user);
    }
}

$facade = new UserRegistrationFacade();
$facade->register(['email' => 'test@example.com']);
