<?php
require("conn.php");

// Gets data from URL parameters.
$name = $_GET['name'];
$address = $_GET['address'];
$lat = $_GET['lat'];
$lng = $_GET['lng'];
$type = $_GET['type'];
$mysql_qry = "INSERT INTO event_location ( lat, lng, name, address) VALUES ('$lat','$lng','$name','$address')";
$result=mysqli_query($conn, $mysql_qry);

if(!$result) 
{
	die(mysqli_error($conn));
}
?>