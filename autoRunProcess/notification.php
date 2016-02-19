<?php

/*
 * This code is written by Mustafa Shbere
 * An-Najah National University 
 * Computer Engineering Department
 * Date :  Oct 2, 2013
 */


/**
 * Description of the Notification table 
 * Notification class contains all the information related to sudden event 
 * @author Mustafa
 */
 
class Notification
{
    protected $userId;
	protected $tripId;
	protected $body;
    protected $position;
	protected $notification_date; 
    public $database_connection;
    
   /**
    * This constructor is to initialize the database
    * 
    * */
    public function __construct()
    {
        //Include database connection file and get the connection reference.
        include_once ("/../Database_connection.php");
        $database = new Databse_connection();
        $this->database_connection = $database->return_database_conncection();
    }

    public function commit()
    {
        $query = "update sawa.notification set where userID='".$this->userId."' and tripId='".$this->tripId."'";
        $this->database_connection -> query($query);
    }
  
    public function initWithData($userId, $tripId, $body, $position)
    {
		$this->userId = $userId;
		$this->tripId = $tripId;
        $this->body = $body;
		$this->position = $position;
        //Insert into database	
        $res = $this->insert_notification_into_database();
        if($res)
        {
            return true;
		}
		else
        {
            return false;
		}
    }
    
    /**
     * 
     * 
     * This function inserts class attibutes in the notification table
     */
    private function insert_notification_into_database()
    {
		$date = getdate("yyyy-mm-dd");
        $this->notification_date = $date;
        //Query to insert this notification in the database
        $query = "insert into sawa.notification values ('".$this->userID."','".$this->tripId."',
                '".$this->body."', '".$this->notification_date."','".$this->position."')";
        
        //Execute the query 
        $result = $this-> database_connection -> query($query);
        if($result)
        {
            return true;
        }else 
			{
            return false;
			}
    }
    /**
     * 
     * 
     * 
     * @todo validate all setters 
     */
    
     
    /**
     * Setter and getter for userId 
     */
    public function set_userId($userId)
    {
        $this->userId = $userId;//From session variable
    }
    public function get_userId()
    {
        return $this->userId;
    }
	
	/**
     * setter and getter for tripId
     */
    public function set_tripId($tripId)
    {
        $this->tripId = $tripId;
    }
    public function get_tripId()
    {
        return $this->tripId;
    }
    
    /**
     * Setter and getter for notification body
     */
    public function set_body($body)
    {
        $this->body = $body;
    }
    public function get_body()
    {
        return $this->body;
    }
    
    
    /**
     * setter and getter for position
     * 
     */
    public function set_position($position)
    {
        $this->position = $position;
    }
    public function get_position()
    {
        return $this->position;
    }
    
    /**
     * Destructor to close the database connection
     */
    public function __destruct()
    {
        //close database connection 
        mysqli_close($this->database_connection);
    }
}

?>
