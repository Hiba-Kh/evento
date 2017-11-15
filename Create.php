<?php

//$id = $_GET["id"];

$servername = "localhost";
$database = "evento";
$username = "root";
$password = "";
$conn = mysqli_connect($servername, $username, $password, $database);
// Get data from database and do your logic 
if (isset($_POST['done']))
    {      
                   $c_name=$_POST['c_name'];
                    $s_date=$_POST['s_date'];                 
                    $e_date=$_POST['e_date'];    
                    $s_time=$_POST['s_time'];                 
                    $e_time=$_POST['e_time'];
                    $type=$_POST['type'];
                    $location=$_POST['location'];    
                    $des=$_POST['description'];
                    $number=$_POST['n_attendee'];  

$mysql_qry="SELECT event_type_id FROM event_type WHERE event_type.event_type_name = '$type' ";
$r=mysqli_query($conn,$mysql_qry);
$row= mysqli_fetch_assoc($r);
$event_type_id = $row['event_type_id'];



$sql = "INSERT INTO my_event (event_name,location_id,start_date,end_date,start_time,end_time,event_type_id,description,number_att) VALUES ('$c_name',$location,'$s_date','$e_date','$s_time','$e_time',$event_type_id,'$des','$number')";
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
//header("Location:conf_sett.html?id=$event_id");

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
       
/*
$myObj0 = new Anything();

$myObj0->name =  $c_name;

$resp = array($myObj0);

 json_encode($resp);

            
*/
    }
?>