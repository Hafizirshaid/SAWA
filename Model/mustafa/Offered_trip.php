<?php

/*
 * This code written by Mustafa Shbere
 *
 * Najah National University 
 * Computer Engineering Department
 * Date :  Oct 20, 2013
 */

/**
 * Description of Offered_trip
 *  
 * @author Mustafa
 */
class Offered_trip
{
    protected $trip_id;
    protected $from;
    protected $to;
    protected $tripDate;
	protected $tripTime;
    protected $advertise_date;
    protected $driver_id;
	protected $car_type;
    protected $car_model;
    protected $car_speed;
	protected $seats;
    protected $is_smoking;
    protected $trip_cost;
    protected $luggage;
    protected $comments;
	
	protected $database_connection;
    
    /**
     * @todo this finction is gonna init database
     */
    public function __construct() 
	{
		include_once ("/../Database_connection.php");
        $database = new Databse_connection();
        $this->database_connection = $database->return_database_conncection();
		//echo $this->database_connection;
    }
	
	public function initWithData($from, $to, $tripDate, $tripTime,
            $driver_id, $car_type, $car_model, $car_speed, $seats, $is_smoking, $trip_cost, $luggage, $comments)
    {
		
	
        $this->from = $from;
        //store all functions arguents in the class 
        $this->to = $to;
        $this->tripDate = $tripDate;
        $this->tripTime = $tripTime;
        $this->driver_id = $driver_id;
		$this->car_type = $car_type;
        $this->car_model = $car_model;
        $this->car_speed = $car_speed;
		$this->seats = $seats;
        $this->is_smoking = $is_smoking;
        $this->trip_cost = $trip_cost;
        $this->luggage = $luggage;
		$this->comments = $comments;
        //insert to database	
        $res = $this->insert_offered_trip_into_database();
        if($res)
        {
            return true;
		}
		else
        {
            return false;
		}
    }
    
	private function insert_offered_trip_into_database()
    {
		$date = date('Y-m-d h:i:s');
		
        $this->advertise_date = $date;
        
        //query to insert this user in the database
        $query = "insert into offered_trips values (
		0,
		'".$this->from.       "',
		'".$this->to.      "',
		'".$this->tripDate.		  "',
		'".$this->tripTime.		  "',
		'". $this->advertise_date. "',
	    '".$this->driver_id.		  "',
		'".$this->car_type ."',
		'".$this->car_model ."',
        '".$this->car_speed.	  "',
		'".$this->seats ."',
		'".$this->is_smoking.		  "',
		'".$this->trip_cost.		  "',
		'".$this->luggage.		  "',
	    '".$this->comments. "'
				 )";

        $result = $this-> database_connection -> query($query);
        if($result)
        {
            return true;
        }
        else 
        {
            return false;
        }
    }
	
    public function get_offered_trip_by_user_id($id)
    {
        $query = "select * from offered_trips where Driver_id=".$id;
        
        $result = $this->database_connection-> query($query);
        if($result)
         $row = $result -> fetch_assoc();
         return $row;
    }
    
    public function get_trip_by_trip_id($id)
    {
        $query = "select * from offered_trips where trip_id=".$id;
        
        $result = $this->database_connection-> query($query);
        if($result)
         $row = $result -> fetch_assoc();
         return $row;
    }
    
	//this function return all trips that have the following attr
	public function search_trip($from, $to, $date)
	{
		$query = "select * from offered_trips where offered_trips.fromLoc='$from' and offered_trips.toLoc='$to' and 
				  offered_trips.Date_time='$date'";
		
		$result = $this->database_connection->query($query);
		
		return $result;
	}
	
    
	//this function return all trips that has the following 
	public function get_similler_trips($from, $to, $datetime)
	{

		$query = "select * from offered_trips where offered_trips.from='$from' and offered_trips.to='$to' and Date_time='$datetime'";
		
		$result = $this->database_connection->query($query);
		return $result;
		
	}
	
	//this function return all trips that have the following attr
	public function search_trip($from, $to, $date, $time)
	{
		//format date
		$correct_time = explode(" ", $time);
		$datetime = $date." ".$correct_time[0].":00";

		//query
		$query = "select * from offered_trips where offered_trips.from='$from' and offered_trips.to='$to'
				  and Date_time='$datetime'";
		
		$result = $this->database_connection->query($query);
		
		return $result;
	}
    /**
     * @todo this function is gonna disconnect database;
     */
    public function __destruct() {
          mysqli_close($this->database_connection);
    }
    
}

?>
