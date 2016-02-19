<?php
include("../Auth.php");
include("../Model/User.php");
$user = new User();

$user_id = $_POST['id'];

$result = $user->get_user_by_id($user_id);

//print user name
echo $result['firstname']." ".$result['lastname'];
echo ",";

echo $result['email'];
echo ",";

echo $result['mobile_number'];
echo ",";

echo $result['personal_image'];

echo ",";

echo $result['user_id'];
echo ",";

echo "UsersImages/".$result['personal_image'];

?>