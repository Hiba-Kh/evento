<?php
header('Content-Type: application/json');
session_start();
$id = $_GET["id"];
$_SESSION['event_id']=$id;
$servername = "localhost";
$database = "evento";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);

class Anything {
                    var $id;
                    var $c_name;
                    var  $s_date;                 
                    var $e_date;    
                   
                    var $type;
                    var $location;
                    var $description;
                    var $number;
}

// Get data from database and do your logic 



$mysql_qry2="SELECT * FROM my_event WHERE my_event.event_id =$id";
$r2=mysqli_query($conn,$mysql_qry2);

if (!$r2)
{
    echo "Failed";
    echo "ERROR: Could not able to execute $mysql_qry2. " . mysqli_error($conn);
}
else {
$myObj0 = new Anything();
$row2= mysqli_fetch_assoc($r2);
$myObj0->id = $row2['event_id'];
$myObj0->c_name = $row2['event_name'];
$myObj0->s_date = $row2['start_date'];
$myObj0->e_date = $row2['end_date'];

$myObj0->description= $row2['description'];
$myObj0->number = $row2['number_att'];
$id_type= $row2['event_type_id'];
$mysql_qry="SELECT * FROM event_type WHERE event_type.event_type_id = '$id_type' ";
$r=mysqli_query($conn,$mysql_qry);
$row= mysqli_fetch_assoc($r);
$myObj0->type= $row['event_type_name'];
$myObj0->location = $row2['location_id'];

$resp = array($myObj0);
echo json_encode($resp);

}

            
?>