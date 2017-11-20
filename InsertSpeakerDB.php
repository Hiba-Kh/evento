<?php
$connect = mysqli_connect("localhost", "root", "", "evento");
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
  $query2 = "INSERT INTO like_table(framework) VALUES ($speaker_id)";
  if(mysqli_query($connect, $query2))
  {
      if ($j===0){
   echo 'Speakers are Selected Successfully';
   $j++;
      }
  }
}


?>
