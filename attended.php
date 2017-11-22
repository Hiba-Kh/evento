<?php
 require "conn.php";
 require "models.php";
  session_start();
 $user=$_SESSION['user_data'];
$i=0;
$j=0;
$l=0;
$arr=array();
$arr_date=array();
$arr_date_sorted=array();
$event_id;
$mysql_qry_audience="SELECT * FROM event_audience where event_audience.audience_id=$user->id";
$r_audience=mysqli_query($conn,$mysql_qry_audience);
$row_audience= mysqli_fetch_assoc($r_audience);
$event_id=$row_audience['event_id'];

$mysql_qry_event="SELECT * FROM my_event where my_event.event_id=$event_id";
$r=mysqli_query($conn,$mysql_qry_event);

if (!$r)
{
   echo "Failed";
   die(mysqli_error($conn)); 
}

else {
  
while ($row= mysqli_fetch_assoc($r)) 
        {
$myObj0 = new Anything();
$myObj0->id = $row['event_id'];
$id=$row['event_id'];
$myObj0->location =$row['location_id'];
$myObj0->name_event = $row['event_name'];
$myObj0->start_date = $row['start_date'];
$myObj0->end_date = $row['end_date'];
$arr_date[$j] =  $row['start_date'];

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

