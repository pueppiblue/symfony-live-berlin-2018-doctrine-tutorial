<?php

namespace Authentication\Value;


class Email
{
    /** @var string */
    private $email;

    private function __construct(string $email)
    {
        $this->email = $email;
    }

    public static function createFromString(string $email): self
    {
        return new self($email);
    }

    public function getEmail(): string
    {
        return $this->email;
    }

}
