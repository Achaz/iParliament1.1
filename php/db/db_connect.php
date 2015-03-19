<?php
    
	
	class ConnectDB{
		private $con; 

	    function __construct() {
	        $this->connect();
	    }
	
	    function __destruct() {
	        $this->close();
	    }
	
	    function connect() {
	    	
	        require_once __DIR__ . '/db_config.php';
	
	        $this->con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE) or die(mysql_error());
	        return $this->con;
	    }
	
	    function close() {
	        mysqli_close($this->con);
	    }	
	}



?>