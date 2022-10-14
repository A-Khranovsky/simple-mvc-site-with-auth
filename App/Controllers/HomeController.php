<?php

namespace App\Controllers;

use App\Models\Model;
use App\models\User;
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
    }

    public function home()
    {
        return $this->home->authForm()->render();
    }

    public function login(...$params)
    {
        return var_dump($params);
    }
}
