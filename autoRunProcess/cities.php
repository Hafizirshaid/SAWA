<?php
/*
	
	this code wriiten by Hafiz K.Irshaid
	
	E-mail: hkmmi.2010@gmail.com
	
	Computer Engineering 
	
	Najah National University 
	
	Software Graduation Project : SAWA
	
	Date created 15/9/2013 by Hafiz K.Irshaid

*/
class cities
{
	protected $citynum;
	protected $city_name;
	protected $database_connection;
	
	public function __construct()
	{  
		include_once ("/../Database_connection.php");
        $database = new Databse_connection();
        $this->database_connection = $database->return_database_conncection();
		//echo $this->database_connection;
		
	}
	
	public function get_all_cities()
	{
		$query = "select * from cities";
		
		$result = $this->database_connection->query($query);
		
		$cities_array = array();
		
		while($city = $result->fetch_assoc())
		{
			array_push($cities_array,$city['city_name']);
		}
		return $cities_array;			
	}
}
?>