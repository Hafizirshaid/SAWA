<?php
session_start();
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

<h2>Search Results</h2>


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

<?php

$from = $_GET['from'];
$to = $_GET['to'];

$date = $_GET['date'];
$time = $_GET['time'];
//echo $time;
include_once("Model/Offered_trip.php");
$search_trip = new Offered_trip();

//get trips like the input 
$trips = $search_trip->search_trip($from, $to, $date, $time);

//if there is data show the table 
if(mysqli_num_rows($trips) > 0)
{
	//here print the result 
	include_once("Model/User.php");
	$drivername = new User();
	echo "<table class='table table-hover'>";
	
	?>
	<thead>
	<tr>
	<th>#</th>
	<th>From</th>
	<th>To</th>
	<th>Time</th>
	<th>Trip Cost</th>
    <th>Driver Name</th>
    
    <th>Avilable Seats</th>
    
	<?php
	if(isset($_SESSION['user_id']))
	{
		echo "<th>Choose Trip</th>";
		//here print button to let user to choose this trip 	
	}
	?>
	</tr>
	</thead>
	<tbody>
	<?php
	$i = 1;
	
	$drivername = new User();
	//show table for all results
	while($trip = $trips->fetch_row())
	{
		
		if($_SESSION['user_id'] != $trip[6])
		{
			//print the table 
			echo "<tr>";
			echo "<td>$i</td>";
			$i = $i + 1;
			echo "<td>$trip[1]</td>";
			echo "<td>$trip[2]</td>";


			echo "<td>$trip[3] ".$trip[4]."</td>";

			echo "<td>$trip[12]$</td>";
			
			
			//get Driver Name
			//echo $drivername->get_user_full_name_by_id($trip[5]);
			//get Driver Name
			echo "<td><a onClick=show_user_info($trip[6])>";
			echo $drivername->get_user_full_name_by_id($trip[6]);
			echo "</a></td>";
			
			$avilable_seats = $trip[10];
			echo "<td>$avilable_seats</td>";
			if(isset($_SESSION['user_id']))
			{		
				//note that $trip[0] is offered trip id 
		
				echo "<td><button class='btn' onClick='request_trip(".$trip[0].")'";
				if($avilable_seats == 0)
				{
					echo "disabled";	
				}
				echo ">Choose Trip</button></td>";
				//here print button to let user to choose this trip 	
			}
			echo "</tr>";	
		}
	}
	echo "</tbody>";
	echo "</table>";

}
else 
{
	//if there is no results so print this messege 
	echo "<h3>No Result</h3>";	
}
?>
<script>
 var user_id_to_send_messege;


function request_trip(offered_trip_id)
{
	//this function is gonna add new requested trip to the db and make the id of the offed trip is trip_id
	//note that the requested trip attriutes is the same attribute of the offered trip :)
	
	var $data = "offered_trip_id=" + offered_trip_id;
	$.post("assets/choose_from_search_trip.php", $data, function(response)
	{
		$("#page-body").html(response);	
	});
	console.log(offered_trip_id);
	
	//here is the code to request this trip 
}




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
  

</script>