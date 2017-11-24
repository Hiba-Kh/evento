<?php
    require "conn.php";
    require "models.php";

    session_start();
  
 $user=$_SESSION['user_data'];
//VARIABLES
$event_id;
$i=0;
$j=0;
$l=0;
$arr=array();
$arr_date=array();
$arr_date_sorted=array();
//GET ALL EVENTS THAT IS ADMINISTRATED BY THIS USER
$user_id=$user->id;
$mysql_qry="SELECT * FROM speaker where speaker.speaker_id=$user_id";
$r=mysqli_query($conn,$mysql_qry);

if (!$r)
{
   echo "NO events for this admin";
   die(mysqli_error($conn)); 
}
else {
$r=mysqli_query($conn,$mysql_qry);
$row= mysqli_fetch_assoc($r);
$event_id=$row['event_id'];
$mysql="SELECT * FROM my_event where my_event.event_id=$event_id";
$r_1=mysqli_query($conn,$mysql);
    
while ($row= mysqli_fetch_assoc($r_1)) 
    {
$myObj0 = new Anything();
$myObj0->event_id = $row['event_id'];
$myObj0->location =$row['location_id'];
$myObj0->name_event = $row['event_name'];
$myObj0->start_date = $row['start_date'];
$myObj0->end_date = $row['end_date'];

$id=$row['event_id'];
$arr_date[$j] =  $row['start_date'];
//Display If it has Agenda
$mysql_qry3="SELECT * FROM agenda WHERE agenda.event_id = $id ";
$r3=mysqli_query($conn,$mysql_qry3);
if (!$r3)
{
$myObj0->start = 'un';
$myObj0->end ='un';
}
else{
 $row3= mysqli_fetch_assoc($r3);
$myObj0->start = $row3['start_time'];
$myObj0->end = $row3['end_time'];
}
$arr[$i]=$myObj0;
$i++;
$j++;
    }
}

echo json_encode($arr);
?>

