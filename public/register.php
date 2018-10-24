<?php

use Authentication\Entity\User;
use Infrastructure\Authentication\Repository\FileSystemUsers;

require_once __DIR__.'/../vendor/autoload.php';

// registering a new user:

// 1. check if a user with the same email address exists
// 2. if not, create a user
// 3. hash the password
// 4. send the email to confirm activation (we will just display it)
// 5. save the user

// Tip: discuss - email or saving? Chicken-egg problem


// registering a new user:
$email = $_POST['emailAddress'];
$plainPassword = $_POST['password'];


registerUser($email, $plainPassword);

function registerUser(string $email, string $plainPassword)
{
    $usersRepository = new FileSystemUsers();

    if (!$usersRepository->exists($email)) {
        $user = USER::createFromEmailAndPassword($email, $plainPassword);
        error_log( 'Email sent to user.' );

        try {
            $usersRepository->store($user);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } else {
        echo 'User already exists';
    }
}
