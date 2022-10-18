<?php


namespace App\Services;


class Logout
{
    public function __invoke()
    {
        //mysql_query("UPDATE users SET online=0 WHERE id='$id'"); //обнуляется поле online, говорящее, что пользователь вышел с сайта (пригодится в будущем)
        session_destroy();
        //setcookie("login", "", time() - 360000, '/');
        //setcookie("password", "", time() - 360000, '/');
    }
}
