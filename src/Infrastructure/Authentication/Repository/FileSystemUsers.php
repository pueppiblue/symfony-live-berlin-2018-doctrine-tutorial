<?php

namespace Infrastructure\Authentication\Repository;

use Authentication\Entity\User;
use Authentication\Repository\Users;

class FileSystemUsers implements Users
{
    /** @var string $path */
    private $path;


    public function __construct(string $path = null)
    {
        $this->path = $path ?? __DIR__.'/../../../data/';
    }

    public function get(string $emailAddress): User
    {
        $file = $this->path.$emailAddress;

        if (file_exists($file)) {
            return unserialize(file_get_contents($file), User::class);
        }

        throw new \Exception('User not found');

    }

    public function store(User $user): void
    {
        $file = $this->path.$user->getEmail();
        if (file_exists($file)) {
            throw new \Exception('User already exists.');
        }

        file_put_contents($file, serialize($user));
    }

    public function exists(string $email): bool
    {
        $file = $this->path.$email;

        return file_exists($file);
    }
}
