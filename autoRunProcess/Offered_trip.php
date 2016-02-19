<?php
/*
 * This code written by Hafiz K.Irshaid
 *
 * Najah National University 
 * Computer Engineering Department
 * Date :  Oct 20, 2013
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

	//init class with given data
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
    
	//this function insert all member variables into databse
	private function insert_offered_trip_into_database()
    {
		$date = date('Y-m-d h:i:s');
		
        $this->advertise_date = $date;
        
		//echo "<h1>hhhhhhhhh</h1>";
		
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

	//echo "<h1>Query is </h1>";
		//echo "<h4>$query</h4>";
        $result = $this->database_connection->query($query);
        if($result)
        {
            return true;
        }
        else 
        {
            return false;
        }
    }
	
	//get all offered trips added by the given user id 
    public function get_offered_trip_by_user_id($id)
    {
        $query = "select * from offered_trips where Driver_id=".$id;
        
        $result = $this->database_connection->query($query);
        if($result)
         $row = $result -> fetch_assoc();
         return $row;
    }
    
	//this fucntion get all trips that has the following trip id 
    public function get_trip_by_trip_id($id)
    {
        $query = "select * from offered_trips where trip_id=".$id;   
        $result = $this->database_connection->query($query);
        if($result)
         $row = $result -> fetch_assoc();
         return $row;
    }
    
	//this function return all trips that have the following attr
	public function search_trip($from, $to, $date, $time)
	{
		//$hour_arr = explode(":",$time);
		//$hour = $hour_arr[0];
		//should return results after this time (day)
		$now = date("Y-m-d");
		//$query = "select * from offered_trips where offered_trips.fromLoc='$from' and offered_trips.toLoc='$to' 
			//	  and offered_trips.trip_date='$date' and trip_time='$time' and trip_date>'$now'";
			
		$query = "select * from offered_trips where offered_trips.fromLoc='$from' and offered_trips.toLoc='$to' 
				  and offered_trips.trip_date='$date' and trip_date>'$now'";
			
		$result = $this->database_connection->query($query);	
		return $result;
	}
    
	//this function return all trips that have the following 
	public function get_similler_trips($from, $to, $datetime)
	{
		//i know that the date and time splitter is space hhhhhhh 
		$date_and_time = explode(" ", $datetime);
		$trip_date = $date_and_time[0];
		$trip_time = $date_and_time[1];
		$trip_hour = explode(":",$trip_time);
		//first number before ':' is the hour
		$hour = $trip_hour[0];	
		//query 
		$query = "select * from offered_trips where offered_trips.fromLoc='$from' and offered_trips.toLoc='$to' 
					and trip_date='$trip_date' and trip_time=$hour";
		
		//execute query 
		$result = $this->database_connection->query($query);
		return $result;
	}
	
	//this function return all trips that have the following attr
	/*public function search_trip($from, $to, $date, $time)
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
    public function __destruct()
	{
         // mysqli_close($this->database_connection);
    }
	
	public function get_user_id_from_offered_trip_id($offered_trip_id)
	{
		$query = "select * from offered_trips where trip_id=$offered_trip_id";
		
		$result = $this->database_connection->query($query);
		
		$data = $result->fetch_assoc();
		
		return $data['Driver_id'];
		
	}
    
	//this function reuten number of avilable seats in a given offer trip 
	public function return_number_of_avilable_seats($offered_trip_id)
	{
		$query = "select seats from offered_trips where trip_id=$offered_trip_id";
		$resutl = $this->database_connection->query($query);
		$number_of_avilable_seats = mysqli_fetch_row($resutl);
		return $number_of_avilable_seats[0];
	}
	
	//this functin return all requsted trip that assigned to a given offered trip 
	public function get_all_requsted_trip_registeded($offered_trip_id)
	{
		$query = "select * from requsted_trip where offered_trip_id=$offered_trip_id";
		$result = $this->database_connection->query($query);
		return $result;			
	}
	
	//this functon return all trip data
	public function get_trip_data($offered_trip_id)
	{
		
		$query = "select * from offered_trips where trip_id=$offered_trip_id";
		$result = $this->database_connection->query($query);
	//	echo $query;		
		return $result;
	}
	
	//this function is gonna get all trips that this user offers them 
	public function get_offered_trips_by_user_id($user_id)
	{
		//get all offered_trips_id from offered trips that this user offers them ,then go to requsted trips
		//and get all trips that offered trips id is the same;
		$query = "select * from offered_trips where Driver_id=$user_id";
	//	echo $query;
		$result = $this->database_connection->query($query);	
		return $result;
	}
	
	
	//this function is gonna dectreasr nimber of seats avilable in this offered trip 
	public function decrease_seats_by_one($offered_trip_id)
	{

		$query = "select * from offered_trips where trip_id=$offered_trip_id";
		$result = $this->database_connection->query($query);
		$numberOfSeats = $result->fetch_assoc();
		echo $query;		
		$number = $numberOfSeats['seats'];
		echo "<br><h1>";
		echo $number;
		echo "</h1>";
		
		if($number == 0)
		{
			return "Number of seats Negative ";	
		}
		else
		{
			//decrease seates 
			$number = $number - 1;
			$update_query = "UPDATE offered_trips set seats=$number where trip_id=$offered_trip_id";
			//echo $update_query;
			$re = $this->database_connection->query($update_query);
			return $re;
		}
	}
	
	//this function is gonna get all trips that the avilable number of requsted trips is not equal zero 
	public function get_number_of_avilable_requsted_trip($trip_id)
	{
		$query = "select number_of_requsted_trip_avilable from offered_trips where trip_id=$trip_id";
		
		$result = $this->database_connection->query($query);
		
		$num = $result->fetch_row();
		return $num[0];
			
	}
	
	public function delete_trip_by_trip_id($trip_id)
	{
		$query = "DELETE FROM offered_trips WHERE trip_id=$trip_id";
		
		$result = $this->database_connection->query($query);
		
		return $result;
	}
	
	public function increase_seats_by_one($offered_trip_id)
	{

		$query = "select * from offered_trips where trip_id=$offered_trip_id";
		$result = $this->database_connection->query($query);
		$numberOfSeats = $result->fetch_assoc();
		echo $query;	
		echo "<br>";
		print_r($numberOfSeats);	
		$number = $numberOfSeats['seats'];
		echo "<br><h1>";
		echo $number;
		echo "</h1>";
		
		if($number == 0)
		{
			return "Number of seats Negative ";	
		}
		else
		{
			//decrease seates 
			$number = $number + 1;
			$update_query = "UPDATE offered_trips set seats=$number where trip_id=$offered_trip_id";
			//echo $update_query;
			$re = $this->database_connection->query($update_query);
			return $re;
		}
	}

        
        
        /*
         * 
         * this function is gonna return al trips that no one requst it 
         */
	    public function get_all_offered_trips_with_zero_requsted_trips()
        {
			 $tomorrow_date_without_format = new DateTime('tomorrow');
			 $tomorrow_date = $tomorrow_date_without_format->format("Y-m-d");
        	 $query = "SELECT * 
						FROM offered_trips WHERE trip_id NOT IN 
				(SELECT requsted_trip.offered_trip_id FROM requsted_trip) 
				and trip_date='$tomorrow_date'";

				$result = $this->database_connection->query($query);

				$offered_trips_tomorrow = array();

				while($row = $result->fetch_assoc())
				{
					array_push($offered_trips_tomorrow, $row['trip_id']);
				}

				print_r($offered_trips_tomorrow);
				
				return $offered_trips_tomorrow;

        	/*
        	//all these garbage code cn be solved easly by union and staff

            //this array contain all offered trips that no one reust them 
            $offered_trip_ids = array();


            //get all tomorrow trips 
            //$tomorrow_date = "2013-11-19";
            $tomorrow_date_without_format = new DateTime('tomorrow');

            $tomorrow_date = $tomorrow_date_without_format->format("Y-m-d");
			echo "<br>*******************<br>";
            $query_1 = "select trip_id from offered_trips where trip_date='$tomorrow_date'";
            echo $query_1;
            echo "<br>*******************<br>"; echo "<br>";

            $result = $this->database_connection->query($query_1);
            //echo mysqli_num_rows($result);

            //now check if any one  requst it,you can do it by inner join  
            while($id = $result->fetch_assoc())
            {
                $id_ = $id['trip_id'];
                echo "<br>*******************<br>";
                $query_2 = "select * from requsted_trip where trip_id=$id_ and Time_Date like '%$tomorrow_date%'";
                echo $query_2;
                echo "<br>*******************<br>";
                $requsted_trip_result = $this->database_connection->query($query_2);

                print_r($requsted_trip_result);
                
                if(mysqli_num_rows($requsted_trip_result) == 0)
                {
                    array_push($offered_trip_ids, $id_);
                }   
            }//while

		*/
            //return $offered_trip_ids;
        }
                
}
?>