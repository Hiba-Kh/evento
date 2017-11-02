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
$myObj0 = new AgendaData();

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
        //$event_id=$row['event_id'];
        $session_id =$row2['session_id'];
        $myObj0->name = $row2['title'];
        $myObj0->start = $row2['start_time'];
        $myObj0->end = $row2['end_time'];
        //$myObj0->location = $row2['location'];
        
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
                    // echo count($sp);
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
    //  $myObj0->speakers = [];
        $arr[$s]=$myObj0;
        $s++;
        
}


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

echo json_encode($arr);

?>