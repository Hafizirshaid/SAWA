  <?php
  include("Auth.php");
  include_once("Model/Requested_Trip.php");
include_once("Model/Offered_trip.php");
include_once("Model/User.php");
  /*
   * This code written by Hafiz K.Irshaid 
   * Email : hkmmi.2010@gmail.com
   * Najah National University 
   * Computer Engineering Department
   * Date :  Oct 8, 2013
   */
  include_once("table_td.php");

  ?>
  
<div id="offered_trip_state">
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
       <th>Delete Trip</th>
	  </thead>
  <?php
  }
	 
	  $user_info = new User();
	  $offered_trip = new Offered_trip();
	  $offerd_trip_by_this_user = $offered_trip->get_offered_trips_by_user_id($_SESSION['user_id']);
	  if(mysqli_num_rows($offerd_trip_by_this_user) > 0)
	  {


		  $i = 1;
		  while($row = $offerd_trip_by_this_user->fetch_assoc())
		  {
		  	  echo "<div style='border-style:solid;border-width:1px;'>";
			  echo_table_header();
			  echo "<tbody>";
			  echo "<tr>";
			  
			  echo_table_td($i);
			  $i++;
			  $seats = $row['seats'];
			  echo_table_td($row['fromLoc']);
			  echo_table_td($row['toLoc']);
			  echo_table_td($row['trip_date']." ".$row['trip_time']);
			  echo_table_td($seats);
			  $trip_id = $row['trip_id'];
			  echo_table_td("<button class=btn onClick='delete_trip($trip_id)'>Delete</button>");
			  echo "</tr>";
			  echo "</tbody>";
			  echo "</table>";
			  //here echo all requsted trips 
			  
			  $requsted_trips = new Requested_Trip();
			  $requested_trips_assigned = $requsted_trips->get_requsted_trips_by_offered_trip_id($trip_id);
			  
			  if(mysqli_num_rows($requested_trips_assigned) > 0)
			{
				  echo "<strong>Users Requsted this Trip :</strong>";
				  
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
						  if($div['Trip_accepted_by_driver'] != "yes")
						  {
							    echo "<div class=span1>";
							    echo "<button class=btn onClick=accept_requsted_trip(".$div['trip_id'].")>Accept</button>";
						  		echo "</div>";
						  }
						  else
						  {
							  echo "<div class=span1>";	
							  echo "<button class=btn onClick=ignore_requsted_trip(".$div['trip_id'].")>Ignore</button>";
							  echo "</div>";
						  }
					  }
					  else
					  {
						  echo "<strong>No Avialble Seats</strong>";	
					  }
					  echo "</div>";
				  }//while
				}//if
				else
				{
					echo "<strong>There are no users requst this trip.</strong>";
				}//else

				echo "</div>";
		  }

	}//big if 
	else
	{
		echo "<strong>You do not have offered trips.</strong>";
	}
  ?>
  
  <hr></div>