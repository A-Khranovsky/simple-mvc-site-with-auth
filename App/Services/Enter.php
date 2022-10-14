<?php


namespace App\Services;


use App\models\User;

class Enter
{
    private array $error;
    private int $id;
    public function __construct($login, $password)
    {
        $user = new User;
        $user = $user->getAllLoginId($login);

        if ($login != "" && $password != "") { //если поля заполнены

            if ($user) {//если нашлась одна строка, значит такой юзер существует в базе данных
                exit(var_dump(md5($password), $user['password']));
                if (sha1($password) == $user['password']) {
                    setcookie("login", $user['login'], time() + 50000);
                    setcookie("password", sha1($user['password']), time() + 50000);
                    $_SESSION['id'] = $user['id'];
                    $this->id = $_SESSION['id'];
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
        return print_r($this->error);
    }
}