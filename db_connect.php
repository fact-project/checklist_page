<?php
    function db_connect() {

        // Define connection as a static variable, to avoid connecting more than once
        static $connection;

        // Try and connect to the database, if a connection has not been established yet
        if(!isset($connection)) {
             // Load configuration as an array. Use the actual location of your configuration file
            $config = parse_ini_file('../config.ini');
            $connection = mysqli_connect('localhost',$config['username'],$config['password'],$config['dbname']);
        }

        // If connection was not successful, handle the error
        if($connection === false) {
            // Handle error - notify administrator, log to a file, show an error screen, etc.
            return mysqli_connect_error();
        }
        return $connection;
    }

    function db_query($query) {
        // Connect to the database
        $connection = db_connect();

        // Query the database
        $result = mysqli_query($connection,$query);

        return $result;
    }

    function db_error() {
        $connection = db_connect();
        return mysqli_error($connection);
    }

    function db_create_table(){
        $result = db_query("
            CREATE TABLE park_checklist_filled (
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                username VARCHAR(100),
                created TIMESTAMP DEFAULT NOW()
            );
        ");
    };

    function db_quote($value) {
        $connection = db_connect();
        return "'" . mysqli_real_escape_string($connection,$value) . "'";
    }

    function db_user_filled_checklist($username){
        db_query("INSERT INTO `park_checklist_filled` (`username`) VALUES (" . db_quote($username) . ")");
    };

?>


