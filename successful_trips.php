<?php
  include("Auth.php");
  include_once("Model/Requested_Trip.php");
	  include_once("Model/Offered_trip.php");
	  include_once("Model/User.php");
  /*include("Model/Requested_Trip.php");
  include("Model/Offered_trip.php");
  include("Model/User.php");
  /*
   * This code written by Hafiz K.Irshaid 
   * Email : hkmmi.2010@gmail.com
   * Najah National University 
   * Computer Engineering Department
   * Date :  Oct 8, 2013
   */
  
  //this function just print <td></td> before and after a given string 
include_once("table_td.php");
  ?>
  
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
		  $rrr = new Requested_Trip();
		  $data = $rrr->get_successful_requsted_trips_by_user_id($_SESSION['user_id']);
		 
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
  