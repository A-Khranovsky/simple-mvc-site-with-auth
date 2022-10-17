<?php


namespace App\Services;


class Logout
{
    public function __invoke()
    {
        //session_start();
        //$id = $_SESSION['id'];

        //mysql_query("UPDATE users SET online=0 WHERE id='$id'"); //обнуляется поле online, говорящее, что пользователь вышел с сайта (пригодится в будущем)
        unset($_SESSION['id']); //удалятся переменная сессии
        unset($_SESSION['login']);
        SetCookie("login", ""); //удаляются cookie с логином
        SetCookie("password", ""); //удаляются cookie с паролем
    }
}
