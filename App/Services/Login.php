<?php


namespace App\Services;


use App\Database\Database;
use App\models\User;

class Login
{
    //Checking if user is logged in
    private User $user;

    public function __construct()
    {
        $this->user = new User;
    }

    public function __invoke(): bool
    {
        if (isset($_SESSION['id'])) {
            if (isset($_COOKIE['login']) && isset($_COOKIE['password'])) {
                setcookie("login", "", time() - 1, '/');
                setcookie("password", "", time() - 1, '/');
                setcookie("login", $_COOKIE['login'], time() + 50000, '/');
                setcookie("password", $_COOKIE['password'], time() + 50000, '/');
                return true;
            } else {
                $user = $this->user->getAllById($_SESSION['id']);
                if ($user) {
                    setcookie("login", $user['login'], time() + 50000, '/');
                    setcookie("password", $user['password'], time() + 50000, '/');
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            if (isset($_COOKIE['login']) && isset($_COOKIE['password'])) {
                $user = $this->user->getAllByLogin($_COOKIE['login']);
                if ($user && $user['password'] == $_COOKIE['password']) {
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['login'] = $user['login'];
                    return true;
                } else {
                    setcookie("login", "", time() - 360000, '/');
                    setcookie("password", "", time() - 360000, '/');
                    return false;
                }
            } else {
                return false;
            }
        }
    }
}