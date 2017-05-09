<?php
require_once(dirname(__FILE__) . '/Router.php');
class App
{
    private $router;

    function __construct()
    {
        $this->router = new Router();
        $this->router->get('/', function () {
            echo "Home page";
        });
        $this->router->get('/index', function () {
            echo "Index page";
        });

        $this->router->post('/create', function () {
            echo "Create funtion";
        });

        $this->router->any('/any', function () {
            echo "Any funtion";
        });

        $this->router->any('*', function () {
            echo "404 Not Found";
        });
    }

    function run()
    {
        $this->router->run();
    }
}