<?php
namespace app\filters;

#[\Attribute]
class Login implements \app\core\AccessFilter{    //TODO: extend from something

    public function redirected(){
        if (!isset($_SESSION['user_id'])) {
            header('location:/User/login');
            return true;
        }
        return false;   //not denied
    }
}