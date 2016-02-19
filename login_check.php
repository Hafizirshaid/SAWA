<?php
session_start();


/*
 * This code written by Hafiz K.Irshaid 
 * Email : hkmmi.2010@gmail.com
 * Najah National University 
 * Computer Engineering Department
 * Date :  Oct 8, 2013
 */

//remove all sql and html injections
$username = strip_tags(addslashes($_POST['username']));
$password = strip_tags(addslashes($_POST['password']));

//this is flag to check the user if exist or not 
$flag = 0;

if(isset($username) && isset($password))
{
	include_once ("Model/User.php");
	
	$login_user = new User();
	//get user by user name
	$data = $login_user->get_users_by_username($username);
	

	if(isset($data))
	{
		if($data['password'] === md5($password))
		{
			$flag = 1;
		}
		else
		{	
			$flag = 0;
		}
	}
	else
	{
		//user does not exist in the database
		$flag = 0;	
	}
}

else 
{
	//user does not exist
	$flag = 0;
}

if($flag == 1)
{
	//echo "YES";
	$_SESSION['user_id'] = $data['user_id'];
	//go to index page in admin page 
	echo "SUCESS";
	//header("Location: index.php");
	//exit();
}	
else 
{
	//here y have to alert a big messege that the user is not authenticated 
	echo "ERROR";		
}

?>
