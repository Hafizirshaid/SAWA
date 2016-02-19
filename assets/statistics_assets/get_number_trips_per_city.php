<?php
/*
	THIS CODE IS WRITTEN BY HAFIZ K.IRSHAID 
	DATE 30/11/2013
	NAJAH NATIONAL UNIVERSITY 
	COMPUTER ENGINEERING DEPARTMENT 
	GRADUATION PROJECT 1
	DESCRIPTION:
		this code is gonna get how many offered trips from and to each palestinan city in a given date 
*/
include_once("../../Database_connection.php");
$db_class = new Databse_connection  ();
$db = $db_class->return_database_conncection();
///return elements .

//palestinaian cites 
$cites_array = array();

//number of trips in  given date from this city 
$number_of_trips_from_city = array();

//number of trips in a given date to this city 
$number_of_trips_to_city = array();


$date = $_POST['date'];
//$date = "2013-12-01";

//get all palesininan cites 
$query = "select * from cities";
$result = $db->query($query);
//echo $query;

//get ll paestinian cities 
while($city = $result->fetch_assoc())
{
	$city_name = $city['city_name'];
	array_push($cites_array,$city_name);
}
//print_r($cites_array);
//get the city and how many from and to trip 
foreach ($cites_array as $city ) 
{

	//from
	$query_from = "select COUNT(*) from offered_trips where fromLoc='$city' and trip_date='$date'";
	//echo $query_from;

	$result = $db->query($query_from);
	$count_trips_from_this_city = $result->fetch_row();
	array_push($number_of_trips_from_city, $count_trips_from_this_city[0]);
	
	//do the same thing for to city 
	//from
	$query_to = "select COUNT(*) from offered_trips where toLoc='$city' and trip_date='$date'";
	$result = $db->query($query_to);
	$count_trips_to_this_city = $result->fetch_row();
	array_push($number_of_trips_to_city, $count_trips_to_this_city[0]);
	//echo $query_to;

}

//print the data in spical format, i know that i have to use json, but i wanna use my own notiation  


echo "|";
foreach ($cites_array as $value)
{
	echo $value.",";
}
echo "|";

foreach ($number_of_trips_from_city as $value2)
{
	echo $value2.",";
	//print_r($value2);
}

echo "|";

foreach ($number_of_trips_to_city as $value3)
{
	echo $value3.",";
	//print_r($value3);
}
echo "|";


/*
echo "<br>****************<br>";
print_r($cites_array);
echo "<br>***********<br>";
print_r($number_of_trips_from_city);
echo "<br>*****<br>";

print_r($number_of_trips_to_city);
echo "<br>******************<br>";
echo json_encode($number_of_trips_to_city);
echo "<br>*********************<br>";


echo json_encode($number_of_trips_from_city);
echo "<br>*********************<br>";

echo json_encode($cites_array);

echo "<br>*********************<br>";
*/
?>