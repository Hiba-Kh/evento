<?php
header('Content-Type: application/json');
$id = $_GET["id"];
$servername = "localhost";
$database = "evento";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);
class Anything {

    var $id;
var $id_agenda;
}

//echo $event_id;
if (isset($_POST['add']))
    {     
$id = $_GET["id"];
$myObj0 = new Anything();
$myObj0->id = $id ;

                   $date=$_POST['date_agenda']; 
                   
$sql = "INSERT INTO agenda (event_id,agenda_date) VALUES ($id,'$date')";

if(mysqli_query($conn, $sql)){

$mysql_qry2="SELECT * FROM agenda WHERE agenda.event_id =$id";
$r2=mysqli_query($conn,$mysql_qry2);
$row2= mysqli_fetch_assoc($r2);
$id2 = $row2['agenda_id'];
$myObj0->id_agenda = $id2 ;
$resp = array($myObj0);
echo json_encode($resp);
header("Location:create_agenda.html?id=$id2");




} else{
  
  
}           
   
mysqli_close($conn);
           
            }          

?>