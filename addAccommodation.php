<?php
require "conn.php";
require "models.php";

$location_description = $_POST["description"];

$hotels = $_POST["hotels"];
$hall_name = $_POST["hall_name"];
$contact_phone_number= $_POST["contact_phone_number"];
$contact_email = $_POST["contact_email"];

$mysql_qry = "INSERT INTO accommodation (location_description,suggested_hotels,contact_phone_number,contact_email,hall_name)
 VALUES ('$location_description','$hotels','$contact_phone_number','$contact_email','$hall_name')";
$result=mysqli_query($conn, $mysql_qry);
        


?>