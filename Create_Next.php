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
    var $wrong;

}

//echo $event_id;
if (isset($_POST['add']))
    {     
$id = $_GET["id"];
$myObj0 = new Anything();
$myObj0->id = $id ;

                    $date=$_POST['date_agenda']; 
                    $s_time=$_POST['s_time'];                 
                    $e_time=$_POST['e_time'];
           $paymentDate=date('Y-m-d', strtotime($date));
           
$mysql_qry_d="SELECT * FROM my_event WHERE my_event.event_id =$id";
$r2_d=mysqli_query($conn,$mysql_qry_d);
$row2_d= mysqli_fetch_assoc($r2_d);
$start_d = $row2_d['start_date']; 
$end_d = $row2_d['end_date'];               


 $contractDateBegin = date('Y-m-d', strtotime($start_d));
 $contractDateEnd = date('Y-m-d', strtotime($end_d));
    
if (($paymentDate >= $contractDateBegin) && ($paymentDate <= $contractDateEnd))
{
 $sql = "INSERT INTO agenda (event_id,agenda_date,start_time,end_time) VALUES ($id,'$date','$s_time','$e_time')";
 

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
else
{
header("Location:IncorrectDate.php?id=$id");

}
                   
            }          

?>