<?php
include_once("Auth.php");
include_once("Model/Requested_Trip.php");
include_once("Model/Offered_trip.php");
include_once("Model/User.php");
?>


<?php
/*
include("Model/Requested_Trip.php");
include("Model/Offered_trip.php");
include("Model/User.php");
*/
?>

<?php
  /*
   * This code written by Hafiz K.Irshaid 
   * Email : hkmmi.2010@gmail.com
   * Najah National University 
   * Computer Engineering Department
   * Date :  Oct 8, 2013
   */
  
  //this function just print <td></td> before and after a given string 
include_once("table_td.php");

$trips = new Requested_Trip();
	  
				  //get all trips that this user request them 
				  $all_trips = $trips->get_trips_by_user_id($_SESSION['user_id']);
				  $offered_trip = new Offered_trip();
				  $user_info = new User();
				  //counter i
				  $i = 1;
				  $offered_trip_username = new Offered_trip();

				  if(mysqli_num_rows($all_trips) > 0)
				  {
  ?>
  
<div id="requsted_trip_state">
<h3>Requsted Trips Status</h3>
<div class="span12">
<a > See if there are similler trips offered</a>
this link must go to a page that show all trips that the same things 
</div>		 
         
		  <table class="table table-hover">
			  <thead>
				  <th>#</th>
				  <th>From</th>
				  <th>To</th>
				  <th>Time</th>
				  <th>Driver Name</th>
				  <th>Status</th>
                  <th>See if there are simmiler trips</th>
                  <th>Delete Trip</th>       
			  </thead>
			  <tbody>
				  <?php
				  
				  while($row = $all_trips->fetch_assoc())
				  { 
					  echo "<tr>";
					  echo_table_td($i);
					  echo_table_td($row['from']);
					  echo_table_td($row['to']);
					  echo_table_td($row['Time_Date']);
					  //echo_table_td("hafiz");
					  //driver here 
					  $offered_trip_id = $row['offered_trip_id'];

					  //if offered trip is zero so there is no one add this trip to his offered trip 
					  if($offered_trip_id != 0)
					  {
						  $DriverId =  $offered_trip_username->get_user_id_from_offered_trip_id($offered_trip_id);

						  if(isset($DriverId))
						  {
							  $DriverName = $user_info->get_user_full_name_by_id($DriverId);
							  echo "<td>";
							  //echo $row['Driver_id'];
							  echo "<a href=# onClick=show_user_info(".$DriverId.")>";
							  echo($DriverName);
							  echo "</a></td>";  
						  }
						  else
						  {
						  	echo_table_td("Trip Deleted By the Driver");
						  }
					  }
					  else
					  {
							echo_table_td("No one choose this trip yet!");  
					  }
					  echo_table_td($row['Trip_accepted_by_driver']);
					  echo_table_td("ok");
					//echo_table_td("<button class=btn onClick='delete_requsted_trip(".$row['trip_id']".)'>Delete</button>");
					  $requst_trip_id = $row['trip_id'];
   						echo_table_td("<button class=btn onClick='delete_requsted_trip($requst_trip_id)'>Delete</button>");
					  echo "</tr>";
					  $i++;
				  }    
				  ?>
			  </tbody>
		  </table>
          </div>


          <?php
          }
          else
          {
?>
	
	<h3>Requsted Trips Status</h3>
	<h5>You do not have requsted trips</h5>
	
<?php
	     }
          ?>