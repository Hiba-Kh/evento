
<?php
$i=0;               
$mysql_qry_audience="SELECT * FROM event_audience where event_audience.audience_id=$user->id";
$r_audience=mysqli_query($conn,$mysql_qry_audience);
if (empty($r_audience))
{
$empty_div=0;                                    
die(mysqli_error($conn)); 
}
else {

$row_audience= mysqli_fetch_assoc($r_audience);
$event_id=$row_audience['event_id'];

$mysql_qry_event="SELECT * FROM my_event where my_event.event_id=$event_id";
$r=mysqli_query($conn,$mysql_qry_event);

while ($row_event= mysqli_fetch_assoc($r)) 
    {
$event = new eventData();
$event->event_id = $row_event['event_id'];
$event->location = $row_event['location_id'];
$event->name_event = $row_event['event_name'];
$event->start_date = $row_event['start_date'];
$event->end_date = $row_event['end_date'];

$id=$row_event['event_id'];
$arr_date[$j] = $row_event['start_date'];
//Display If it has Agenda
$mysql_qry3="SELECT * FROM agenda WHERE agenda.event_id = $id ";
$r3=mysqli_query($conn,$mysql_qry3);
if (!$r3)
{
$event->start = 'un';
$event->end ='un';
}
else{
 $row3= mysqli_fetch_assoc($r3);
$event->start = $row3['start_time'];
$event->end = $row3['end_time'];
}
$arr[$i]=$event;
$i++;
    }
}


$j=0;               
$mysql_qry_Intrested="SELECT * FROM interested where interested.user_id=$user->id";
$r_Intrested=mysqli_query($conn,$mysql_qry_Intrested);

if (!$r_Intrested)
{
$empty_div2=0;                                    
   die(mysqli_error($conn)); 
}
else {
 $row_Intrested= mysqli_fetch_assoc($r_Intrested);
 $conference_type=$row_Intrested['interested_id'];
 $mysql_qry_Intrested2="SELECT * FROM my_event where my_event.event_type_id=$conference_type";
 $r_Intrested2=mysqli_query($conn,$mysql_qry_Intrested2);
    
while ($row_Intrested2= mysqli_fetch_assoc($r_Intrested2)) 
    {
$event2 = new eventData();
$event2->event_id = $row_Intrested2['event_id'];
$event2->location = $row_Intrested2['location_id'];
$event2->name_event = $row_Intrested2['event_name'];
$event2->start_date = $row_Intrested2['start_date'];
$event2->end_date = $row_Intrested2['end_date'];

$id2=$row_Intrested2['event_id'];
$arr_date2[$j] = $row_Intrested2['start_date'];
//Display If it has Agenda
$mysql_qry3_Intrested="SELECT * FROM agenda WHERE agenda.event_id = $id2 ";
$r3_Intrested=mysqli_query($conn,$mysql_qry3_Intrested);
if (!$r3_Intrested)
{
$event2->start = 'un';
$event2->end ='un';
}
else{
$row3_Intrested= mysqli_fetch_assoc($r3_Intrested);
$event2->start = $row3_Intrested['start_time'];
$event2->end = $row3_Intrested['end_time'];
}
$arr2[$j]=$event2;
$j++;
    }
}
?>