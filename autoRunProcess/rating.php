<?php

/*
 * This code is written by Mustafa Shbere
 * An-Najah National University 
 * Computer Engineering Department
 * Date :  Oct 2, 2013
 */


/**
 * Description of the rating table 
 * Rating class contains all the information related to the user behavior 
 * @author Mustafa
 */
 
class Rating
{
    protected $userId;
	protected $ratedBy;
	protected $total;
    protected $punctuality;
    protected $agreements;
    protected $wellBeing;
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
        $query = "update sawa.rating set where userID='".$this->userId."'";
        $this->database_connection -> query($query);
    }
  
    public function initWithData($userId, $ratedBy, $total, $punctuality, $agreements, $wellBeing, $tripId)
    {
		$this->userId = $userId;
        $this->ratedBy = $ratedBy;
		$this->total = $total;
		$this->punctuality = $punctuality;
        $this->agreements = $agreements;
        $this->wellBeing = $wellBeing;
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
     * This function inserts class attibutes in the rating table
     */
    private function insert_rating_into_database()
    {
        //Query to insert this rating in the database
        $query = "insert into sawa.rating values ('".$this->userID."','".$this->RatedBy."',
                '".$this->total."', '".$this->punctuality."','". $this->agreements."','".$this->wellBeing."','".$this->tripId."')";
        
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
     * This function returns rating for specific trip
     */
    public function get_rating_by_tripId($id)
    {
        $query = "select * from sawa.rating where tripId='".$id."'";
        
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
     * Setter and getter for ratedBy
     */
    public function set_ratedBy($ratedBy)
    {
        $this->ratedBy = $ratedBy;
    }
    public function get_ratedBy()
    {
        return $this->ratedBy;
    }
    
    
    /**
     * setter and getter for total(for each row)
     * 
     */
    public function set_total($total)
    {
        $this->total = $total;
    }
    public function get_total()
    {
        return $this->total;
    }
    
    
    /**
     * setter and getter for punctuality
     */
    public function set_punctuality($punctuality)
    {
        $this->punctuality = $punctuality;
    }
    public function get_punctuality()
    {
        return $this->punctuality;
    }
    
    /**
     * setter and getter for Agreements
     */
    public function set_agreements($agreements)
    {
        $this->agreements = $agreements;
    }
    public function get_agreements()
    {
        return $this->agreements;
    }
    
    /**
     * setter and getter for Well being
     */
    public function set_wellBeing($wellBeing)
    {
         $this->wellBeing = $wellBeing;
    }
    public function get_wellBeing()
    {
        return $this->wellBeing;
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
