<?php
include("../Auth.php");
$trip_id = $_POST['trip_id'];
/***

THIS PAGE IS GONNA DELETE THE GIVEN TRIP AND SEND APOLOGIZE MESSEGE TO ALL USERS WHOS REQUEST THIS TRIP 

*/



include("../Model/Offered_trip.php");
include("../Model/User.php");
//GET ALL DRIVERS 

include("../Model/Requested_Trip.php");
include_once("Model/Messege.php");
include("../send_messege_function.php");
$requested_trip = new Requested_Trip();

$users_ids = $requested_trip->get_users_id_by_offered_trip_id($trip_id);
$offered_trip_object = new Offered_trip();
$trip_information = $offered_trip_object->get_trip_by_trip_id($trip_id);
$messege_title = "Offered Trip Deleted";


//$username = "";
$from = $trip_information['fromLoc'];
$to = $trip_information['toLoc'];
$date_time = $trip_information['trip_date']." ".$trip_information['trip_time'];




//send all users messeges 
while($row = $users_ids->fetch_assoc())
{
	
	$receiver = $row['UserID'];
	$messege = new Messege();

	$user_info = new User();

	$username = $user_info->get_user_full_name_by_id($receiver);
	$messege_body = "
		Dear Mr.$username<br>
		We are sorry to tell you that your requsted trip from $from to $to 
		at $date_time has been canceled by the Driver.
		<br>
		Best Regards.
	";


	$messege->set_sender($_SESSION['user_id']);


	$messege->initMessege($messege_title,$messege_body, $receiver);
	echo $receiver."<br>";
	if($messege->send_messege())
	{
		echo "SUCESS";
	}
	else
	{
		echo "FAIL";
	}
}


//delete trip
$offered_trip = new Offered_trip();

$offered_trip->delete_trip_by_trip_id($trip_id);


?>