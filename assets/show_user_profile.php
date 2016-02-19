<?php

/*
 * This code written by Hafiz K.Irshaid 
 * Email : hkmmi.2010@gmail.com
 * Najah National University 
 * Computer Engineering Department
 * Date :  Oct 8, 2013
 */
 ?>
<?php

//print_r($_POST);
include("../Model/User.php");
echo "User Profile Information,you can also send him/her a messege!";

$user = new User();

echo print_r($user->get_user_by_id($_POST['user_id']));

?>