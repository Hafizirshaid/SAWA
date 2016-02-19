<?php
include("../Auth.php");

/*
 * This code written by Hafiz K.Irshaid 
 * Email : hkmmi.2010@gmail.com
 * Najah National University 
 * Computer Engineering Department
 * Date :  Oct 8, 2013
 */
include("../Model/Requested_Trip.php");
include("../Model/Offered_trip.php");
include("../Model/Messege.php");
include_once("../Model/User.php");
//function to send messege, you can use messege functions in Model folder 
function send_messege($sender_id, $receiver_id, $title, $body) 
{   
   // echo $body;
    $messege = new Messege();

    //administrator is the sender 
    $messege->set_sender($sender_id);
    $messege->initMessege($title, $body, $receiver_id);
    $messege->send_messege();
}

$Requsted_trip_id = $_POST['Requsted_trip_id'];
$requsted_trip = new Requested_Trip();

//set the trip accepted by the driver 
$requsted_trip->set_trip_accepted_by_driver($Requsted_trip_id);


//go to seats number and decrease it by one 
$offered_trip_id = $requsted_trip->get_offered_trip_id($Requsted_trip_id);
echo "offered Trip Id";
echo $offered_trip_id;
echo "<br>";
$offered_trip = new Offered_trip();

//you shoud decrease  avilabe seats from offered trip 
$re = $offered_trip->decrease_seats_by_one($offered_trip_id);

if($re =="Number of seats Negative ")
{
	//error
}
else
{
	echo "good";	
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
$message_title = "Trip Accepted ";
$messege_body = "Dear Mr.$username<br>
				 Congragulations,Your Requsted Trip from $from to $to at $time_date has been accepted by the driver 
				 <br>
				 Best Regards.
					";

//send the user message 
send_messege($sender_id, $receiver_id, $message_title, $messege_body);

?>