<?php
include("Auth.php");

/*
 * This code written by Hafiz K.Irshaid 
 * Email : hkmmi.2010@gmail.com
 * Najah National University 
 * Computer Engineering Department
 * Date :  Oct 8, 2013
 */
 
 /**
 	Description:
	this script is gonna insert the reqeuested trip in the database and check if there any semeler trips
 */
 
//include requerd libraries from model 
include("Model/Requested_Trip.php");
include("Model/Offered_trip.php");
 
//this function strip all HTML and SQL tags Injection from Bad guys 
function clean_input($str)
{
	return strip_tags(addslashes($str));
}
 
//print_r($_POST);

//get all data from http header 
$from = 		clean_input($_POST['from']);
$to = 			clean_input($_POST['to']);
$userid = 		clean_input($_SESSION['user_id']);
$date = 		clean_input($_POST['date']);
$trip_hour = 	clean_input($_POST['hours']);
$trip_minit = 	clean_input($_POST['minits']);
$trip_AM_PM = 	clean_input($_POST['AM_PM']);
$is_smoking = 	clean_input($_POST['is_somking']);
$num_of_luggage = clean_input($_POST['number_of_laggage']);

//maybe this will not clean it beacuse this comment comes from HTML editor like CKEditor, we will see that later
$comments = clean_input($_POST['comments']);

//this to comlete time format to insert it in db later 
if($trip_AM_PM === "PM")
{
	$trip_hour = $trip_hour + 12;	
}

//add missing digit in minits 
if($trip_minit >= 0 && $trip_minit <= 9)
{
	$trip_minit = "0".$trip_minit;
}

//add missing digit in trip hours 
if($trip_hour >= 0 && $trip_hour <= 9)
{
	 $trip_hour = "0".$trip_hour;
}

//concattinate strings 
$correct_time = $trip_hour.":".$trip_minit.":"."00";
$datetime = $date." ".$correct_time;

//echo $datetime;
?>


  <!--start of pop up menu for user information-->

  <div id="User_Info" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
	  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	  <h3 id="myModalLabel">User Information</h3>
	</div>
	<div class="modal-body">
	<span>
	<img id="personal_image" class="img-rounded" src="" width="180px" height="180px"></span>
  
	  <br>
	  Full Name : <span id="fullname"></span>
	  <br>
	  Mobile Number : <span id="mobile"></span>
	  <br>
	  Email:<span id="email"></span>
	  <br>
	  Rate : <span id="rate"></span>
	  <br>
	  
	  <input type="hidden" value="no" id="user_id_to_send_messsege">
		
	  <button class="btn" onClick="send_this_user_messege()">Send Messege</button>
	
	</div>
	<div class="modal-footer">
	  <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	  
	</div>
  </div>
  <!--end of pop up menu -->
  
  <!--start of pop up menu for messege -->
  <div id="messege_menu" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
	  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	  <h3 id="myModalLabel">Message</h3>
	</div>
	<div class="modal-body">
	  To: <span id="to"></span>
	  <br>
  		Title: <input type="text" id="title">
        <br>

	  Body<br>
  
	  <textarea id="messege-body" cols="50" rows="10">
	  
	  </textarea>
	  <br>
  <button class="btn" id="send_btn">Send</button>
	</div>
	<div class="modal-footer">
	  <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	</div>
  </div>
  <!--end of pop up menu -->
  

<script>
function choose_trip(offered_trip_id)
{
	//console.log(trip_id);	
	
		//this function go to database and insert all trip values and this time put offered_trip_id the new one
	var $data = "offered_trip_id=" + offered_trip_id;
	$data += "&from=" + "<?php echo $from; ?>";
	$data += "&to=" + "<?php echo $to; ?>";
	$data += "&date=" + "<?php echo $date; ?>";
	$data += "&hours=" + "<?php echo $trip_hour; ?>";
	$data += "&minits=" + "<?php echo $trip_minit; ?>";
	$data += "&AM_PM=" + "<?php echo $trip_AM_PM; ?>";
	$data += "&is_smoking=" + "<?php echo $is_smoking; ?>";
	$data += "&num_of_luggage=" + "<?php echo $num_of_luggage; ?>";
	
	//console.log($data);
	
	 //do post to your page 
	 $.post("assets/choose_offered_trip.php", $data,function(response)
	 {
		$("#page-body").html(response);	 
	 });
}


//this function gonna show user information when cliking on username 
/*function show_user_info(user_id)
{
	
	$("#User_Info").modal('show');
	//console.log(user_id);
	//var $data = "user_id=" + user_id;
	//$.post("assets/show_user_profile.php", $data, function(response)
	//{
		//console.log(response);
		//$("#user_info_div").html(response);
	//});
}
*/
function add_new_requested_trip()
{
	//console.log(trip_id);	
	
		//this function go to database and insert all trip values and this time put offered_trip_id the new one
	var $data;
	$data += "&from=" + "<?php echo $from; ?>";
	$data += "&to=" + "<?php echo $to; ?>";
	$data += "&date=" + "<?php echo $date; ?>";
	$data += "&hours=" + "<?php echo $trip_hour; ?>";
	$data += "&minits=" + "<?php echo $trip_minit; ?>";
	$data += "&AM_PM=" + "<?php echo $trip_AM_PM; ?>";
	$data += "&is_smoking=" + "<?php echo $is_smoking; ?>";
	$data += "&num_of_luggage=" + "<?php echo $num_of_luggage; ?>";
	
	//console.log($data);
	//here you need something to mdify this string to wrok on URL, THERE IS SOME ,SEE NETWORK2
	 //do post to your page 
	 $.post("assets/add_new_requested_trip.php", $data, function(response)
	 {
		$("#page-body").html(response);	 
	 });
}

</script> 
<?php
//object from offered trip to get all similar trips 
$trip = new Offered_trip();

//get all similler trips that have the same sourse and destination and the smae time 
$similer_trips = $trip->get_similler_trips($from, $to, $datetime);

//if there is an offered trip semelar to this trip shows it to user 
if(mysqli_num_rows($similer_trips) != 0)
{
	//echo a table of all trips 
	//let user to choose a trip or let him just insert the trip to the database
	//if the user chhose any of these trips so send sms and emails to all users related to this trip 
	//driver can accept and eject the trip 
	//echo "there is a lot of trips simmiler to this trip";
	echo "Similar Trips :<br>";
	echo "Click on Driver Name to show User Informtion";
	//here print the result 
	include_once("Model/User.php");
	$drivername = new User();
	
	//echo table 
	echo "<table class='table table-hover'>";
	
	//echo table header 
	?>
	<thead>
	<tr>
	<th>#</th>
	<th>From</th>
	<th>To</th>
	<th>Time</th>
	<th>Driver Name</th>
    <th>Avilable Seats</th>
    <th>Choose Trip</th>
	</tr>
	</thead>
	<tbody>
	<?php
	
	$i = 1;
	
	//show table for all results
	while($trip = $similer_trips->fetch_row())
	{
		if($_SESSION['user_id'] != $trip[6])
		{
			//print the table 
			echo "<tr>";
			echo "<td>$i</td>";
			
			//increment counter 
			$i = $i + 1;
			
			//From
			echo "<td>$trip[1]</td>";
			
			//To
			echo "<td>$trip[2]</td>";
			
			//Time
			echo "<td>$trip[3]</td>";
			
			//get Driver Name
			echo "<td><a onClick=show_user_info($trip[6])>";
			echo $drivername->get_user_full_name_by_id($trip[6]);
			echo "</a></td>";
			$avilable_seats = $trip[10];
			echo "<td>$avilable_seats</td>";
			
			//here print button to let user to choose this trip 	
			echo "<td><button class='btn' onClick='choose_trip(".$trip[0].")'";
			if($avilable_seats == 0)
			{
				echo "disabled";	
			}
			echo ">Choose Trip</button></td>";	
			echo "</tr>";	
		}
	}
	
	echo "</tbody>";
	echo "</table>";
	echo "<hr>";
	//to show button if the user wanna add new trip to the database 
	?>
    <div class="span12" id="user_info_div">
	    <p>Click on User Name to Show User Info </p>
    </div>
   
	<h3>Or</h3>
	<a id="addnewtrip" class="btn" onClick="add_new_requested_trip()">Add New Trip </a>

	<?php	
	
		
}
else if(mysqli_num_rows($similer_trips) == 0)
{
	echo "<h2>There is no similar trips.</h2>";
	
	//insert this requested trip in the database
	$requsted_trip = new Requested_Trip();
	$requsted_trip->initWithData(0,$userid, $from, $to,0,"no", $datetime, $is_smoking, $num_of_luggage,
								 $comments);
	$result = $requsted_trip->insert_trip_into_database();

	if($result == true)
	{
		echo "<div class='alert alert-success'>";
		echo "<h4>Your Trip added to the database<br>Wait until a driver post a trip similar to your trip, we
			  will send you email. </h4>";

		echo "</div>";	
		echo "<button class='btn btn-primary' id=return_to_home_page>Home</Button>";
	}
	else
	{
		echo "Database Error";
	}
}

//here i wanna get the id of the trip what inserted 

?>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

<script>
$("#return_to_home_page").click(function(e) {
		//alert("Successful! Your offer was successful.");
        $("#page-body").load("mainPage.php");
		$("#_home").addClass("active" ); 
    });

/*
//this function is going to show the alert view and assing given data to it.
function show_pop_up_menu($image_url,name,mobile_num,email,rate,user_id)
{
	//alert("dklfnhodhn");
	$("#fullname").html(name);
	$("#mobile").html(mobile_num);
	$("#personal_image").prop("src","UsersImages/" +  $image_url);
	$("#rate").html(rate);
	$("#email").html(email);
	$('#User_Info').modal('show');
	$("#user_id_to_send_messsege").attr("value") = user_id;
}

function show_user_info($user_id)
{
	//here get the information from database 
	$.post("assets/get_user_information.php","id=" + $user_id,function(response)
	{
		var $data = response.split(",");
		show_pop_up_menu($data[3],$data[0],$data[2],$data[1],2,$data[4]);
	});
}

function send_this_user_messege()
{
	console.log($("#user_id_to_send_messsege").attr("value"));	
}

*/

//google garbage 
//this function is gonna show trip road map 


  //this is a global variable inorder to help me to know what is the id of the user that i wanna send hem amessege
  var user_id_to_send_messege;
  
  //this function is going to show the alert view and assing given data to it.
  function show_pop_up_menu($image_url,name,mobile_num,email,rate,user_id)
  {
	  //alert("dklfnhodhn");
	  $("#fullname").html(name);
	  $("#to").html(name);
	  $("#mobile").html(mobile_num);
	  $("#personal_image").prop("src","UsersImages/" +  $image_url);
	  $("#rate").html(rate);
	  $("#email").html(email);
	  $('#User_Info').modal('show');
	  user_id_to_send_messege = user_id;
	  //$("#user_id_to_send_messsege").attr("name") = user_id;
  }
  
  //show user information in popup div 
  function show_user_info($user_id)
  {
	  //here get the information from database 
	  $.post("assets/get_user_information.php","id=" + $user_id,function(response)
	  {
		  var $data = response.split(",");
		  show_pop_up_menu($data[3],$data[0],$data[2],$data[1],2,$data[4]);
	  });
  }
  
  //this function is gonna send the user messege 
  function send_this_user_messege()
  {
	  //console.log(user_id_to_send_messege);
	  $('#User_Info').modal('hide');
	  $('#messege_menu').modal('show');
	  
	  
	  //onclike event listener 
	  $("#send_btn").click(function ()
	  {
		  //get messege params 
		  var $title = $("#title").val();
		  var $body = $("#messege-body").val();
          var $data =("receiver=" + user_id_to_send_messege + "&Messege_body=" + $body + "&title="
		                                 + $title);
		
			//send the messege 
		  $.post("send_messege_function.php",$data,function(response)
		  {
			  if(response == "SUCESS")
			  {
				  //alert(response);
				  $("#messege_menu").modal("hide");
				  $("#title").val("");
				  $("#messege-body").val("");
				  //field must be empty 
			  }
			  else
			  {
				  //maybe problem
			  }
			  
		  });
		  //here put ajax code to send the messege 	
	  });
  }

function loooo()
{
    

var lat1,long1,lat2,long2;

var geocoder =  new google.maps.Geocoder();

    geocoder.geocode( { 'address': '<?php  echo $from ;?>'}, function(results, status) 
	{
          if (status == google.maps.GeocoderStatus.OK)
		  {
            lat1 = results[0].geometry.location.lat();
			long1 = results[0].geometry.location.lng(); 
          } 
		  else 
		  {
            alert("Something got wrong " + status);
          }
        });
		
		geocoder.geocode( { 'address': '<?php  echo $to ;?>'}, function(results, status) 
		{
          if (status == google.maps.GeocoderStatus.OK)
		  {
            lat2 = results[0].geometry.location.lat();
			long2 = results[0].geometry.location.lng(); 
          } 
		  else 
		  {
            alert("Something got wrong " + status);
          }
        });

var latLng1 = new google.maps.LatLng(lat1,long1);
var latLng2 = new google.maps.LatLng(lat2,long2); 

 var mapProp = 
 {
	  center:new google.maps.LatLng(51.508742,-0.120850),
	  zoom:5,
	  mapTypeId:google.maps.MapTypeId.ROADMAP
  };
var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

var marker1 = new google.maps.Marker(
{
    position: latLng1,
    title: 'Marker1',
    map: map,
    draggable: true
  });
  
  var marker2 = new google.maps.Marker({
    position: latLng2,
    title: 'Marker2',
    map: map,
    draggable: true
  });
  
  }
  
  google.maps.event.addDomListener(window, 'load', loooo);



</script>
<div class="span12">
<!--<h2>Road Map</h2>-->
</div>
<div id="googleMap" style="width:500px;height:380px;"></div>
</div>
