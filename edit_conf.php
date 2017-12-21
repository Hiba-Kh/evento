<?php
$c_name= $_GET["c_name"];
$id = $_GET["id"];

echo $c_name;
$servername = "localhost";
$database = "evento";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);


$mysql3="UPDATE my_event SET event_name=$c_name WHERE my_event.event_id=$id ";
$r3=mysqli_query($conn,$mysql3);

echo $r3;
            
?>