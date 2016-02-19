<?php
session_start();

/*

	THIS CODE IS WRITTEN BY ENG.HAFIZ K.IRSHAID
	COMPUTER ENGINEERING DEPARTMENT 
	NAJAH NATIONAL UNIVERSITY 
	DATE 30-11-2013

DESCRIPTION:
	this code is gonna give the website administrator statistics about the trips 
		1-how many trips per day 
		2- the largest from loc trip 
		3- the largest to loc trips 
		4- number of trips for each city
		5-ETC 
*/

$user_id = $_SESSION['user_id'];
if($user_id == 45)
{
	//this is the admin
}
else
{
	echo "<h1>Forbidden!</h1>";
	exit;
}
?>
<script src="js/Chart.js"></script>

<div class="row">
	<div class="span12">
		<!--here the header of the page -->
		<h1 align=center>Statistics</h1>
		<hr>
		

	</div>
<div class="span6">
	<h3>Number of trips /day from, to city  </h3>
	<input type="date" id="date">
		<button class="btn" id="get_stat">Get Statistics</button>
	<canvas id="canvas1" height="450" width="600"></canvas>
</div>

<div class="span6">
	<h3>Number of trips/hour to each City from,to </h3>
	<select id="city" > 
	<?php
		include_once("Model/cities.php");
		$cities_object = new cities();
		$cites_array = $cities_object->get_all_cities();

		foreach ($cites_array as $city ) 
		{
			echo "<option value=$city>$city</option>";
		}


	?>
	</select>
	<input type="date" id="date2">
	<button class="btn" id="get_state_per_city">Get Statisitics</button>
	<canvas id="canvas2" height="450" width="600"></canvas>
	</div>
	<div class="span12"><hr></div>

<div class="span6">
	<h3>Average Number of trips per city</h3>

	<button class="btn" id="avg_stat">Get Statistics</button>

	<canvas id="canvas3" height="450" width="600"></canvas>
</div>

<div class="span6">
<p>
	the most city conjestion 
	the lowst city conjestion 
	which time is the maximum trips has in all trips 
</p>

</div>
</div>


<script>

//this function is gonna draw the chart in the given canvas
function draw_line_chart(canvas_id, labels_array, color1_data, color2_data)
{
	var barChartData = 
	{
			labels : labels_array,
			datasets : [
				{
					fillColor : "rgba(220,220,220,0.5)",
					strokeColor : "rgba(220,220,220,1)",
					scaleFontSize : 12,

					data : color1_data
				},
				{
					fillColor : "rgba(151,187,205,0.5)",
					strokeColor : "rgba(151,187,205,1)",
					scaleFontSize : 12,
					data : color2_data
				}
			]
		}

	var myLine = new Chart(document.getElementById(canvas_id).getContext("2d")).Bar(barChartData);
}

function show(date)
{
	alert(data);
	console.log(data);
}

//this is the event handler of the get statisictis for nuber of trips in this city per hour
$("#get_state_per_city").click(
	function(e)
	{
		//url of the page that wanna get the data 
	    var $url = "assets/statistics_assets/get_number_of_trips__per_hour.php";
	   	
	   	//data itselt 
	    var $data = "city=" + $("#city").val() + "&date=" + $("#date2").val();
		$.post($url, $data, function(response)
		{
			//console.log(response);
			//here the response from php page
			//you have to parse the data and use the function draw_chart to display the stateistics 
			
			//parse data
			var data_from_server = response.split("|");
			var hours = data_from_server[1];
			var from_hours = data_from_server[2];
			var to_hours = data_from_server[3];
			var hours_array = hours.split(",");
			var from_hours_array = from_hours.split(",");
			var to_hours_array = to_hours.split(",");

			//draw chart 
			draw_line_chart("canvas2", hours_array, from_hours_array, to_hours_array);
		});

	});

//event handler of .... 
$("#get_stat").click(
	function(e)
	{

		//get the date 
		$date = $("#date").val();

		$url = "assets/statistics_assets/get_number_trips_per_city.php";

		$.post($url,"date=" + $date, function(response)
		{
			
			//parse the data 
			var data_from_server = response.split("|");
			var palestine_cites = data_from_server[1];
			var from_count = data_from_server[2];
			var to_count = data_from_server[3];
			var palestine_cites_array = palestine_cites.split(",");
			var from_count_array = from_count.split(",");
			var to_count_array = to_count.split(",");

			//draw chart 
			draw_line_chart("canvas1",palestine_cites_array, from_count_array, to_count_array);
		});
});

$("#avg_stat").click(function()
	{
		var $url = "assets/statistics_assets/avg_number_of_trips.php";
		
		//no data in this case 
		var $data = "";

		$.post($url, $data,function(response)
		{
			var data_from_server = response.split("|");

			var cites = data_from_server[1];
			var from_avg = data_from_server[2];
			var to_avg = data_from_server[3];

			var cites_array = cites.split(",");
			var from_avg_array = from_avg.split(",");
			var to_avg_array = to_avg.split(",");

			draw_line_chart("canvas3",cites_array, from_avg_array, to_avg_array);

		});
	});

</script>