<?php


namespace App\Services;


use App\models\User;

class Enter
{
    public array $error;
    public function __construct($login, $password)
    {
        $user = new User;
        $user = $user->getAllByLogin($login);

        if ($login != "" && $password != "") {
            if ($user) {
                if (sha1($password) === $user['password']) {
                    setcookie("login", $user['login'], time() + 50000);
                    setcookie("password", $user['password'], time() + 50000);
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['login'] = $user['login'];
                    //$this->id = $_SESSION['id'];
                    $this->error = [];
                } else {//если пароли не совпали
                    $this->error[] = "Неверный пароль";
                }
            } else {//если такого пользователя не найдено в базе данных
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