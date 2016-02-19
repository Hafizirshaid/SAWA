<?php
include("Auth.php");
include_once("Model/Messege.php");
$id = $_POST['messege_id'];
$messege = new Messege();
echo $messege->get_messege_body_by_messege_id($id);

?>

<?php

/*
 * This code written by Hafiz K.Irshaid 
 * Email : hkmmi.2010@gmail.com
 * Najah National University 
 * Computer Engineering Department
 * Date :  Oct 8, 2013
 */
 ?>