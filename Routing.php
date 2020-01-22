<?php
require_once 'Controllers/SecurityController.php';
require_once 'Controllers/ErrorController.php';
require_once 'Controllers/MainController.php';
require_once 'Controllers/DetailsController.php';


class Routing
{
    private  $routes = [];

    public function __construct()
    {
        $this->routes = [
            "login"=>[
                "controller"=>"SecurityController",
                "action"=>"login"
            ],"register"=>[
                "controller"=>"SecurityController",
                "action"=>"register"
            ],"reminder"=>[
                "controller"=>"SecurityController",
                "action"=>"reminder"
            ],
            "logout"=>[
                "controller"=>"SecurityController",
                "action"=>"logout"
            ],
            "summary"=>[
                "controller"=>"MainController",
                "action"=>"summary"
            ],
            "contact"=>[
                "controller"=>"DetailsController",
                "action"=>"contact"
            ],
            "user"=>[
                "controller"=>"DetailsController",
                "action"=>"userDetails"
            ],
            "choose_product"=>[
                "controller"=>"MainController",
                "action"=>"chooseProduct"
            ],
            "products"=>[
                "controller"=>"MainController",
                "action"=>"getProducts"
            ],
            "delete_product"=>[
                "controller"=>"MainController",
                "action"=>"deleteProduct"
            ],
            "add_product"=>[
                "controller"=>"MainController",
                "action"=>"addProduct"
            ],
            "get_summary"=>[
                "controller"=>"MainController",
                "action"=>"getSummary"
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