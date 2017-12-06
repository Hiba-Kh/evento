<?php
$connect = mysqli_connect("localhost", "root", "", "evento");

    require "models.php";
    session_start();
    $session_id=$_SESSION['session_id'];
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
   echo $speaker_id;  

  $query2 = "SELECT speaker_id FROM speaker where speaker.speaker_id=$speaker_id";
  $result2 = mysqli_query($connect, $query2);


if (mysqli_num_rows($result2) === 0)
{
  $query3 = "INSERT INTO speaker (speaker_id,user_id,event_id) VALUES ($speaker_id,$speaker_id,$event_id)";
  if(mysqli_query($connect, $query3))
  {
   if ($j===0){
   echo 'Speakers inserted in into speakers tabel';
   $j++;
      }
      
  }
  else 
  {
     echo 'ma zabat yen7at fel tabel';  
  }
     
}
 else 
 {
          echo 'mawjod aslan fel speaker tabel';  

 }
  $query4 = "INSERT INTO session_speaker VALUES ($session_id,$speaker_id)";
  if(mysqli_query($connect, $query4))
  {
      if ($j===0){
   echo 'Speakers are Selected Successfully';
   $j++;
      }
     
  }
  else 
 {
      echo 'ma n7at fe tabel el session speaker';
  
 }
  
  }


?>
