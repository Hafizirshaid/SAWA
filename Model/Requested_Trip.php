<?php

/*
 * This code written by Hafiz K.Irshaid 
 * Email : hkmmi.2010@gmail.com
 * Najah National University 
 * Computer Engineering Department
 * Date :  Oct 8, 2013
 */
 

/**
 * Description of Requested_Trip
 *  
 * @author Hafiz
 */
class Requested_Trip 
{
    protected $trip_id;
    protected $user_id;
    protected $from;
    protected $to;
	protected $offered_trip_id;
	protected $Trip_accepted_by_driver;
    protected $time_date;
    protected $advertise_date;
    protected $is_smoking;
    protected $number_of_luggage;
    protected $comments;
	protected $date;
	protected $database_connection;
    /**
     * 
     * @todo init database
     */
    public function __construct() 
    {
        //Include database connection file and get the connection reference.
        include_once ("/../Database_connection.php");
        $database = new Databse_connection();
        $this->database_connection = $database->return_database_conncection();
    }
    
	//get all simmiller trips that have the following
	public function get_similer_trip($from, $to, $time)
	{
		$query = "select * from requsted_trip where requsted_trip.from='$from' and requsted_trip.to='$to' and date='$time'";
		
		$result = $this->database_connection->query($query);

		return $result;
	}
	
    /**
     * @todo this function is gonna insert the given parameters into database
     */
	
	 //this function is init the class memeber varialb;e 
	public function initWithData( $trip_id, $user_id, $from, $to,$offered_trip_id, $Trip_accepted_by_driver, $time_date, $is_smoking, $number_of_luggage, $comments,$date)
	{
		$this->trip_id = $trip_id;
    	$this->user_id = $user_id;
        $this-> from = $from;
    	$this->to = $to;
   		$this->time_date = $time_date;
		$this->offered_trip_id = $offered_trip_id;
		$this->Trip_accepted_by_driver =  $Trip_accepted_by_driver;
  	   // $this->advertise_date = $advertise_date;
    	$this->is_smoking = $is_smoking;
   		$this->number_of_luggage = $number_of_luggage;
	    $this->comments = $comments;
    	$this->date = $date;
	}
	
	//this function isert trip in to db 
    public function insert_trip_into_database()
    {
		//this date for advertise date
		$date = date('Y-m-d h:i:s');
		
        $query = "insert into requsted_trip values(0,$this->user_id,'$this->from','$this->to',$this->offered_trip_id
				,'no','$this->time_date','$date','$this->is_smoking',$this->number_of_luggage,'$this->comments','$this->date')";
				
		//echo $query;
		
		$result = $this->database_connection->query($query);
		
		if(isset($result))
		{
			return true;
		}
		else
		{
			return false;
		}
		//print_r($result);
    }
	
    //
    public function get_trips_by_user_id($user_id)
    {
    	
		$query = "select * from requsted_trip where UserID='$user_id'";
		
		$result = $this->database_connection->query($query);    
		return $result;	
    }
	
	//
    public function update_trip_by_trip_id($id)
    {
        
    }
	
	//
	public function get_similer_trip_usersID($from, $to, $date)
	{
		$query = "select UserID from requsted_trip where requsted_trip.from='$from' and requsted_trip.to='$to'";
		
		$result = $this->database_connection->query($query);

		return $result;
	}
    
    /**
     * @todo close database connection 
     */
    public function __destruct() 
    {
        
    }
	
	//this function is gonna get all requsted trips that have the given offered trip id 
	public function get_requsted_trips_by_offered_trip_id($offered_trip_id)
	{
		//$query = "select * from requsted_trip where offered_trip_id=$offered_trip_id and Trip_accepted_by_driver='no'";
		$query = "select * from requsted_trip where offered_trip_id=$offered_trip_id";
		$result = $this->database_connection->query($query);		
		return $result;
	}
	
	//this function is gonna set the Trip_accepted_by_driver to yes when driver accept this trip 
	public function set_trip_accepted_by_driver($trip_id)
	{
		
		$query = "UPDATE requsted_trip SET Trip_accepted_by_driver='yes' where trip_id='$trip_id'";
		//echo $query;
		$result = $this->database_connection->query($query);		
		return $result;
	}

	//this function is gonna ignore this trip by driver 
	public function ignore_requsted_trip($trip_id)
	{
		$query = "UPDATE requsted_trip SET Trip_accepted_by_driver='ignore' where trip_id='$trip_id'";
		$result = $this->database_connection->query($query);
		
		return $result;
	}
	
	
	public function set_trip_accepted_no($trip_id)
	{
		$query = "UPDATE requsted_trip SET Trip_accepted_by_driver='no' where trip_id='$trip_id'";
		$result = $this->database_connection->query($query);
		return $result;
	}
	
	//this function is gonna return the offered trip  id th
	public function get_offered_trip_id($requsted_trip)
	{
		$query = "select * from requsted_trip where trip_id=$requsted_trip";
		
		
		$result = $this->database_connection->query($query);
		$id = $result->fetch_assoc();
		return $id['offered_trip_id'];
	}
	
	//this function is gonna get all trips that accepted by driver by this user 
	public function get_successful_requsted_trips_by_user_id($user_id)
	{
		$query = "select * from requsted_trip where UserID=$user_id and Trip_accepted_by_driver='yes'";
		//echo $query;
		$result = $this->database_connection->query($query);	
		
		return $result;
	}
	
	//this fucntion is gonna get all ????? something stubed here !
	public function get_users_id_by_offered_trip_id($offered_trip_id)
	{
		$query = "select * from requsted_trip where offered_trip_id=$offered_trip_id";
		
		$result = $this->database_connection->query($query);
		
		return $result;	
	}
	
	//this function is gonna remove the given requsted trip 
	public function remove_requsted_trip_by_trip_id($trip_id)
	{
		$query = "delete from requsted_trip where trip_id=$trip_id";
		
		$result = $this->database_connection->query($query);
		
		return $result;
	}
	
	public function get_requsted_trip_by_trip_id($trip_id)
	{
		$query = "select * from requsted_trip where trip_id=$trip_id";
		
		$result = $this->database_connection->query($query);
		
		return $result;	
	}
        
        public function get_requsted_trips_with_no_offered_trip_assigned()
        {
            //this date holds tomorrow date 
            $tomorrow_date_without_format = new DateTime('tomorrow');

            $tomorrow_date = $tomorrow_date_without_format->format("Y-m-d");
            $query = "select * from requsted_trip where offered_trip_id=0 and Time_Date like '%$tomorrow_date%'";
            
echo $query;

            $result = $this->database_connection->query($query);
            return $result;   
        }
}

?>
