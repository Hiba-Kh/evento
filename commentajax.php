<?php
$id = $_GET["id"];

$servername = "localhost";
$database = "evento";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);

if(isset($_POST['user_comm']) && isset($_POST['user_name']))
{
  $comment=$_POST['user_comm'];
  $name=$_POST['user_name'];
  
$mysql_qry = "INSERT INTO logs (username,msg,post_time,event_id) VALUES('$name','$comment',CURRENT_TIMESTAMP,$id)";
$result=mysqli_query($conn, $mysql_qry);

}

?>