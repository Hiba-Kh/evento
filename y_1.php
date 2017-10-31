<?php
header('Content-Type: application/json');

$id = $_GET["id"];

$servername = "localhost";
$database = "evento";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);
/*class speaker {
    //var $id;
    var $name;
   // var picture;
}*/
class Anything {
    var $id;    
    var $session_id;    

        var $event_id;
        var $desc;
    var $name;
    var $start;
    var $end;
    var $location;
    var $speakers;
}
$size_2;
$resp =array();
$arr =array();
$sp=[];
$sp_fname =array();
$sp_lname =array();
$sp_con=array();
$i=0;
$s=0;

$mysql_qry="SELECT * FROM agenda WHERE agenda.agenda_id = $id ";
$r=mysqli_query($conn,$mysql_qry);
$row= mysqli_fetch_assoc($r);
$event_id=$row['event_id'];

/*
$mysql_qry_x="SELECT * FROM my_event WHERE my_event.event_id = $id ";
$r_x=mysqli_query($conn,mysql_qry_x);
$row_x= mysqli_fetch_assoc($r_x);
$description=$row_x['description'];
*/
$mysql_qry2="SELECT * FROM sessions WHERE sessions.agenda_id = $id ";
$r2=mysqli_query($conn,$mysql_qry2);

if (!$r2)
{
    echo "Failed";
   die(mysqli_error($conn)); 
}
else {

while ($row2= mysqli_fetch_assoc($r2)) 
        {
    $myObj0 = new Anything();
        $myObj0->id = $id;
    $myObj0->session_id = $row2['session_id'];

    $myObj0->event_id=$event_id;
    $session_id =$row2['session_id'];
    $myObj0->name = $row2['title'];
    $myObj0->start = $row2['start_time'];
    $myObj0->end = $row2['end_time'];
    $myObj0->location = $row2['location'];
    
$mysql_qry3="SELECT speaker_id FROM session_speaker WHERE session_speaker.session_id = $session_id ";
$r3=mysqli_query($conn,$mysql_qry3);
$sp=[];
$sp_fname=[];
$i=0;
if (!$r3)
{
   die(mysqli_error($conn)); 
   $sp=[];
}
else {
    if (mysqli_num_rows($r3) > 0)
    {
while ($row3= mysqli_fetch_assoc($r3)) 
{
    $sp[$i]=$row3['speaker_id'];
   // echo count($sp);
    $i++;
}
 

    }
    
}
 for ($k=0,$size=count($sp); $k < $size;$k++){ 
$mysql_qry4="SELECT first_name,last_name FROM users WHERE users.user_id = $sp[$k]";
$r4=mysqli_query($conn,$mysql_qry4);
$row4= mysqli_fetch_assoc($r4);
$sp_fname[$k]=$row4['first_name'];
$sp_lname[$k]=$row4['last_name'];
  }
  
    $myObj0->speakers = $sp_fname;
 //  $myObj0->speakers = [];
    $arr[$s]=$myObj0;
    $s++;
    
}
}
echo json_encode($arr);

?>