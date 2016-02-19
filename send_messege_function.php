<?php
include("Auth.php");
include_once("Model/Messege.php");

$title = $_POST['title'];
$messege_body = $_POST['Messege_body'];
$receiver = $_POST['receiver'];
$messege = new Messege();
$messege->set_sender($_SESSION['user_id']);
$messege->initMessege($title,$messege_body, $receiver);
if($messege->send_messege())
{
	echo "SUCESS";
}
else
{
	echo "FAIL";
}
?>