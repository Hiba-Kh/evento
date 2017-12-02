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
    var $event_id;
}
    
$myObj0 = new Anything();

$mysql_qry1="SELECT * FROM agenda WHERE agenda.agenda_id = $id";
$r1=mysqli_query($conn,$mysql_qry1);
$row1= mysqli_fetch_assoc($r1);
$event_id = $row1['event_id'];
$myObj0->id = $id ;
$myObj0->event_id=$event_id;
$resp = array($myObj0);
echo json_encode($resp);

if (isset($_POST['add']))
    {     
$id = $_GET["id"];
$user_id;
$event_id;
$session_id;
                     $speaker_id=[];
                     $session_name=$_POST['title'];
                     $s_time=$_POST['start_time'];                 
                     $e_time=$_POST['end_time'];
                     $location=$_POST['location'];

//1
$mysql_qry1="SELECT * FROM agenda WHERE agenda.agenda_id = $id";
$r1=mysqli_query($conn,$mysql_qry1);
$row1= mysqli_fetch_assoc($r1);
$event_id = $row1['event_id'];
echo "EventId Selected";

$current_time = $s_time;
$current_time2 = $e_time;

$sunrise = $row1['start_time'];
$sunset = $row1['end_time'];
/////////////////////////////////////////
$test1 = new DateTime($current_time);
$date1 = $test1->format('H:i');

$test2 = new DateTime($sunrise);
$date2 = $test2->format('H:i');

$test3 = new DateTime($sunset);
$date3 = $test3->format('H:i');

$test4 = new DateTime($current_time2);
$date4 = $test4->format('H:i');
///////////////////////////////////////
$sql = "INSERT INTO like_table VALUES ('$date1','$date3')";
$r_q=mysqli_query($conn, $sql);

if (($date1 >= $date2 && $date1 <= $date3) && ($date4 >= $date2 && $date4 <= $date3))
{
//5    
$sql_x = "INSERT INTO sessions (title,location,start_time,end_time,event_id,agenda_id) VALUES ('$session_name','$location','$s_time','$e_time',$event_id,$id)";
if(mysqli_query($conn, $sql_x)){
//7
header("Location:SessionAdded.php?id=$id");
//7
}
 else{
echo "NOT INSERTED IN DB SESSION";
}           
//5  
}     
else{
  header("Location:IncorrectTime.php?id=$id");
}
 mysqli_close($conn);

 } //end     
?>
