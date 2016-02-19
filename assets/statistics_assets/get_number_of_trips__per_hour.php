<?php
session_start();
$user_id = $_SESSION['user_id'];
if($user_id == 45)
{

	//this is the admin
}
else
{
	echo "<h1>Forbidden!</h1>";
	exit;
}

if(!isset($_POST['city']) && !isset($_POST['date']))
{
	exit;
}

/*
	THIS CODE IS WRITTEN BY HAFIZ K.IRSHAID 
	DATE 2/12/2013
	NAJAH NATIONAL UNIVERSITY 
	COMPUTER ENGINEERING DEPARTMENT 
	GRADUATION PROJECT 1
	DESCRIPTION:
		this code is gonna get how many offered trips from , to this city for all day hours 
*/
//include the datbase 

include_once("../../Database_connection.php");


//get all palesintian cites array 
include_once("../../Model/cities.php");
$cities_object = new cities();
$cites_array = $cities_object->get_all_cities();

//database connection 
$db_class = new Databse_connection  ();
$db = $db_class->return_database_conncection();

//HTTP requst paramenters 
$city = $_POST['city'];
$date = $_POST['date'];
//$city = "Nablus";
//$date = "2013-12-09";
$hours = array();

$from_hours = array();

$to_hours = array();

/*
$query_from = "select * from offered_trips where trip_date='$date' and fromLoc='$city'";
$result_query_from = $db->query($query_from);
while($trip = $result_query_from->fetch_assoc())
{
	//write query here 
	$number_of_trips_query = "";

	$number_of_trips_query_result = $db->query($number_of_trips_query);



}*/

//from city 
for($i = 0 ;$i <= 23 ; $i++)
{
	$hour = $i;
	if($i <=9 && $i >=0)
	{
		$hour = "0".$i;
	}
	array_push($hours, $hour);
	$from_city_query = "SELECT COUNT(*) FROM offered_trips WHERE fromLoc='$city' and trip_date='$date' and trip_time like '%$hour%' ";
	//echo $from_city_query;
	//echo "<br>";
	$result = $db->query($from_city_query);
	$number_of_trips = $result->fetch_row();
	//print_r($number_of_trips);
	array_push($from_hours, $number_of_trips[0]);

}

//to city 
for($i = 0 ;$i <= 23 ; $i++)
{
	$hour = $i;
	if($i <=9 && $i >=1)
	{

		$hour = "0".$i;
	//	echo $hour."<br>";
	}

	$to_city_query = "SELECT COUNT(*) FROM offered_trips WHERE toLoc='$city' and trip_date='$date' and trip_time like '%$hour%' ";
	//echo $from_city_query;
	//echo "<br>";
	$result = $db->query($to_city_query);
	$number_of_trips = $result->fetch_row();
	//print_r($number_of_trips);
	array_push($to_hours, $number_of_trips[0]);

}

//results 
//print_r($from_hours);
//echo "<br>";
//print_r($to_hours);

echo "|";
foreach ($hours as $hour_var) 
{
	# code...	
	echo $hour_var.",";
}

echo "|";
foreach ($from_hours as $from ) 
{
	echo $from.",";
}
echo "|";

foreach ($to_hours as $to) 
{
	echo $to.",";
}
echo "|";

?>