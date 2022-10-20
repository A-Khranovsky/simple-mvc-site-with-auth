<?php

namespace App\Router;

use Exception;

class Router
{
    public string $queryType;
    public array|null $queryParams;
    public array|string|null $controllerAction = null;
    public string|null $controller = null;

    private const uriTemplate = [
        'resource' => null,
        'idOrAction' => null,
        'action' => null,
        'queryParams' => []
    ];

    /**
     * @throws Exception
     */
    public static function run(string $uri): Router
    {
        $id = null;
        $action = null;
        $uriElements = [];
        if (str_contains($uri, '?')) {
            $uri = array_slice(preg_split("/[\/?]/", $uri), 1);
            array_pop($uri);
        } else {
            $uri = array_slice(preg_split("/[\/?]/", $uri), 1);
        }
        foreach (Router::uriTemplate as $key => $item) {
            $uriElements[$key] = current($uri) !== false ? current($uri) : null;
            next($uri);
        }
        if (is_null($uriElements['resource'])) {
            throw new Exception('Not found', 404);
        }
        switch (true) {
            case (int)$uriElements['idOrAction']:
                $id = (int)$uriElements['idOrAction'];
                break;
            case (string)$uriElements['idOrAction']:
                $action = (string)$uriElements['idOrAction'];
                break;
            default:
                break;
        }
        if (is_null($action)) {
            $action = $uriElements['action'];
        }
        return new self(
            $uriElements['resource'],
            $id,
            $action
        );
    }

    /**
     * @throws Exception
     */
    public function __construct(
        public string $resource,
        public int|null $id = null,
        public string|null $action = null,
    ) {
        $this->queryParams = match (true) {
            !empty($_REQUEST) => $_REQUEST, // get method
            !empty(file_get_contents("php://input")) => file_get_contents("php://input"),
            default => [],
        };
        $this->queryType = $_SERVER['REQUEST_METHOD'];
        if ($this->queryType == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
            if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
                $this->queryType = 'DELETE';
            } elseif ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
                $this->queryType = 'PUT';
            } else {
                throw new Exception("Unexpected Header", 500);
            }
        }
    }
}
