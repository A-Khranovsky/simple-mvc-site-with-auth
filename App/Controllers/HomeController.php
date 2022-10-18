<?php

namespace App\Controllers;

use App\Services\Enter;
use App\Services\Login;
use App\Services\Logout;
use App\Views\Home;
use App\Views\View;

class HomeController extends Controller
{
    private View $home;

    public function __construct()
    {
        $this->home = new Home;
        session_start();
    }

    public function auth(...$params): array|string
    {
        if (call_user_func(new Login) === true) {
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/api/home');
            return $this->home->home()->render();
        } else {
            return $this->home->authForm()->render();
        }
    }

    public function home(...$params): array|string
    {
        if(call_user_func(new Login) === true) {
            if (isset($params['action'])) {
                if ($params['action'] === 'out') {
                    call_user_func(new Logout);
                    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/api/auth');
                    return $this->home->authForm()->render();
                }
            } else {
                return $this->home->home()->render();
            }
        } else {
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/api/auth');
            return $this->home->authForm()->render();
        }
    }

    public function login(...$params): array|string
    {
        $enter = new Enter($params['user'], $params['password']);
        if (empty(call_user_func($enter))) {
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/api/home');
            return $this->home->home()->render();
        } else {
            return $this->home->error($enter->error)->render();
        }
    }
}
