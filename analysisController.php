<?php
header('Content-Type: application/json');
$event_id = $_GET["id"];

require "conn.php";
require "models.php";
require "sources.php";
$arr=[];
$Data = new AnalysisData();
$mysql_qry1="SELECT * FROM my_event WHERE event_id = $event_id ";
$result1=mysqli_query($conn, $mysql_qry1);
$row1 = mysqli_fetch_assoc($result1);
$NoOfAttendee=$row1['NoOfAttendee'];
$Data->NoOfAttendee = $NoOfAttendee;
$NoOfInterested=$row1['NoOfInterested'];
$Data->NoOfInterested = $NoOfInterested;

echo json_encode($Data);

?>
