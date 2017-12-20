<?php 
session_start();
$event_id=$_SESSION['event_id'];
if(isset($_POST)){
	$conn = mysqli_connect('localhost','root','','evento');
	if(mysqli_query($conn,"INSERT INTO rate VALUES('','".$_POST['v3']."',$event_id,'".$_POST['v4']."')")){
		echo "1";		
	}else{
		echo "2";
	}
}
?>