<?php
namespace app\models;

use PDO;
class User extends \app\core\Model
{
    public $user_id;
    public $username;
    public $password_hash;

    //implement CRUD

    //insert
    public function insert(){
        //define the SQL query
        $SQL = 'INSERT INTO user (username, password_hash) VALUES (:username, :password_hash)';
        //prepare the statement
        $STMT = self::$_conn->prepare($SQL);
        //execute
        $data = ['username' => $this -> username, 'password_hash' => $this -> password_hash]; //"->" is like "." in java

        $STMT->execute($data);
    }
    //get
    public function get($username){
        $SQL = 'SELECT * FROM user WHERE username = :username';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['username' => $username]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\User');
        //choose the type of return from fetch
        return $STMT->fetch();
    }
    public function getById($user_id){
        $SQL = 'SELECT * FROM user WHERE user_id = :user_id';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['user_id' => $user_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\User');
        //choose the type of return from fetch
        return $STMT->fetch();
    }
    //update
    public function update() {
        //change anything but the Primary Key
        $SQL = 'UPDATE user SET username = :username, password_hash = :password_hash WHERE user_id = :user_id';
        
        $STMT = self::$_conn->prepare($SQL);
        $STMT -> execute((array)$this);
    }
    //delete
}