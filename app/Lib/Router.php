<?php

namespace app\Lib;

class Router
{
    /**
     * @var array
     */
    private $routes = [];

    /**
     * Router constructor.
     * @param array $routes
     */
    function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * @param $requestUri
     * @param $requestMethod
     * @return array
     * @throws \Exception
     */
    public function getController($requestUri, $requestMethod)
    {

        $controllerClassAndAction = [];

        // try to find controller in routes
        foreach ($this->routes as $route) {
            $controllerClass = $route['controller'];
            $action = isset($route['action'])
                ? $route['action'].'Action'
                : 'indexAction';

            // if method equals and path matches
            if (false !== ($arguments = $this->matchRoute($requestMethod, $requestUri, $route))) {
                $controllerClassAndAction = [
                    $controllerClass,
                    $action,
                    $arguments
                ];


                break;
            }
        }

        // controller by default
        if (empty($controllerClassAndAction)) {
            throw new \Exception('Not found');
            $controllerClassAndAction = [
                $this->routes['default']['controller'],
                'indexAction',
                [],
            ];
        }

        return $controllerClassAndAction;
    }

    /**
     * @param $requestMethod
     * @param $requestUri
     * @param array $route
     * @return array
     */
    private function matchRoute($requestMethod, $requestUri, array $route)
    {
        if ($route['method'] === $requestMethod
            && preg_match('#'.$route['path'].'#', $requestUri, $matches)) {

            array_shift($matches);

            return $matches;
        }

        return false;
    }
} 