<?php
session_start();
/*
	
	this code wriiten by Hafiz K.Irshaid
	
	E-mail: hkmmi.2010@gmail.com
	
	Computer Engineering 
	
	Najah National University 
	
	Software Graduation Project : SAWA
	
	Date created 15/9/2013 by Hafiz K.Irshaid

*/
//@todo must validate and handle file upload
//this function responsible for remove all SQL and HTML injection
function clean_input($str)
{
	return strip_tags(addslashes($str));
}

//get all variables and clean them 
$username = clean_input($_POST['username']);

$firstname = clean_input($_POST['firstname']);

$secondname = clean_input($_POST['secondname']);

$email = clean_input($_POST['email']);

$mobilenum = clean_input($_POST['mobilenum']);

$gender = clean_input($_POST['gender']);

$birthdate = clean_input($_POST['birthdate']);

$password = clean_input($_POST['password']);

$password2 = clean_input($_POST['password2']);


//---------------------- file upload --------------------------

$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["image"]["name"]);
$extension = end($temp);

  
  if ($_FILES["image"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["image"]["error"] . "<br>";
    }
  else
    {
    echo "Upload: " . $_FILES["image"]["name"] . "<br>";
    echo "Type: " . $_FILES["image"]["type"] . "<br>";
    echo "Size: " . ($_FILES["image"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["image"]["tmp_name"] . "<br>";

    if (file_exists("UsersImages/" . $_FILES["image"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["image"]["tmp_name"],
      "UsersImages/" . $_FILES["image"]["name"]);
	  
	  
      echo "Stored in: " . "UsersImages/" . $_FILES["file"]["name"];
      }
    }


//---------------------- file upload --------------------------






//do validation on server side also 







include_once("Model/User.php");

$newUser = new User();

if($newUser->is_user_exist_by_username($username))
{
	echo "User is exist";	
	exit;
}
else
{
	$newUser->initWithData($firstname,$secondname,$username,$email,$mobilenum,$gender,$birthdate,$password, $_FILES["image"]["name"]);
	
	$data = $newUser->get_users_by_username($username);
	$_SESSION['user_id'] =  $data['user_id'];
	header("Location:index.php");
}




?>