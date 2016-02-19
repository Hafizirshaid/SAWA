<?php
include("/../Auth.php");
/*
 * This code written by Hafiz K.Irshaid 
 * Email : hkmmi.2010@gmail.com
 * Najah National University 
 * Computer Engineering Department
 * Date :  Oct 8, 2013
 */
 
/*
	@todo send a message to the user 

*/

//this function go to database and insert all trip values and this time put offered_trip_id the new one
//print_r($_POST);

include_once("../Model/Requested_Trip.php");

include_once("../Model/Offered_trip.php");
include_once("../Model/User.php");
include_once("../Model/Messege.php");

function send_messege($sender_id, $receiver_id, $title, $body) 
{   
    //echo $body;
    $messege = new Messege();

    //administrator is the sender 
    $messege->set_sender($sender_id);
    $messege->initMessege($title, $body, $receiver_id);
    $messege->send_messege();
}



$offered_trip_id = $_POST['offered_trip_id'] ;



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


$trip = new Requested_Trip();

$trip->initWithData(0,$_SESSION['user_id'],$from,$to,$offered_trip_id,"no",$datetime,$is_smoking,$num_of_luggage,"hh");
					
$result = $trip->insert_trip_into_database();

if($result == true)
{
	//ok
	echo "<h1>Wait Until Driver Accept your request!</h1>";

	$trip_data_ = $offeredTrip->get_trip_data($offered_trip_id);	
	
	$trip_data = $trip_data_->fetch_assoc();

	//send message here 
	$user_object = new User();

	//the user whos offer this trip 
	$username = $user_object->get_user_full_name_by_id($trip_data['Driver_id']);

	$sender_id = $_SESSION['user_id'];
	$from = $trip_data['fromLoc'];
	$to = $trip_data['toLoc'];

	$message_title = "Request Your Trip ";
	$messege_body = "
		Dear Mr.$username.<br>
		I would like to choose your trip from $from to $to at $date_time.
		<br>Best Regards.
	";

	send_messege($sender_id, $trip_data['Driver_id'], $message_title, $messege_body);

}
else
{
	echo "ERROR";
	//error
}
?>