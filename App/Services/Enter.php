<?php


namespace App\Services;


use App\models\User;

class Enter
{
    public array $error;
    public function __construct($login, $pass)
    {
        $user = new User;
        $user = $user->getAllByLogin($login);

        if ($login != "" && $pass != "") {
            if ($user) {
                if (sha1($pass) === $user['password']) {
                    //setcookie("login", $user['login'], time() + 50000);
                    //setcookie("password", $user['password'], time() + 50000);
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['login'] = $user['login'];
                    $this->error = [];
                } else {
                    $this->error[] = "Неверный пароль";
                }
            } else {
                $this->error[] = "Неверный логин и пароль";
            }
        } else {
            $this->error[] = "Поля не должны быть пустыми!";
        }
    }

    public function __invoke()
    {
        return $this->error;
    }
}