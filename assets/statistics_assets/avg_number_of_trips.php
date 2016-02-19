<?php
session_start();
/*
	THIS CODE IS WRITTEN BY HAFIZ K.IRSHAID 
	DATE 2/12/2013
	NAJAH NATIONAL UNIVERSITY 
	COMPUTER ENGINEERING DEPARTMENT 
	GRADUATION PROJECT 1
	DESCRIPTION:
		this code is gonna return the average of trips from,to each city in all its life hehehehe
*/

if(isset($_SESSION))
{
	$user_id = $_SESSION['user_id'];
}
if($user_id != 45)
{
	//this is not the admin
	echo "<h1>Forbidden!</h1>";
	exit;
}


//include the datbase 

include_once("../../Database_connection.php");

//get all palesintian cites array 
include_once("../../Model/cities.php");
$cities_object = new cities();
$cites_array = $cities_object->get_all_cities ();

//database connection 
$db_class = new Databse_connection ();
$db = $db_class->return_database_conncection ();

$offered_city_avg = array();
$requsted_city_avg = array();

//offered trips from and to trips 
foreach ($cites_array as $city) 
{
	$query_offered_1 = "select count(*) from offered_trips where fromLoc='$city'";
	//echo $query;
	$result_ = $db->query($query_offered_1);
	$avg_1 = $result_->fetch_row();

	$query_offered_2 = "select count(*) from offered_trips where toLoc='$city'";
	//echo $query;
	$result = $db->query($query_offered_2);
	$avg_2 = $result->fetch_row();
	$avg = $avg_1[0] + $avg_2[0];
	array_push($offered_city_avg, $avg);
}


//requsted trips 
foreach ($cites_array as $city) 
{
	$query_requsted_1 = "select count(*) from requsted_trip where requsted_trip.from='$city'";
	//echo $query;
	$result_ = $db->query($query_requsted_1);
	$avg_1 = $result_->fetch_row();

	$query_requsted_2 = "select count(*) from requsted_trip where requsted_trip.to='$city'";
	//echo $query;
	$result = $db->query($query_requsted_2);
	$avg_2 = $result->fetch_row();
	$avg = $avg_1[0] + $avg_2[0];
	array_push($requsted_city_avg, $avg);
}


//print_r($to_city_avg);
//echo "<br>";
//print_r($from_city_avg);

echo "|";
foreach ($cites_array as $city)
{
	echo $city.",";
}

echo "|";
foreach($offered_city_avg as $avg)
{
	echo $avg.",";
}
echo "|";
foreach($requsted_city_avg as $avg)
{
	echo $avg.",";
}
?>