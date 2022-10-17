<?php


namespace App\Services;


use App\Database\Database;
use App\models\User;

class Login
{
    private $result;
    public function __construct()
    {
        //ini_set("session.use_trans_sid", true);
//        session_start();
        $user = new User;
        if (isset($_SESSION['id'])) {
            if (isset($_COOKIE['login']) && isset($_COOKIE['password'])) {
                setcookie("login", "", time() - 1, '/');
                setcookie("password", "", time() - 1, '/');
                setcookie("login", $_COOKIE['login'], time() + 50000, '/');
                setcookie("password", $_COOKIE['password'], time() + 50000, '/');
                //$id = $_SESSION['id'];
                $this->result = true;
            } else {
                $user = $user->getAllById($_SESSION['id']);
                if ($user) {
                    setcookie("login", $user['login'], time() + 50000, '/');
                    setcookie("password", sha1($user['password']), time() + 50000, '/');
                    //$id = $_SESSION['id'];
                    $this->result = true;
                } else {
                    $this->result = false;
                }
            }
        } else {
            if (isset($_COOKIE['login']) && isset($_COOKIE['password'])) {

                $user = $user->getAllById($_SESSION['id']);
                if ($user && sha1($user['password']) == $_COOKIE['password']) {
                    $_SESSION['id'] = $user['id']; //записываем в сесиию id
                    $_SESSION['login'] = $user['login'];
                    //$id = $_SESSION['id'];
                    $this->result = true;
                } else {
                    setcookie("login", "", time() - 360000, '/');
                    setcookie("password", "", time() - 360000, '/');
                    $this->result = false;
                }
            } else {
                $this->result = false;
            }
        }
    }

    public function __invoke()
    {
        return $this->result;
    }
}