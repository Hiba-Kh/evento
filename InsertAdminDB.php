<?php
$connect = mysqli_connect("localhost", "root", "", "evento");

    require "models.php";
    session_start();
    $event_id=$_SESSION['event_id'];


//Variables
$speakers_Array_Comma=$_POST["hidden_framework"];
$speakers_Array_WithOutComma= explode(',', $speakers_Array_Comma);
$speaker_Array_names=array();
$i=0;
$j=0;

foreach ($speakers_Array_WithOutComma as $key => $speaker_name) {
    $speaker_Array_names[$i]= $speaker_name;
    $i++;
}

foreach ($speaker_Array_names as $key => $speaker_name_DB) {
    
  $query = "SELECT * FROM users where users.first_name='$speaker_name_DB'";
  $result = mysqli_query($connect, $query);
  $row = mysqli_fetch_array($result);
  $speaker_id = $row['user_id'];

  $query2 = "SELECT admin_id FROM admin where admin.admin_id=$speaker_id";
  $result2 = mysqli_query($connect, $query2);


if (mysqli_num_rows($result2) === 0)
{
  $query3 = "INSERT INTO admin (admin_id,user_id) VALUES ($speaker_id,$speaker_id)";
  if(mysqli_query($connect, $query3))
  {
$mysql2="SELECT * FROM users WHERE users.user_id = $speaker_id ";
$r2=mysqli_query($connect,$mysql2);
$row2= mysqli_fetch_assoc($r2);
$email=$row2['email'];       
$mysql3="UPDATE login SET type='admin' WHERE login.email='$email' ";
$r3=mysqli_query($connect,$mysql3);
   
  }
  else 
  {
     echo 'ma zabat yen7at fel tabel';  
  }
     
}
 else 
 {
          echo 'mawjod aslan fel admin tabel';  

 }
  $query4 = "INSERT INTO event_admin VALUES ($event_id,$speaker_id)";
  if(mysqli_query($connect, $query4))
  {
      if ($j===0){
   echo 'Admin/s are Selected Successfully';
   $j++;
      }
     
  }
  else 
 {
      echo 'ma n7at fe tabel el session speaker';
  
 }
  
  }


?>
