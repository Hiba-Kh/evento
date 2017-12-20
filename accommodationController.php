<?php
header('Content-Type: application/json');
$event_id = $_GET["id"];
require "models.php";
require "conn.php";
require "sources.php";


$accommodation = new accommodation();

$mysql_qry="SELECT * FROM accommodation WHERE event_id='$event_id'";
$result=mysqli_query($conn, $mysql_qry);


    while($row = mysqli_fetch_assoc($result)) 
    {
        $accommodation->location_description = $row ["location_description"];
       
        $accommodation->suggested_hotels = $row["suggested_hotels"];
        
        $accommodation->hall_name = $row["hall_name"];
        
        $accommodation->contact_phone_number= $row["contact_phone_number"];
        
        $accommodation->contact_email = $row["contact_email"];
        
    }


echo json_encode($accommodation);

?>