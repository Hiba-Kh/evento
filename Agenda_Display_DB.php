<?php
header('Content-Type: application/json');
$id = $_GET["id"];
require "conn.php";
require "models.php";
session_start();

$resp =array();
$arr =array();
$sp=[];
$sp_fname =array();
$sp_lname =array();
$sp_con=array();
$i=0;
$s=0;

$mysql_qry="SELECT * FROM agenda WHERE agenda.event_id = $id ";
$r=mysqli_query($conn,$mysql_qry);
if (!$r)
{
   die(mysqli_error($conn)); 
}
else {
    if (mysqli_num_rows($r) > 0)
    {
while ($row=mysqli_fetch_assoc($r)) 
{ 
$agenda_id=$row['agenda_id'];
$date_agenda=$row['agenda_date'];
$mysql_qry2="SELECT * FROM sessions WHERE sessions.agenda_id = $agenda_id ";
$r2=mysqli_query($conn,$mysql_qry2);
if (!$r2)
{
    echo "Failed";
   die(mysqli_error($conn)); 
}
else {

while ($row2= mysqli_fetch_assoc($r2)) 
        {
    $myObj1 = new Anything();
    $myObj1->date_agenda=$date_agenda;
    $myObj1->id = $agenda_id;
    $myObj1->session_id = $row2['session_id'];
    $myObj1->event_id=$id;
    $session_id =$row2['session_id'];
    $myObj1->name = $row2['title'];
    $myObj1->start = $row2['start_time'];
    $myObj1->end = $row2['end_time'];
    $myObj1->location = $row2['location'];
    
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
    $myObj1->speakers = $sp_fname;
    $arr[$s]=$myObj1;
    $s++;
}}}}}
 $_SESSION['session_data'] = $arr;
 header("location: Agenda_Display_Test.php");

?>