<?php
include("../Auth.php");

/*
 * This code written by Hafiz K.Irshaid 
 * Email : hkmmi.2010@gmail.com
 * Najah National University 
 * Computer Engineering Department
 * Date :  Oct 8, 2013
 */

//this pagee is gonna handle igoring the trip 
include("../Model/Requested_Trip.php");
include("../Model/Offered_trip.php");
include_once("../Model/User.php");
$Requsted_trip_id = $_POST['Requsted_trip_id'];

$requted_trip = new Requested_Trip();

$offered_trip_id = $requted_trip->get_offered_trip_id($Requsted_trip_id);
if($offered_trip_id != 0)
{
	//you have to decrease the number of seats 
	$offered_trip_object = new Offered_trip();
	$offered_trip_object->increase_seats_by_one($offered_trip_id);
}

$requted_trip->ignore_requsted_trip($Requsted_trip_id);
//must increase the seats by 1

//you have to send a message to the user 

include("../Model/Messege.php");

//function to send messege, you can use messege functions in Model folder 
function send_messege($sender_id, $receiver_id, $title, $body) 
{   
    //echo $body;
    $messege = new Messege();

    //administrator is the sender 
    $messege->set_sender($sender_id);
    $messege->initMessege($title, $body, $receiver_id);
    $messege->send_messege();
}


$requsted_trip_object = new Requested_Trip();

$requsted_trip_data = $requsted_trip_object->get_requsted_trip_by_trip_id($Requsted_trip_id);

$trip_info = $requsted_trip_data->fetch_assoc();
$user_object = new User();

$user_id_receiver = $trip_info['UserID'];
//here send email to that user whose trip acceted and send aslo notification to the user here 
$from = $trip_info['from'];
$to = $trip_info['to'];
$username = $user_object->get_user_full_name_by_id($user_id_receiver);
$time_date = $trip_info['Time_Date'];
$sender_id = $_SESSION['user_id'];
$receiver_id = $user_id_receiver;

$message_title = "Trip Ignored";

$messege_body = "Dear Mr.$username<br>
				 We are sorry to tell you that your Requsted Trip from $from to $to at $time_date has been ignored by the driver 
				 <br>
				 Best Regards.";
//send the user message 
send_messege($sender_id, $receiver_id, $message_title, $messege_body);
?>