<?php
include("/../Auth.php");

/*
 * This code written by Hafiz K.Irshaid 
 * Email : hkmmi.2010@gmail.com
 * Najah National University 
 * Computer Engineering Department
 * Date :  Oct 8, 2013
 */
 
//print_r($_POST);
//this function go to database and insert all trip values and this time put offered_trip_id the new one
//print_r($_POST);
//$offered_trip_id = $_POST['offered_trip_id'] ;
$from = $_POST['from'];
$to = $_POST['to'];
$date = $_POST['date'];	
$hours = $_POST['hours'];
$minits = $_POST  ['minits'];
$AM_PM = $_POST ['AM_PM'];
$is_smoking = $_POST  ['is_smoking'];
$num_of_luggage = $_POST ['num_of_luggage'];

$correct_time = $hours.":".$minits.":"."00";
$datetime = $date." ".$correct_time;

include_once("../Model/Requested_Trip.php");
$trip = new Requested_Trip();
$trip->initWithData(0,$_SESSION['user_id'],$from,$to,0,"no",$datetime,$is_smoking,$num_of_luggage,"hh",$date);
					
$result = $trip->insert_trip_into_database();

if($result == true)
{
	//ok
	echo "<h1>Wait Until Driver Accept your request!</h1>";
}
else
{
	echo "ERROR";
	//error
}
?>