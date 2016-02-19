<?php

/**
 * This program is written by Hafiz K.Irshaid
 * description: 
 *  This page is gonna check for all offered and requsted trips that the trip time is come and there is 
 *  no one book any of it.
 *  Date :17/11/2013
 *  Time : 11:46 PM
 */

/**
 * description : this function is gonna send sms to the given mobile num
 */
function send_sms($receiver_id, $messege) 
{
    echo $receiver_id;
   // add the nessecary queries to get the email and the name and other things 
    echo $messege;
    echo "<br>";
}

//function to send messege, you can use messege functions in Model folder 
function send_messege($receiver_id, $title, $body) 
{   
    //echo $body;
    $messege = new Messege();

    //administrator is the sender 
    $messege->set_sender(45);
    $messege->initMessege($title, $body, $receiver_id);
    $messege->send_messege();
}

//send emal to this user 
function send_email($reciver_id, $title, $body) 
{   
    echo $reciver_id;
    // add the nessecary queries to get the email and the name and other things 
    echo $title;
    echo $body;
    echo "<br>";
    //mail();
}

//waiting until mustafa implement his garbage 
function send_notification()
{

}

//must authenticate 
//check if the server requst this page or not 
//if ($_SERVER['REMOTE_ADDR'] == "127.0.0.1")
{
    //our process here 
    //this var must have the tomorrow date 
    include_once("../Database_connection.php");
    
    include_once ("../Model/Messege.php");
    include_once ("../Model/notification.php");
    include_once ("../Model/Offered_trip.php");
    include_once ("../Model/Requested_Trip.php");
    include_once ("../Model/User.php");
    /**
     * this part is gonna search for all offered trips that the time is comming tomorrow and there is no one a
     * assigned to it or there 
     */

    $offered_trips = new Offered_trip();

    $offered_trips_zero_requsted = $offered_trips->get_all_offered_trips_with_zero_requsted_trips();
   
    foreach($offered_trips_zero_requsted as $trip_id)
    {
        echo "Trip Id".$trip_id;
        
        echo "<br>*******************<br>";
        $offerd_trip_object = new Offered_trip();

        $trip_data_row_matirial = $offerd_trip_object->get_trip_data($trip_id);
        $trip_data = $trip_data_row_matirial->fetch_assoc();

        $from = $trip_data['fromLoc'];
        $to = $trip_data['toLoc'];
        $time_date = $trip_data['trip_date']." ".$trip_data['trip_time'];

        //must notify this trip user
        $user_id = $offered_trips->get_user_id_from_offered_trip_id($trip_id);
        echo "User ID = ".$user_id;
        echo "<br>*******************<br>";

        $user_object = new User();

        $username = $user_object->get_user_full_name_by_id($user_id);

        $title = "Offered Trip State";
        $message_body = "Dear Mr.$username<br>
                            We are sorry to tell you that your offered trip from $from to $to at $time_date does not have any requsted users<br>
                            Best Regards.<br>
        ";

        //echo "<h1>".$user_id;
        //send_sms($user_id,"kdhohsoufh");
        send_email($user_id, $title, $message_body);
        send_messege($user_id, $title, $message_body);
        //must send messege and email and every thing to this user 
    }
    echo "<h1>part 1 is finished </h1>";

    //***********************************************************************************************
    /*
     * this part is gonna search all requsted trips that there is no offered trips assgnined*  
     */

    $requsted_trips = new Requested_Trip ();
    
    $requsted_with_no_offerd = $requsted_trips->get_requsted_trips_with_no_offered_trip_assigned();
    
    while($requsted = $requsted_with_no_offerd->fetch_assoc())
    {
        print_r($requsted);
        $id = $requsted['trip_id'];
        $user_id = $requsted['UserID'];
        
        $user_object = new User();

        $username = $user_object->get_user_full_name_by_id($user_id);
        $trip_from = $requsted['from'];
        $trip_to = $requsted['to'];
        $trip_date_time = $requsted['Time_Date'];

        $message_title = "Requsted Trip State.";
        $message_body = "Dear Mr.$username
                        <br>We are sorry to tell you that your 
                        requsted trip from $trip_from to $trip_to at $trip_date_time does not have any offered trip assigned yet. 
                        <br>Please go to search for offered trip again. <br>
                        Best Regards.";
        send_messege($user_id, $message_title, $message_body);

        send_email($user_id, $message_title, $message_body);
        //send_sms($user_id,"kdhohsoufh");
    }
} 
//else
{
    echo "<h1>Access Denite</h1>";
    //exit;
}
?>