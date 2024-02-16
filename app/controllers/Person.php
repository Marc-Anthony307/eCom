<?php
namespace app\controllers;

use stdClass;

class Person extends \app\core\Controller
{

	function list()
	{
		$people = \app\models\Person::getAll();
		$this->view('Person/list', $people);
	}

	/*
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
	*/

	function register()
	{
		//showing the register view
		$this->view('Person/register');
	}

	function complete_registration()
	{
		print_r($_POST);

		//call a view to sow the submitted data
		//collect the data]//declare a person object
		$person = new \app\models\Person();
		//populate the properties
		$person->first_name = $_POST['first_name'];
		$person->last_name = $_POST['last_name'];
		$person->email = $_POST['email'];
		$publications = $_POST['publications'] ?? []; //null coallesing
		$person->weekly_flyer = in_array('weekly_flyer', $_POST['publications']);
		$person->mailing_list = in_array('mailing_list', $_POST['publications']);
		//$person->mailing_list = $_POST['mailing_list'] ?? 'unselected'; //null coallesing to avoid warning when no option of a radio button is selected
		//hypothetically insert into a database
		//show the feedback view
		$person->insert(); // add person to data file

		//$this->view('Person/complete_registration',$person);

		//redirect the user back to the list
		header('location:/Person/');
	}
	//function view($name, $data){
	//load the view files to present them to the web user
	//include('app/views/' . $name . '.php');
	//}

	function delete()
	{
		// get the ID of the record to delete
		$id = $_GET['id'];
		// call the deletion on Person
		\app\models\Person::delete($id);
		//redirect the user to the updated list
		header('location:/Person/');
	}

	//get the relevant record and siaply it in a form to allow a user to modify the information
	//URL like http:localhost/Person/edit?id=0
	function edit()
	{
		// get the ID of the record to delete
		$id = $_GET['id'];
		//get that record
		$person = \app\models\Person::get($id);
		//get the updated information from the user...
		$this->view('Person/edit',$person);
	}

	function update(){
		//get the id
		$id = $_GET['id'];
		//get the record
		$person = \app\models\Person::get($id);
		//change the record fields (same as populating the data before insert)
		$person->first_name = $_POST['first_name'];
		$person->last_name = $_POST['last_name'];
		$person->email = $_POST['email'];
		$publications = $_POST['publications'] ?? [];
		$person->weekly_flyer = in_array('weekly_flyer', $publications);
		$person->mailing_list = in_array('mailing_list', $publications);
		//update the record in storage
		$person->update();
		//redirect to the list
		header('location:/Person/');
	}

}