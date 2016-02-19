<?php
include("Auth.php");
?>
<?php
function clean_input($str)
{
	return strip_tags(addslashes($str));
}
 $from = clean_input($_GET['from']);
 $to = clean_input($_GET['to']);
 $tripDate = clean_input($_GET['tripDate']);
 $tripTime = clean_input($_GET['tripTime']);
 $driver_id = clean_input($_SESSION['user_id']);
 $car_type = clean_input($_GET['car_type']);
 $car_model = clean_input($_GET['car_model']);
 $car_speed = clean_input($_GET['car_speed']);
 $is_smoking = clean_input($_GET['smoking']);
 $trip_cost = clean_input($_GET['tripCost']);
 $luggage = clean_input($_GET['car_luggage']);
 $comments = clean_input($_GET['comments']);
 $seats = clean_input($_GET['seats']);

include_once("Model/Offered_trip.php");
$newTrip = new Offered_trip();
$newTrip->initWithData($from, $to, $tripDate, $tripTime, $driver_id, $car_type, $car_model, $car_speed, $seats, $is_smoking, $trip_cost, $luggage, $comments);

include_once("Model/Requested_Trip.php");
$trip = new Requested_Trip();
$similer_trips = $trip->get_similer_trip($from, $to, $tripDate);//You have to add the date in the model

include_once("Model/User.php");
$user = new User();
//You have to add the date in the model
?>


<?php
if(mysqli_num_rows($similer_trips) != 0)
{
	echo "<div id='suc' class='alert alert-success'>Successful! Your trip was offered.</div>";
	echo "<h3>You can choose to notify these trips' requesters</h3>";
	echo "<form id='notifyForm' method='POST'>";
	echo "<table class='table table-condensed table-hover'>";
	echo "<tr class='info'>";
	echo "<th>#</th><th>User</th><th>From</th><th>To</th><th>Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hour</th><th>Smoking</th><th>Luggage</th>";
	echo "</tr>";
	while($trip = $similer_trips->fetch_row())
	{
		$userData = $user->get_user_by_id($trip[1]);
		echo"<tr><td><input name='receiver2[]' type='checkbox' value='$trip[1]'></td><td><a href='publicProfile.php?id=$trip[1]' target='_blank'>$userData[firstname]</a></td><td>$trip[2]</td><td>$trip[3]</td><td>$trip[6]</td><td>$trip[8]</td><td>$trip[9]</td></tr>";
		echo "<input name='receiver' type='hidden' value='$trip[1]'>";
	}
	echo "</table><br>";
	//echo "<input name='receiver' type='hidden' value='39'>";
	echo "<input type='hidden' name='title' value='New offered trip'/>";
	echo "<input type='hidden' name='Messege_body' value='This mail is to notify you that new offered trip has been posted'/>";
	echo "<button type='submit' class='btn btn-primary'>Notify>></button>";
	echo "</form>";
}
else
{
	echo "<div id='suc' class='alert alert-success'>Successful! Your trip was offered.</div>";
}

echo "<div id='suc2' style='visibility:hidden;' class='alert alert-success'>Successful! User(s) notified. Waiting their response</div>";
echo "<button id='con' class='btn btn-primary pull-right'>Home>></button>";


?>

<script>

	$("#notifyForm").submit(function(e){	
	//alert("SUC!");
			var $data = $("#notifyForm").serialize();
			//alert($data);
		$.post("send_messege_function.php",$data,function(res){
		
			if(res == "SUCESS")
			{//alert("SUC!");
				$("#suc2").css('visibility', 'visible');
				
				//ok
			}
			else if(res == "FAIL")
			{
				alert("FAIL! Please check your input");
				//error 
			}
			});
		e.preventDefault();
	});	
	$("#con").click(function(e) {
		//alert("Successful! Your offer was successful.");
        $("#page-body").load("mainPage.php");
		$("#_home").addClass("active" ); 
    });

</script>