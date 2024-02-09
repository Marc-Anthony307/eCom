<?php
namespace app\core;

class App{
    function __construct(){
    	//call the appropriate controller class and method to handle the HTTP Request

        //transition to routing - later
        //example routing
        //Routing version 0.1
        $url = $_GET['url'];

        //defined a few routes "url" => "controller,method"
        $routes = ['Person/greet_again' => 'Person,greet_again',
                    'Person/greet' => 'Person,greet',
                    'bob' => 'Person,greet',
                    ''=> 'Person,greet',
                    'Person/watch' => 'Person,watch']; 

        //one by one compare the url to resolve the route
        foreach ($routes as $routeUrl => $controllerMethod){
            if($url == $routeUrl){
                [$controller, $method] = explode(',', $controllerMethod);
                $controller = '\\app\\controllers\\'.$controller;
                $controller = new $controller();
                $controller->$method();
                //make sure that we dont run a second route
                break;
            }
        }

        // switch($url) {
        //     case 'Person/greet_again':
        //         $controller = new \app\controllers\Person();
        //         $controller = greet_again();
        //         break;
        //     case 'Person/greet';
        //         $controller = new \app\controllers\Person();
        //         $controller = greet_again();
        //         break;
        //     default echo 'No Match!'; //this didnt work lol
        // }


        //hardcode a call to a controller method
        $controller = new \app\controllers\Person();
        $controller->greet_again();//call greet_again from the $controller object
    }
}