<?php
$servername = "localhost";
$database = "evento";
$username = "root";
$password = "";
$conn = mysqli_connect($servername, $username, $password, $database);
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

$mysql_qry="select username,msg,post_time from logs where logs.event_id=$id";
$r=mysqli_query($conn,$mysql_qry);

while($row=mysqli_fetch_array($r)){
	$name=$row['username'];
	$comment=$row['msg'];
    $time=$row['post_time'];
?>
<div class="chats"><strong><?=$name?>:</strong> <?=$comment?> <p style="float:right"><?=date("j/m/Y g:i:sa", strtotime($time))?></p></div>
<?php
}
?>