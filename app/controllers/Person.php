<?php
namespace app\controllers;

class Person extends \app\core\Controller{

	function greet(){
 		//data input
        //$personName = 'friend';
        //if(isset($_GET['personName'])){
           // $personName= $_GET['personName'];
        //} //?personName=Bob

		//data input
		$personName = (isset($_GET['personName'])?$_GET['personName']:'friend');
		$someArray = ['one','two','three'];//sequential array
		$assocArray = ['first_name'=>'Alice',
						'last_name'=>'Cooper'];//associative array (dictionary)
		$this->view('Person/greet', ['person_name'=>$personName,
						'numbers'=>$someArray,
						'profile'=>$assocArray]);
	}

	function watch(){
		echo "I've been watching you";
	}
	
	function greet_again(){
		//data input
		$personName = (isset($_GET['personName'])?$_GET['personName']:'friend');
		$someArray = ['one','two','three'];//sequential array

		$profileObj = new \stdClass();//profile Object
		$profileObj->first_name = 'Alice';
		$profileObj->last_name = 'Cooper';
		
		$this->view('Person/greet_again', ['person_name'=>$personName,
						'numbers'=>$someArray,
						'profile'=>$profileObj]);
	}

	function register(){
		//showing the register view
		$this->view('Person/register');
	}

	function complete_registration(){
		print_r($_POST);

		//call a view to sow the submitted data
		//collect the data
		$person = new \stdClass();
		$person->first_name = $_POST['first_name'];
		$person->last_name = $_POST['last_name'];
		$person->email = $_POST['email'];
		$person->weekly_flyer = in_array('weekly_flyer', $_POST['publications']);
		$person->mailing_list = in_array('mailing_list',$_POST['publications']);
		//$person->mailing_list = $_POST['mailing_list'] ?? 'unselected'; //null coalescing to avoid warning when no option of a radio button is selected
		//hypothetically insert into a database
		//show the feedback view
		$this->view('Person/complete_registration',$person);
	}
	//function view($name, $data){
        //load the view files to present them to the web user
        //include('app/views/' . $name . '.php');
    //}

}