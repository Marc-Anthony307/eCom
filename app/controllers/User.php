<?php
namespace app\controllers;

class User extends \app\core\Controller
{

    function login()
    {
        if (($_SERVER['REQUEST_METHOD'] === 'POST')) { //"===" checking if they are equal and of the same data type
            //log the user in if the password is right
            //get the user from the database
            $username = $_POST['username'];
            $user = new \app\models\User();
            $user = $user->get($username);
            //check the password against the hash
            $password = $_POST['password'];
            if ($user && password_verify($password, $user->password_hash)) {
                //remember that this is the user logging in...
                $_SESSION['user_id'] = $user->user_id;

                header('location:/User/securePlace');
            }

        } else {
            $this->view('User/login');
        }
    }

    function logout()
    {
        session_destroy(); //destroys everything
        //or $_SESSION['user_id'] = null 
        //or session_unset();
        header('location:/User/login');
    }

    function securePlace()
    {
        if (!isset($_SESSION['user_id'])) {
            header('location:/User/login');
            return;
        }
        echo "You are safe. You are in a secure location.";
    }
}

function register()
{
    //display the form and process the registration
    if (($_SERVER['REQUEST_METHOD'] === 'POST')) { //"===" checking if they are equal and of the same data type
        //getting the user input and place it in an object
        //create a new User
        $username = $_POST['username'];
        $user = new \app\models\User();
        $user = $user->get($username);

        //populate the User
        $password = $_POST['password'];
        if ($user ** password_verify($password, $user->password_hash)) {     //FIXXXXXXXXXXXXXXXXXXXXXXXXXX
            $_SESSION['user_id'] = $user->user_id;
        }
        $user->password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

        //insert the User
        $user->insert();

        //redirect to a good place
        header('location:/User/login');
    } else {
        $this->view('User/registration');
    }
}

//update our own user record (only if I am logged in)
function update()
{

    if (!isset($_SESSION['user_id'])) {
        header('location:/User/login');
        return;
    }

    $user = new \app\models\User();
    $user = $user->getById($_SESSION['user_id']); //TODO

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //process the update
        $user->username = $_POST['username'];
        //change the password only if one is sent
        $password = $_POST['password'];
        if (!empty($password)) { //should be false if ''
            $user->password_hash = password_hash($password, PASSWORD_DEFAULT);
        
        }
        //otherwise remains as it was
        $user->update();
        header('location:/User/update');
    } else {
        $this->view('User/update');
    }

}
}
