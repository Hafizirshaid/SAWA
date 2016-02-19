<?php

/*
 * This code is written by Mustafa Shbere
 * An-Najah National University 
 * Computer Engineering Department
 * Date :  Oct 2, 2013
 */


/**
 * Description of the Statistics  table 
 * Statistics class contains all the information related to the user manually entered statistics  
 * @author Mustafa
 */
 
class Statistics 
{
    
	protected $accidentsRate;
	protected $gasUsage;
    protected $roadLong;
    protected $timePeriod;
    protected $userId;
	protected $statistics_date; 
	protected $tripId;
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
        $query = "update sawa.userstat set where userID='".$this->userId."' and tripId='".$this->tripId."'";
        $this->database_connection -> query($query);
    }
  
    public function initWithData($accidentsRate, $gasUsage, $roadLong, $timePeriod, $userId, $tripId)
    {
		$this->accidentsRate = $accidentsRate;
        $this->gasUsage = $gasUsage;
		$this->roadLong = $roadLong;
		$this->timePeriod = $timePeriod;
        $this->userId = $userId;
		$this->tripId = $tripId;        
        //Insert into database	
        $res = $this->insert_rating_into_database();
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
     * This function inserts class attibutes in the statistics  table
     */
    private function insert_rating_into_database()
    {
		$date = getdate("yyyy-mm-dd");
        $this->statistics_date = $date;
        //Query to insert this statistics  in the database
        $query = "insert into sawa.userstat values ('".$this->accidentsRate."','".$this->gasUsage."',
                '".$this->roadLong."', '".$this->timePeriod."','". $this->userId."', '". $this->statistics_date."','".$this->tripId."')";
        
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
     * This function returns statistics  for specific trip
     */
    public function get_statistics_by_tripId($id)
    {
        $query = "select * from sawa.userstat where tripId='".$id."'";
        
        $result = $this->database_connection-> query($query);
        
		$row = $result->fetch_assoc();
        
        return $row;
        //Here you have to store the result in the member variables
    }
    
   
    
    /**
     * 
     * 
     * 
     * @todo validate all setters 
     */
    
     
    
    
    /**
     * Setter and getter for Accidents' rate
     */
    public function set_accidentsRate($accidentsRate)
    {
        $this->accidentsRate = $accidentsRate;
    }
    public function get_accidentsRate()
    {
        return $this->accidentsRate;
    }
    
    
    /**
     * setter and getter for gas usage
     * 
     */
    public function set_gasUsage($gasUsage)
    {
        $this->gasUsage = $gasUsage;
    }
    public function get_gasUsage()
    {
        return $this->gasUsage;
    }
    
    
    /**
     * setter and getter for road long 
     */
    public function set_roadLong($roadLong)
    {
        $this->roadLong = $roadLong;
    }
    public function get_roadLong()
    {
        return $this->roadLong;
    }
    
    /**
     * setter and getter for time period(time required to cross specific road)
     */
    public function set_timePeriod($timePeriod)
    {
        $this->timePeriod = $timePeriod;
    }
    public function get_timePeriod()
    {
        return $this->timePeriod;
    }
    
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
     * Destructor to close the database connection
     */
    public function __destruct()
    {
        //close database connection 
        mysqli_close($this->database_connection);
    }
}

?>
