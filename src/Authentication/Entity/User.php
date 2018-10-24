<?php

namespace Authentication\Entity;

use Authentication\Value\Email;
use Authentication\Value\Password;

class User
{
    /** @var Email */
    private $email;
    /** @var Password */
    private $password;

    private function __construct(Email $email, Password $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public static function createFromEmailAndPassword(string $email, string $password): self
    {
        return new self(
            Email::createFromString($email),
            Password::createFromPlainPassword($password)
        );
    }

    public function getEmail(): string
    {
        return $this->email->getEmail();
    }

    public function getPassword(): string
    {
        return $this->password->getHashedPassword();
    }

}
