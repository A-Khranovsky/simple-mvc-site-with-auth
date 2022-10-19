<?php


namespace App\Services;


class Logout
{
    public function __invoke(): void
    {
        //mysql_query("UPDATE users SET online=0 WHERE id='$id'"); //обнуляется поле online, говорящее, что пользователь вышел с сайта (пригодится в будущем)
        session_destroy();
        setcookie("login", "", -1, '/');
        setcookie("password", "", -1, '/');
    }
}
