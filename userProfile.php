<?php
include_once("Auth.php");


/*
 * This code written by Hafiz K.Irshaid 
 * Email : hkmmi.2010@gmail.com
 * Najah National University 
 * Computer Engineering Department
 * Date :  Oct 8, 2013
 */
include_once("Model/Requested_Trip.php");
include_once("Model/Offered_trip.php");
include_once("Model/User.php");
	  
	    //this function just print <td></td> before and after a given string 
 include_once("table_td.php");
?>
  <div id="trip_state_page">
  
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
  
  
  <ul class="nav nav-tabs" id="myTab">
	
	  <li class="active"><a href="#_profile">Profile</a></li>
	  <li><a href="#_pass" >Password</a></li>
	  <li><a href="#paypal" ><i class="icon-certificate"></i> Paypal</a></li>
	  <li><a href="#vehicleInfo">Vehicle Info</a></li>
	  <li><a style="font-size:16px" href="#offered_trips">Offered Trip State</a></li>
	  <li><a style="font-size:16px" href="#successful_trips">Successful Trips</a></li>
	  <li><a style="font-size:16px" href="#requsted_trips">Requsted Trip State</a></li>
	  
  </ul>
  <script type="text/javascript">
  
  
  $('#myTab a').click(function (e) 
  {
	e.preventDefault();
	$(this).tab('show');
  });
  </script>
  <div class="tab-content">
  
  <div class="tab-pane active" id="_profile">
  User Profile is Gonna be Here!
  <?php
  include("profile.php");
  
  ?>
  </div>
  
  <div class="tab-pane " id="_pass">
  <p>Change Password</p>
  <?php
  include("changePassword.php");
  
  ?>
  </div>
  
  <div class="tab-pane" id="paypal">
 <p> oisfhsahfv4</p>
  </div>
  
  <div class="tab-pane" id="vehicleInfo">
  siofhgsohuf
  </div>
  
  
  <div class="tab-pane " id="offered_trips">
  <div class="span12" id="offered_trip_state">
  	<?php
		/////offered trip state page
		include("offered_trip_state.php");
	?>
  </div>
  </div>
  
  <div class="tab-pane" id="successful_trips">
	  
	  <div class="span12">
     
	  <?php
	  include("successful_trips.php");
	  
	  ?>
    
  </div>
  </div>
  <div class="tab-pane" id="requsted_trips">
	  
	  <div class="span12">
		  <?php
		  	include("requsted_trip_state.php");
		  
		  ?>
         
	  </div>
	  </div>
  </div>
  </div>
  </div>
  <script>
  
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
  
  //delete offered trip 
  function delete_trip($trip_id)
  {
	  $("#successful_trips").click();
		//console.log($trip_id);  
		var $data="trip_id=" + $trip_id;
		$.post("assets/delete_offered_trip_by_trip_id.php",$data,function(response)
		{
			 $("#offered_trip_state").load("offered_trip_state.php");
			//console.log(response);
		});
  }
  
  //delete requsted trip
  function delete_requsted_trip($trip_id)
  {
	  console.log($trip_id);
	  var $data = "trip_id=" + $trip_id;
	  $.post("assets/delete_requisted_trip.php",$data,function(response)
	  {
		  //page must reloaded 
		  $("#requsted_trip_state").load("requsted_trip_state.php");
		  //console.log(response);
		  
	  });
  }


  //driver ignore requsted trip 
  function ignore_requsted_trip($offered_trip_id)
  {
	  console.log($offered_trip_id);
	  $data = "Requsted_trip_id=" + $offered_trip_id;
	  $.post("assets/ignore_trip.php", $data, function (response)
	  {
	  	//alert("sfkngiaudfg");
		   $("#offered_trip_state").load("offered_trip_state.php");
		  //here the response of the page 
		  //console.log(response);
	  });
	  //go to db and change the field offered_trip_accepted to Ignored and relod the page
	  //console.log($offered_trip_id);
  }
  
  
  function accept_requsted_trip($offered_trip_id)
  {
	  //console.log($offered_trip_id);
	  $data = "Requsted_trip_id=" + $offered_trip_id;
	  //console.log($data);
	  $.post("assets/accept_trip.php", $data, function (response)
	  {
			  //here the response of the page 	
			   $("#offered_trip_state").load("offered_trip_state.php");
			  //console.log(response);
	  });
	  
	  //go to db and change the field offered_trip_accepted to yes and reload the page 
	  //do not forget to send notification and messege and email to that user 
	  //console.log($offered_trip_id);	
  }
  
  </script>