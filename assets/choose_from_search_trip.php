<?php
include("../Auth.php");

$offered_trip_id = $_POST['offered_trip_id'];

//here i wanna insert into requsted trip table some of the offered trip information 
//from , to, time , date and offered_trip_id

include("../Model/Requested_Trip.php");
include("../Model/Offered_trip.php");
include_once("../Model/User.php");
include("../Model/Messege.php");


function send_messege($sender_id, $receiver_id, $title, $body) 
{   
   // echo $body;
    $messege = new Messege();

    //administrator is the sender 
    $messege->set_sender($sender_id);
    $messege->initMessege($title, $body, $receiver_id);
    $messege->send_messege();
}



$offeredTrip = new Offered_trip();

$avilable_seats = $offeredTrip->return_number_of_avilable_seats($offered_trip_id);

//if there is n avilable seats, echo error,else insert into db 
if($avilable_seats == 0)
{
	
	echo "Sorry, There is no avilabe seats<br>Please Choose other trip!";	
}
else
{
	
	/*
		@todo you have to check if the current user choose this trip before or not 
	*/
	$requeted_trip = new Requested_Trip();
	
	//get trip data using trip id 
	$trip_data_ = $offeredTrip->get_trip_data($offered_trip_id);	
	
	$trip_data = $trip_data_->fetch_assoc();
	
	//correct the date inorder to be accepted by db
	$date_time = $trip_data['trip_date']." ".$trip_data['trip_time'].":00";	
	
	//insert from and to and date of the given trip 
	$requeted_trip->initWithData(0,$_SESSION['user_id'],$trip_data['fromLoc'],$trip_data['toLoc'],$offered_trip_id,"no"
									,$date_time,"no",0,"",$trip_data['trip_date']);
							
	$requeted_trip->insert_trip_into_database();
	echo "<div class='alert alert-success'>";
	//a message must send here 
	echo "<strong>your trip was inserted to database<br>wait until Driver Accept trip </strong>";
	echo "</div>";

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


?>