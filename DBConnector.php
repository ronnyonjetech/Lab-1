<?php
     define('DB_SERVER','localhost');//we use the local machine
     define ('DB_USER', 'root');//USER IS THE ROOT
     define ('DB_PASS', '') ;  //DATA HAS NOT BEEN SET
     define ('DB_NAME','btc3205');    /*remember our database name*/
     class DBConnector{
     	public $conn;
     	/*we connect to our database inside our class constructor so we can create db connection when object is created
     	*/
     	function _construct(){
     		$this->conn =mysqli_connect (DB_SERVER,DB_USER,DB_PASS) or die("Error:" .mysqli_error());
     		mysqli_select_db(DB_NAME,$this->conn);
     	}
     	/*Once done with database reads,updates,deletes,This public function does exactly that.
     	*/
     	public function closeDatabase(){
     		mysqli_close($this->conn);
     	}
     }
?>