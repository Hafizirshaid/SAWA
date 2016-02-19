<?php

/*
 * This code written by Hafiz K.Irshaid 
 * Najah National University 
 * Computer Engineering Department
 * Date :  Oct 2, 2013
 */


/**
 * Description of Databse_connection
 *  
 * @author Hafiz
 */
class Databse_connection 
{
    private $database_name = "sawa3";
    private $username = "root";
    private $password = "";
    private $server_ip = "localhost";
    private $connection;
    function __construct() 
    {   
        //connect to mysql database
        @$db = mysqli_connect($this->server_ip, $this->username, 
                $this->password, $this->database_name);
        $this->connection = $db;
    }
    
    /**
     * to return database connection
     */
    public function return_database_conncection()
    {
        return $this->connection;
    }
    
}
?>
