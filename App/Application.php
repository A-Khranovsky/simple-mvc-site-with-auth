<?php


namespace App;


use App\Controllers\Controller;
use App\Database\Database;
use App\Models\Model;
use App\models\User;
use App\Router\Route;
use App\Router\Router;

class Application
{
    public array|string|null  $controllerActionResult;
    /**
     * @throws \Exception
     */
    public function __construct($connection, $uri)
    {
        $db = new Database($connection);
        $router = Router::run($uri);
        Route::take()->run($router);
        Model::run($db);
        $this->controllerActionResult = Controller::run(
            $router->resource,
            $router->id,
            $router->controllerAction,
            $router->queryParams
        );
        //$user = new User($db);
    }
}