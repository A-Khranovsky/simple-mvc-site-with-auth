<?php

namespace App\Services;

use App\models\User;

class Enter
{
    public array $error;
    public function __construct(string $login, string $password)
    {
        $user = new User();
        $user = $user->getAllByLogin($login);

        if ($login != "" && $password != "") {
            if ($user) {
                if (sha1($password) === $user['password']) {
                    setcookie("login", $user['login'], time() + 50000, '/');
                    setcookie("password", $user['password'], time() + 50000, '/');
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['login'] = $user['login'];
                    $this->error = [];
                } else {
                    $this->error[] = "Wrong password";
                }
            } else {
                $this->error[] = "Wrong login and password";
            }
        } else {
            $this->error[] = "Login and password fields must not be empty";
        }
    }

    public function __invoke(): array
    {
        return $this->error;
    }
}
