<?php

class DB {

	protected static $connection = null;
	
	
	public function connect() {    
        // Try and connect to the database
        if(!isset(self::$connection)) {
            // Load configuration as an array. Use the actual location of your configuration file
            $config = parse_ini_file('config.ini'); 
            self::$connection = new mysqli('127.0.0.1',$config['username'],$config['password'],$config['dbname']);
        }

        // If connection was not successful, handle the error
        if(self::$connection === false) {
            // Handle error - notify administrator, log to a file, show an error screen, etc.
            return false;
        }
        return self::$connection;
    }
	
	public function query($query) {
        // Connect to the database
        $connection = $this -> connect();

        // Query the database
        $result = $connection -> query($query);

        return $result;
    }
	
	function escape($value) {
		$connection = $this->connect();
		return mysqli_real_escape_string($connection,$value);
	}
	
}