<?php


namespace App\Services;


use App\Database\Database;
use App\models\User;

class Login
{
    public function __ivnoke()
    {
        ini_set("session.use_trans_sid", true);
        session_start();
        $user = new User;
        if (isset($_SESSION['id'])) {
            if (isset($_COOKIE['login']) && isset($_COOKIE['password'])) {
                //если cookie есть, обновляется время их жизни и возвращается true
                SetCookie("login", "", time() - 1, '/');
                SetCookie("password", "", time() - 1, '/');
                setcookie("login", $_COOKIE['login'], time() + 50000, '/');
                setcookie("password", $_COOKIE['password'], time() + 50000, '/');
                $id = $_SESSION['id'];
                return true;
            } else //иначе добавляются cookie с логином и паролем, чтобы после перезапуска браузера сессия не слетала
            {
                $user = $user->getAllById($_SESSION['id']);
                if ($user) {
                    setcookie("login", $user['login'], time() + 50000, '/');
                    setcookie("password", md5($user['password']), time() + 50000, '/');
                    $id = $_SESSION['id'];
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            if (isset($_COOKIE['login']) && isset($_COOKIE['password'])) { //если куки существуют
                //запрашивается строка с искомым логином и паролем
                $user = $user->getAllById($_SESSION['id']);

                if ($user && md5($user['password']) == $_COOKIE['password']) {  //если логин и пароль нашлись в базе данных
                    $_SESSION['id'] = $user['id']; //записываем в сесиию id
                    $id = $_SESSION['id'];
                    return true;
                } else {//если данные из cookie не подошли, эти куки удаляются
                    SetCookie("login", "", time() - 360000, '/');
                    SetCookie("password", "", time() - 360000, '/');
                    return false;
                }
            } else {//если куки не существуют
                return false;
            }
        }
    }
}