<?php

/*
 * This code written by Hafiz K.Irshaid 
 * Email : hkmmi.2010@gmail.com
 * Najah National University 
 * Computer Engineering Department
 * Date :  Oct 8, 2013
 */

/**
 * Description of Offered_trip
 *  
 * @author Hafiz
 */
class Offered_trip
{
    protected $trip_id;
    protected $from;
    protected $to;
    protected $date_time;
    protected $advertise_date;
    protected $driver_id;
    protected $car_model;
    protected $car_speed;
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
    
    public function get_offered_trip_by_user_id($id)
    {
        
    }
    
    public function get_trip_by_trip_id($id)
    {
        
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
        ;
    }
    
	
	/********************* New function **************************/
	
	//this function return all trips that has the following 
	public function get_similler_trips($from, $to, $datetime)
	{

		$query = "select * from offered_trips where offered_trips.from='$from' and offered_trips.to='$to' and Date_time='$datetime'";
		
		$result = $this->database_connection->query($query);
		return $result;
		
	}
	
}

?>
