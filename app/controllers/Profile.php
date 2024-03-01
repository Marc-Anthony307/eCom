<?php
namespace app\controllers;

class Profile extends \app\core\Controller
{

    public function index()
    {
        //make sure tht the user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('location:/User/login');
            return;
        }

        $profile = new \app\models\Profile();
        $profile = $profile->getForUser($_SESSION['user_id']);


        //redirect a user that has no profile to the profile creation URL
        if ($profile) {
            $this->view('Profile/index', $profile);

        } else {
            header('location:/Profile/create');
        }

    }

    public function create()
    {
        //check that user is logged in...
        if (!isset($_SESSION['user_id'])) {
            header('location:/User/login');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {   //data is submitted through POST, the '===' checks the data type
            //make a new profile object
            $profile = new \app\models\Profile();
            //populate that profile 
            $profile->user_id = $_SESSION['user_id'];
            $profile->first_name = $_POST['first_name'];
            $profile->last_name = $_POST['last_name'];
            //insert it 
            $profile->insert();
            //redirect
            header('location:/Profile/index');
        } else {
            $this->view('Profile/create');
        }
    }

    public function modify()
    {
        //check that user is logged in...
        if (!isset($_SESSION['user_id'])) {
            header('location:/User/login');
            return;
        }

        $profile = new \app\models\Profile();
        $profile = $profile->getForUser($_SESSION['user_id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {   //data is submitted through POST, the '===' checks the data type
            //populate that profile 
            $profile->first_name = $_POST['first_name'];
            $profile->last_name = $_POST['last_name'];
            //insert it 
            $profile->update();
            //redirect
            header('location:/Profile/index');
        } else {
            $this->view('Profile/modify', $profile);
        }
    }

    //delete
    public function delete()
    {
        //check that user is logged in...
        if (!isset($_SESSION['user_id'])) {
            header('location:/User/login');
            return;
        }

        //present the user with a form to confirm the deletion that is requested and delete if the form is submitted
        $profile = new \app\models\Profile();
        $profile = $profile->getForUser($_SESSION['user_id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $profile->delete();
            header('location:/Profile/index');
        } else {
            $this->view('Profile/delete', $profile);
        }
    }
}