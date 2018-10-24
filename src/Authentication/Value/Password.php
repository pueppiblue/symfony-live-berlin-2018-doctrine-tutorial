<?php

namespace Authentication\Value;

class Password
{
    /** @var string */
    private $hashedPassword;

    private function __construct(string $plainPassword)
    {
        $this->hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);
    }

    public static function createFromPlainPassword(string $plainPassword): self
    {
        $password = new self($plainPassword);

        return $password;
    }

    public function getHashedPassword(): string
    {
        return $this->hashedPassword;
    }
}
