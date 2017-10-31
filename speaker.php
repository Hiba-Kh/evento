<?php
header('Content-Type: application/json');

//$id = $_GET["id"];

$servername = "localhost";
$database = "evento";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);

class Anything {
   // var $id;
    var $speakers;
}
$size_2;
$sp=[];
$sp_fname =array();
$sp_lname =array();
$sp_con=array();
$i=0;
$s=0;

$myObj0 = new Anything();
$myObj0->speakers=array();
$mysql_qry3="SELECT * FROM speaker ";
$r3=mysqli_query($conn,$mysql_qry3);
$sp=[];
$sp_fname=[];
$i=0;

if (!$r3)
{
   die(mysqli_error($conn)); 
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
    $myObj0->speakers = $sp_fname;
    $arr=array($myObj0);
       
echo json_encode($arr);

?>