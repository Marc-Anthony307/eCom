<?php
spl_autoload_register(

function($class_name){
    //version 0.1 PSR-4 autoloader
    //for compatibility replace FQNC (\) seperator by DIRECTORY_SEPARATOR. (\ or /)
    $class_name = str_replace('\\', DIRECTORY_SEPERATOR, $class_name);
    // app\controllers\Person

    if(file_exists($class_name.'.php')){
        require_once($class_name . '.php');
        return true;
    }
    else{
        return false;
    }
}
);