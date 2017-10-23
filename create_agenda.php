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
    /*var $name;
    var $start;
    var $end;
    var $location;
    var $speakers;
    
    var $c_name;
    var $s_date;
    var $e_date;
    var $description;*/
    
}
    
$myObj0 = new Anything();
$myObj0->id = $id ;
$resp = array($myObj0);
echo json_encode($resp);

if (isset($_POST['add']))
    {     

$id = $_GET["id"];
$user_id;
$event_id;
$session_id;
//$email_sp=array();
                  $speaker_id=[];
                   $session_name=$_POST['title'];
                     $s_time=$_POST['start_time'];                 
                     $e_time=$_POST['end_time'];
                     $email_sp=$_POST['email_sp'];
                     $location=$_POST['location'];

//1
$mysql_qry1="SELECT * FROM agenda WHERE agenda.agenda_id = $id";
$r1=mysqli_query($conn,$mysql_qry1);
$row1= mysqli_fetch_assoc($r1);
$event_id = $row1['event_id'];
echo "EventId Selected";

//1
//
if (!empty($email_sp))
{
//2
$mysql_qry2="SELECT * FROM users WHERE users.email = '$email_sp'";
$r2=mysqli_query($conn,$mysql_qry2);
if (!$r2)
{   
 //6   
    echo "WHAT TO DO ! IF NOT FOUND IN DATABASE";
//6
}
else {
$row2= mysqli_fetch_assoc($r2);
$user_id = $row2['user_id'];
echo "USERId Selected";
//احط جملة الاي دي للسبيكر هون حسب اليوزر اي دي
}
 //2
//3
$mysql_qry3="SELECT * FROM speaker WHERE speaker.speaker_id = $user_id";
$r3=mysqli_query($conn,$mysql_qry3);
if (!$r3)
{   
 //4  
echo "NOT FOUND in DB";    
$sql4 = "INSERT INTO speaker (user_id,speaker_id,event_id) VALUES ($user_id,$user_id,$event_id)";
if(mysqli_query($conn, $sql4)){
    echo "inserted succ";
}
 else{
      echo "NOT inserted in speaker(failed)";
}           
mysqli_close($conn);
//4
}
else {
      echo "FOUND speaker in DB NO need to re-insert it again";
}
//3

//5
$sql5 = "INSERT INTO sessions (title,location,start_time,end_time,event_id,agenda_id) VALUES ('$session_name','$location','$s_time','$e_time',$event_id,$id)";
if(mysqli_query($conn, $sql5)){
//7
$mysql_qry7="SELECT * FROM sessions WHERE sessions.event_id = $event_id";
$r7=mysqli_query($conn,$mysql_qry7);
$row7= mysqli_fetch_assoc($r7);
$session_id = $row7['session_id'];
echo "SessionId Selected";

//7
}
 else{
        echo "NOT INSERTED IN DB SESSION";

}           
mysqli_close($conn);
//5
//8
$sql8 = "INSERT INTO session_speaker (session_id,speaker_id) VALUES ($session_id,$user_id)";
if(mysqli_query($conn, $sql8)){
echo "INSERTED IN DB SESSION-SPEAKER";
        header("Location:create_agenda.html?id=$id");
}
 else{
  echo "NOT INSERTED IN DB SESSION-SPEAKER";
echo "ERROR: Could not able to execute $sql8. " . mysqli_error($conn);
}           
mysqli_close($conn);
//8
}//if

else
{
  //5
$sql_x = "INSERT INTO sessions (title,location,start_time,end_time,event_id,agenda_id) VALUES ('$session_name','$location','$s_time','$e_time',$event_id,$id)";
if(mysqli_query($conn, $sql_x)){
//7
$mysql_qry_y="SELECT * FROM sessions WHERE sessions.event_id = $event_id";
$r_y=mysqli_query($conn,$mysql_qry_y);
$row_y= mysqli_fetch_assoc($r_y);
$session_id = $row_y['session_id'];
echo "SessionId Selected";
header("Location:create_agenda.html?id=$id");

//7
}
 else{
        echo "NOT INSERTED IN DB SESSION";
echo "ERROR: Could not able to execute $sql_x. " . mysqli_error($conn);

}           
mysqli_close($conn);
//5  
  
}



 } //end     
?>
