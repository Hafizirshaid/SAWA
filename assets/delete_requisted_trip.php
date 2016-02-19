<?php
include("../Auth.php");
include("../Model/Messege.php");
include("../Model/Requested_Trip.php");
include("../Model/Offered_trip.php");

//in this code it should remove the requsted trip from the database and send a messege to the driver to tell him that 
//this trip was deleted also we need to increase number of seats if this messege accepted by yhe driver

//get requsted trip id 
$requsted_trip_id = $_POST['trip_id'];

$requsted_trip = new Requested_Trip();
$offered_trip_id = $requsted_trip->get_offered_trip_id($requsted_trip_id);

//if nobody choose this trip so we do not need to send any notification to any body 
if($offered_trip_id == 0)
{
	//just delete the trip 
	$requsted_trip->remove_requsted_trip_by_trip_id($requsted_trip_id);	
}
else
{
	//here we have to send messege to the driver to tell him 
	//we wanna get diriver id 
	$offered_trip = new Offered_trip();
	
	//get trip data 
	$offered_trip_data_ = $offered_trip->get_trip_data($offered_trip_id);
	$offered_trip_data = $offered_trip_data_->fetch_assoc();
	//decrease number of seats if the trip accepted by the driver 
	print_r($offered_trip_data);
	
	$requsted_trip_accpt_ = $requsted_trip->get_requsted_trip_by_trip_id($requsted_trip_id);
	$requsted_trip_accpt = $requsted_trip_accpt_->fetch_assoc();
	if($requsted_trip_accpt['Trip_accepted_by_driver'] == "yes")
	{
		//echo "***";
		$offered_trip->increase_seats_by_one($offered_trip_id);
	}
	
	//get trip driver 
	$driver_id = $offered_trip_data['Driver_id'];
	
	//set title and messege body and the reciver for this messege 
	$title = "Requsted Trip Deleted ";
	$messege_body ="Sorry Man, The Requsted from ".$offered_trip_data['fromLoc']." to ".$offered_trip_data['toLoc']." Trip at ".$offered_trip_data['trip_date']." was deleted!";
	$receiver = $driver_id;
	
	//send the messege 
	$messege = new Messege();
	$messege->set_sender($_SESSION['user_id']);
	$messege->initMessege($title,$messege_body, $receiver);
	if($messege->send_messege())
	{
		echo "SUCESS";
		$requsted_trip->remove_requsted_trip_by_trip_id($requsted_trip_id);
	}
	else
	{
		echo "FAIL";
	}	
}

?>