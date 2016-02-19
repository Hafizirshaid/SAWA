<?php


/*
 * This code written by Hafiz K.Irshaid 
 * Email : hkmmi.2010@gmail.com
 * Najah National University 
 * Computer Engineering Department
 * Date :  Oct 8, 2013
 */

include_once("../Model/Requested_trip.php");
include_once("../Model/Offered_trip.php");

$requested_trip_id = $_POST['requested_trip_id'];

$from = $_POST['from'];
$to = $_POST['to'];
$userid = $_SESSION['user_id'];
$date = $_POST['date'];
$time = $_POST['time'];
$is_smoking = $_POST['is_somking'];
$num_of_luggage = $_POST['number_of_luggage'];
$comments = $_POST['comments'];

//here the code to change the offered trip id 

$requsted_trip = new Requested_Trip();
$requsted_trip->initWithData(0,$userid, $from, $to, $requested_trip_id, "no", $datetime, $is_smoking, $num_of_luggage,$comments);
	
$result = $requsted_trip->insert_trip_into_database();

if($result == true)
{
	echo "<h3>Your Trip added to the database<br>Wait until offer trip accept your request </h3>";	
}
else
{
	echo "Database Error";
}


?>