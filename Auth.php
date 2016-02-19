<?php
session_start();
if(!isset($_SESSION['user_id']))
{
	header("Location:index.php");	
	exit;
}

/*
 * This code written by Hafiz K.Irshaid 
 * Email : hkmmi.2010@gmail.com
 * Najah National University 
 * Computer Engineering Department
 * Date :  Oct 8, 2013
 */

?>