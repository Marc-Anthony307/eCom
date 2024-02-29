<?php
namespace app\core;

class App{

    private $routes = [];

    public function addRoute($url,$handler){
        $url = preg_replace('/{([^\/]+)}/', '(?<$1>[^\/]+)', $url);
        $this->routes[$url] = $handler;
    }
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
                    'Bob/greet' => 'Person,greet',
                    'Person/watch' => 'Person,watch',
                    'Person/register' => 'Person,register',
                    'Person/complete_registration' => 'Person,complete_registration',
                    'Person/' => 'Person,list',
                    'Person/delete' => 'Person,delete',
                    'Person/edit/{id}' => 'Person,edit',
                    'Person/update' => 'Person,update',
                    'User/register' => 'User,register',
                    'User/login' => 'User,login',
                    'User/logout' => 'User,logout',
                    'User/update' => 'User,update',
                    'User/securePlace' => 'Profile,index',
                    'Profile/index' => 'Profile,index']; 

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
        //$controller = new \app\controllers\Person();
        //$controller->greet_again();//call greet_again from the $controller object
    }
}
