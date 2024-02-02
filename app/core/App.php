<?php 
namespace app\core;

class App{

    function __construct(){
        //call the appropriate controller class and method to handle the HTTP Request
        echo "You have constructed your app object";
    }
}