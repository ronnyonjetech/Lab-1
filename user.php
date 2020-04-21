<?php
     include "Crud.php";
     class User implements Crud{
     	private $user_id;
     	private $first_name;
     	private $last_name;
     	private $city_name;
     
     //setter
     public function setUserId($user_id){
     	$this->user_id=$user_id;
     }
     //getter
     public function getUserId(){
     	return $this->user_id;
     }
     /*we have to implement all the methods of interface and those that arent we return null but those methods have to appear here in this method*/
     public function save(){
     	$fn=$this->first_name;
     	$ln=$this->last_name;
     	$city=$this->city_name;
     	$res=mysqli_query("INSERT INTO user(first_name,last_name,user_city)VALUES('$fn','$ln','$city')") or die("Error".mysqli_error());
     	return res;
     }
     public function readAll(){
     	return null;}
     public function readUnique(){
     	return null;
     }
     public function search(){
     	return null;
     }
     public function update(){
     	return null;
     }
     public function removeOne(){
     	return null;
     }
     public function removeAll(){
     	return null;
     }
 }
 ?>