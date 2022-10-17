<?php

namespace App\Controllers;

use App\Models\Model;
use App\models\User;
use App\Services\Enter;
use App\Services\Login;
use App\Services\Logout;
use App\Views\Home;
use App\Views\View;

class HomeController extends Controller
{
    private Model $user;
    private View $home;

    public function __construct()
    {
        $this->user = new User;
        $this->home = new Home;
        session_start();
    }

    public function auth(...$params)
    {
        return $this->home->authForm()->render();
    }

    public function home(...$params)
    {
        if ($params['action'] === 'out') {
            call_user_func(new Logout);
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/api/auth');
            return $this->home->authForm()->render();
        } else {
            //header('Location: http://' . $_SERVER['HTTP_HOST'] . '/api/home');
            return $this->home->home()->render();
        }
    }

    public function login(...$params)
    {
        $enter = new Enter($params['user'], $params['password']);
        if (empty(call_user_func($enter))) {
            if (new Login) {
                header('Location: http://' . $_SERVER['HTTP_HOST'] . '/api/home');
                return $this->home->home()->render();
            } else {
                return 'not logged in';
            }
        } else {
            return $this->home->error($enter->error)->render();
        }
        //return call_user_func($e);
    }
}
