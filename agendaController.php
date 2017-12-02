<?php
header('Content-Type: application/json');
$event_id = $_GET["id"];
require "models.php";
require "conn.php";
$size_2;
$resp =array();
$arr =array();
$sp=[];
$sp_fname =array();
$sp_lname =array();
$sp_con=array();
$i=0;
$s=0;
$mysql_qry="SELECT * FROM agenda WHERE event_id = $event_id ";
$result=mysqli_query($conn,$mysql_qry);
$row= mysqli_fetch_assoc($result);
$agenda_id=$row['agenda_id'];
$mysql_qry2="SELECT * FROM sessions WHERE sessions.agenda_id = $agenda_id ";
$result2=mysqli_query($conn,$mysql_qry2);
while ($row2= mysqli_fetch_assoc($result2)) 
{
        $myObj0 = new AgendaData();
        $myObj0->id = $row2['session_id'];
        $myObj0->event_id=$event_id;
        $session_id =$row2['session_id'];
        $myObj0->name = $row2['title'];
        $myObj0->start = $row2['start_time'];
        $myObj0->end = $row2['end_time'];
   
    
$mysql="SELECT * FROM my_event WHERE event_id = $event_id ";
$result_mysql=mysqli_query($conn,$mysql);
$row_mysql= mysqli_fetch_assoc($result_mysql);  
$myObj0->description = $row_mysql['description'];
$myObj0->start_date= $row_mysql['start_date'];


$mysql2="SELECT * FROM speaker WHERE speaker.event_id = $event_id ";
$result_mysql2=mysqli_query($conn,$mysql2);
$row_mysql2= mysqli_fetch_assoc($result_mysql2);  
$myObj0->no_speaker = count($row_mysql2);
$myObj0->no_tickets = '0';


$mysql_qry5="SELECT location_id FROM my_event WHERE my_event.event_id = $event_id";
$result5=mysqli_query($conn,$mysql_qry5);
while ($row5= mysqli_fetch_assoc($result5)) 
{
      $myObj0->location_id = $row5['location_id'];
}
$mysql_qry6="SELECT * FROM event_location WHERE location_id=$myObj0->location_id";
$result6=mysqli_query($conn,$mysql_qry6);
while ($row6= mysqli_fetch_assoc($result6)) 
{
    $myObj0->location_name=$row6['name'];
    $myObj0->location_address=$row6['address'];
    $myObj0->location_lng=$row6['lng'];
    $myObj0->location_lat=$row6['lat'];
    
} 
        $mysql_qry3="SELECT speaker_id FROM session_speaker WHERE session_speaker.session_id = $session_id ";
        $result3=mysqli_query($conn,$mysql_qry3);
        $sp=[];
        $sp_fname=[];
        $i=0;
        if (!$result3)
        {   
            die(mysqli_error($conn)); 
            $sp=[];
        }
        else 
        {
            if (mysqli_num_rows($result3) > 0)
            {
                while ($row3= mysqli_fetch_assoc($result3)) 
                {
                        $sp[$i]=$row3['speaker_id'];
                        $i++;
                }
            }
        }   
    for ($k=0,$size=count($sp); $k < $size;$k++)
        { 
            $mysql_qry4="SELECT first_name,last_name FROM users WHERE users.user_id = $sp[$k]";
            $r4=mysqli_query($conn,$mysql_qry4);
            $row4= mysqli_fetch_assoc($r4);
            $sp_fname[$k]=$row4['first_name'];
            $sp_lname[$k]=$row4['last_name'];
        }
        
        $myObj0->speakers = $sp_fname;
        $arr[$s]=$myObj0;
                $s++;

}



echo json_encode($arr);
?>