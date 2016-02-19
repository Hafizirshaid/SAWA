<?php
include("Auth.php");

/*
 * This code written by Hafiz K.Irshaid 
 * Email : hkmmi.2010@gmail.com
 * Najah National University 
 * Computer Engineering Department
 * Date :  Oct 8, 2013
 */

//this function just print <td></td> before and after a given string 
function echo_table_td($str)
{
	echo "<td>$str</td>";	
}
?>
<div id=trip_state_page>

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


<ul class="nav nav-tabs" id="myTab">
  <li class="active"><a style="font-size:16px" href="#offered_trips">Offered Trip State</a></li>
  <li><a style="font-size:16px" href="#successful_trips">Successful Trips</a></li>
  <li><a style="font-size:16px" href="#requsted_trips">Requsted Trip State</a></li>
 
</ul>

<div class="tab-content">

 <div class="tab-pane active" id="offered_trips">
<div class="span12" id="offered_trip_state">
<h3>Offered Trip State</h3>
<?php
function echo_table_header()
{
?>
<table class="table table-hover">
    <thead>
        <th>Trip #</th>
        <th>From</th>
        <th>To</th>
        <th>Date</th>
     <th>Aviable Seats</th>
	</thead>
<?php
}
	include("Model/Requested_Trip.php");
    include("Model/Offered_trip.php");
	include("Model/User.php");
	$user_info = new User();
	$offered_trip = new Offered_trip();
	$offerd_trip_by_this_user = $offered_trip->get_offered_trips_by_user_id($_SESSION['user_id']);
	$i = 1;
	while($row = $offerd_trip_by_this_user->fetch_assoc())
	{
		echo_table_header();
		echo "<tbody>";
		echo "<tr>";
		
		echo_table_td($i);
		$i++;
		$seats = $row['seats'];
		echo_table_td($row['fromLoc']);
		echo_table_td($row['toLoc']);
		echo_table_td($row['trip_date']." ".$row['trip_time'].":00:00");
		echo_table_td($seats);
		echo "</tr>";
		echo "</table>";
		//here echo all requsted trips 
		
		$requsted_trips = new Requested_Trip();
		$requested_trips_assigned = $requsted_trips->get_requsted_trips_by_offered_trip_id($row['trip_id']);
		echo "Users Requsted this Trip :";
		
		while($div = $requested_trips_assigned->fetch_assoc())
		{		
			echo "<div class=span12>";
			echo "<div class=span1></div>";
			echo "<div class=span2>";
			echo "<a onClick=show_user_info(".$div['UserID'].")>";
			echo $user_info->get_user_full_name_by_id($div['UserID']);
			echo "</a>";
			echo "</div>";
			if($seats != 0)
			{
				echo "<div class=span1>";
				echo "<button class=btn onClick=accept_requsted_trip(".$div['trip_id'].")>Accept</button>";
				echo "</div>";
				echo "<div class=span1>";	
				echo "<button class=btn onClick=ignore_requsted_trip(".$div['trip_id'].")>Ignore</button>";
				echo "</div>";
			}
			else
			{
				echo "No Avialble Seats";	
			}
			
			//echo "<div class=clear></div>";
			echo "</div>";
		}
	}
?>

<hr>
</div>
</div>

<div class="tab-pane" id="successful_trips">
    
    <div class="span12">
    <h3>Successful Trips</h3>
    <table class="table table-hover">
    <thead>
        <th>Trip #</th>
        <th>From</th>
        <th>To</th>
        <th>Date</th>
     
	</thead>
    <tbody>
    <?php
		//here the code of sucessful trips that the user accept them
		$data = $requsted_trips->get_successful_requsted_trips_by_user_id($_SESSION['user_id']);
		$i = 1;
		while($row = $data->fetch_assoc())
		{
			echo_table_td($i);
			$i++;
			echo_table_td($row['from']);
			echo_table_td($row['to']);
			echo_table_td($row['Time_Date']);
				
		}
		
	?>
    </tbody>
    </table>
</div>
</div>
<div class="tab-pane" id="requsted_trips">
    
    <div class="span12">
        <h3>Requsted Trips Status</h3>
       
        <table class="table table-hover">
            <thead>
                <th>#</th>
                <th>From</th>
                <th>To</th>
                <th>Time</th>
                <th>Driver Name</th>
                <th>Status</th>       
            </thead>
            <tbody>
				<?php
                $trips = new Requested_Trip();
	
				//get all trips that this user request them 
                $all_trips = $trips->get_trips_by_user_id($_SESSION['user_id']);
                $offered_trip = new Offered_trip();
                
				//counter i
                $i = 1;
                $offered_trip_username = new Offered_trip();
                while($row = $all_trips->fetch_assoc())
                { 
                    echo "<tr>";
                    echo_table_td($i);
                    echo_table_td($row['from']);
                    echo_table_td($row['to']);
					echo_table_td($row['Time_Date']);
					$DriverId =  $offered_trip_username->get_user_id_from_offered_trip_id($row['offered_trip_id']);
					$DriverName = $user_info->get_user_full_name_by_id($DriverId);
					echo "<td>";
					//echo $row['Driver_id'];
					echo "<a href=# onClick=show_user_info(".$DriverId.")>";
					echo($DriverName);
					echo "</a></td>";                   
					echo_table_td($row['Trip_accepted_by_driver']);
                    echo "</tr>";
                    $i++;
                }    
                ?>
            </tbody>
        </table>
    </div>
    </div>
</div>
</div>
<script>

var user_id_to_send_messege;

function accept_requsted_trip($offered_trip_id)
{
	console.log($offered_trip_id);
	$data = "Requsted_trip_id=" + $offered_trip_id;
	console.log($data);
	$.post("assets/accept_trip.php", $data, function (response)
	{
			//here the response of the page 	
			$("#trip_state_page").load("trip_state.php");
			console.log(response);
	});
	
	//go to db and change the field offered_trip_accepted to yes and reload the page 
	//do not forget to send notification and messege and email to that user 
	console.log($offered_trip_id);	
}

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
	user_id_to_send_messege = user_id;
	//$("#user_id_to_send_messsege").attr("name") = user_id;
}

function ignore_requsted_trip($offered_trip_id)
{
	console.log($offered_trip_id);
	$data = "Requsted_trip_id=" + $offered_trip_id;
	/*$.post("assets/ignore_trip.php", $data, function (response)
	{
		//here the response of the page 
		console.log(response);
	});*/
	//go to db and change the field offered_trip_accepted to Ignored and relod the page
	console.log($offered_trip_id);
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

//this function is gonna send the user messege 
function send_this_user_messege()
{
	//console.log(user_id_to_send_messege);
	$('#User_Info').modal('hide');
	$('#messege_menu').modal('show');
	
	//onclike event listener 
	$("#send_btn").click(function ()
	{
		//here put ajax code to send the messege 	
	});
}

$('#myTab a').click(function (e) 
{
  e.preventDefault();
  $(this).tab('show');
});
</script>