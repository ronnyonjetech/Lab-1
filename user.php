<?php
     include "authenticator.php";//new file included
     include "Crud.php";
     include_once "DBConnector.php";

     class User implements Crud,Authenticator {

          private $user_id;
          private $first_name;
          private $last_name;
          private $city_name;

          //new variables included
          private $username;
          private $password;
          
          
          function __construct($first_name, $last_name, $city_name, $username, $password) {
               $this->first_name = $first_name;
               $this->last_name = $last_name;
               $this->city_name = $city_name;
               $this->username=$username;
               $this->password=$password;
               
          }
            //lab 2 continuation
           public static function create(){
               $reflection=new ReflectionClass("User");
               $instance=$reflection->newInstanceWithoutConstructor();
               return $instance;
              /* $instance = new self();
               return $instance;*/
           }
          //getters and setters for the new variables
          //username setter
          public function setUsername($username){
               $this->username=$username;
          }
          //username getter
          public function getUsername(){
               return $this->username;
          }
          //password setter
          public function setPassword($password){
               $this->password=$password;
          }
          //password getter
          public function getPassword(){
               return $this->password;
          }

          public function setUserId($user_id) {
               $this->user_id = $user_id;
          }

          public function getUserId() {
               return $this->$user_id;
          }

          public function save() {
               $con = new DBConnector();
               $fn = $this->first_name;
               $ln = $this->last_name;
               $city = $this->city_name;
               $uname=$this->username;
               $this->hashPassword();
               $pass=$this->password;
               $res = mysqli_query($con->conn, "INSERT INTO user(first_name, last_name, user_city,username,password) VALUES('$fn','$ln','$city','$uname','$pass')") or die("Error : " .mysqli_error($con->conn));
               $con->closeDatabase();
               return $res;
          }

          public function readAll() {
               $con = new DBConnector();
               $res = mysqli_query($con->conn, "SELECT * FROM user");

               if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                         echo " " .$row['id']. " " .$row['first_name']. " " .$row['last_name']. " " .$row['user_city']. "<br>";
                    }
               }
               else {
                    echo "There are no records in the database";
               }
               $con->closeDatabase();
          }

          public function readUnique() {
               return null;
          }

          public function search() {
               return null;
          }

          public function update() {
               return null;
          }

          public function removeOne() {
               return null;
          }

          public function removeAll() {
               return null;
          }
          public function valiteForm(){
               //return true if the values are not empty
               $fn =$this->first_name;
               $ln=$this->last_name;
               $city=$this->city_name;
               if ($fn == ""|| $ln==""||$city=="") {
                    return false;
               }
               return true;
          }
          public function createFormErrorSessions(){
               session_start();
               $_SESSION['form_errors'] ="All fields are required";
          }
          //added functions
          public function hashPassword(){
               //inbuilt function password_hash hashes our password
               $this->password=password_hash($this->password, PASSWORD_DEFAULT);
          }
          public function isPasswordCorrect(){
               $con=new DBConnector;
               $found=false;
               $res =mysqli_query($con->conn,"SELECT * FROM user") or die("Error:".mysqli_error($con->conn));

               while ($row=mysqli_fetch_array($res)){
                    if(password_verify($this->getPassword(),$row['password'])&&$this->getUsername()==$row['username']){
                         $found=true;
                    }
               }
               //we close the database here
               $con->closeDatabase();
               return $found;
          }
          public function login(){
               if ($this->isPasswordCorrect()) {
                    //password is correct so we load the protected page
                    header("Location:private_page.php");
               }
          }
          public function createUserSession(){
               session_start();
               $_SESSION['username'] = $this->getUsername();
          }
          public function logout(){
               session_start();
               unset($_SESSION['username']);
               session_destroy();
               header("Location:lab1.php");
          }
          //task 22
          public function isUserExist($username){
               $users=$this->readAll();
               if(mysqli_num_rows($users)>0){
                    while ($row=mysqli_fetch_assoc($users)) {
                         if ($row['username']==$username) {
                              return true;
                         }
                         # code...
                    }
               }
          }
     }
?>