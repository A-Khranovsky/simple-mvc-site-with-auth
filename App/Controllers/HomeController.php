<?php

namespace App\Controllers;

use App\Models\Model;
use App\models\User;

class HomeController extends Controller
{
    private Model $user;

    public function __construct()
    {
        $this->user = new User;
    }

    public function home()
    {
        return $this->user->login('alex', SHA1('password'));
    }
}
