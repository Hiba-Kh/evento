<?php
require "conn.php";
require "models.php";
session_start();
$user=$_SESSION['user_data'];

if (isset($_POST['done']))
    {      
 if (strcmp($user->type, "member")==0 || strcmp($user->type, "audience")==0 || strcmp($user->type, "speaker")==0)
{
$mysql2="SELECT * FROM users WHERE users.user_id = $user->id ";
$r2=mysqli_query($conn,$mysql2);
$row2= mysqli_fetch_assoc($r2);
$email=$row2['email'];       
$mysql3="UPDATE login SET type='admin' WHERE login.email='$email' ";
$r3=mysqli_query($conn,$mysql3);
if(!$r3){
    
  echo"failed"; 
}
else 
{
$mysql4="INSERT INTO admin (admin_id,user_id) VALUES ($user->id,$user->id)";
if(mysqli_query($conn, $mysql4)){
    echo"succ"; 
}
else 
{
   echo"failed"; 
}}}    
                    $c_name=$_POST['c_name'];
                    $s_date=$_POST['s_date'];                 
                    $e_date=$_POST['e_date'];    
                    $type=$_POST['type'];
                    $location=$_POST['location'];    
                    $des=$_POST['description'];
                    $number=$_POST['n_attendee'];  

$mysql_qry="SELECT event_type_id FROM event_type WHERE event_type.event_type_name = '$type' ";
$r=mysqli_query($conn,$mysql_qry);
$row= mysqli_fetch_assoc($r);
$event_type_id = $row['event_type_id'];

$sql = "INSERT INTO my_event (event_name,location_id,start_date,end_date,event_type_id,description,number_att,admin_id) VALUES ('$c_name',$location,'$s_date','$e_date',$event_type_id,'$des','$number',$user->id)";
if(mysqli_query($conn, $sql)){
$mysql_qry2="SELECT * FROM my_event WHERE my_event.event_name ='$c_name'";
$r2=mysqli_query($conn,$mysql_qry2);

if (!$r2)
{
    echo "Failed";
    echo "ERROR: Could not able to execute $mysql_qry2. " . mysqli_error($conn);
}
else {
$row2= mysqli_fetch_assoc($r2);
$id = $row2['event_id'];

$sql5 = "INSERT INTO logs (msg,event_id,post_time) VALUES (':',$id,CURRENT_TIMESTAMP)";
if(mysqli_query($conn, $sql)){
       echo "Succ";
}
else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);

}
header("Location:conf_sett.html?id=$id");
exit;
}
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
 
mysqli_close($conn);

    }
?>