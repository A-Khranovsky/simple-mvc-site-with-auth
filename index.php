<?php
//session_start();
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/App/Config/database.php');
require_once (__DIR__ . '/App/Config/routes.php');

use App\Application;

/** @var $connection */

$obj = new Application($connection, $_SERVER['REQUEST_URI']);

echo var_dump($_SESSION);

echo $obj->controllerActionResult;
