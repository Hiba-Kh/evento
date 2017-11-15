<?php
$servername = "localhost";
$database = "evento";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);

if(isset($_POST['user_comm']) && isset($_POST['user_name']))
{
  $comment=$_POST['user_comm'];
  $name=$_POST['user_name'];
  
  $mysql_qry = "insert into logs (username,msg,post_time) values('$name','$comment',CURRENT_TIMESTAMP)";
$result=mysqli_query($conn, $mysql_qry);

}

?>