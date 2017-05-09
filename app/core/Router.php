<?php

/**
 * Created by PhpStorm.
 * User: toanht
 * Date: 5/6/17
 * Time: 11:17 PM
 */
class Router
{
    private $routers = [];

    function __construct()
    {
    }

    private function getRequestURL()
    {
        return $url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
    }

    private function getRequestMethod()
    {
        return $method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
    }

    private function addRouter($method, $url, $action)
    {
        $this->routers[] = [$method, $url, $action];
    }

    public function get($url, $action)
    {
        $this->addRouter('GET', $url, $action);
    }

    public function post($url, $action)
    {
        $this->addRouter('POST', $url, $action);
    }

    public function any($url, $action)
    {
        $this->addRouter('GET | POST', $url, $action);
    }

    public function map()
    {
        $requestUrl = $this->getRequestURL();
        $requestMethod = $this->getRequestMethod();

        foreach ($this->routers as $router) {
            list($method, $url, $action) = $router;

            if (strpos($method, $requestMethod) === FALSE) {
                continue;
            }

            if ($url === '*') {
                $checkRoute = true;
            } else {
                if (strcmp(strtolower($url), strtolower($requestUrl)) === 0) {
                    $checkRoute = true;
                } else {
                    continue;
                }
            }
            if ($checkRoute === true) {
                if (is_callable($action)) {
                    $action();
                }
                return;
            } else {
                continue;
            }

        }
        echo "404";
        return;
    }

    public function run()
    {
        $this->map();
    }
}