<?php
require_once 'Controllers/SecurityController.php';
require_once 'Controllers/ErrorController.php';
require_once 'Controllers/MainController.php';


class Routing
{
    private  $routes = [];

    public function __construct()
    {
        $this->routes = [
            "login"=>[
                "controller"=>"SecurityController",
                "action"=>"login"
            ],
            "summary"=>[
                "controller"=>"MainController",
                "action"=>"summary"
            ]
        ];
    }


    public function route()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : "login";

        if(isset($this->routes[$page])) {

            $controller = $this->routes[$page]['controller'];
            $action = $this->routes[$page]['action'];

            $obj = new $controller;
            $obj->$action();

        }
        else{
            $obj = new ErrorController;
            $obj->error();
        }
    }
}