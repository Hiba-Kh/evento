<?php
header('Content-Type: application/json');
$servername = "localhost";
$database = "evento";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);

class Anything {
    var $id;
    var $location;
    var $name_event;
    var $start;
    var $start_date;   
    var $end_date;
    var $end;
}
$event_id;
$mysql_qry="SELECT * FROM my_event";
$r=mysqli_query($conn,$mysql_qry);
$i=0;
$j=0;
$l=0;
$arr=array();
$arr_date=array();
$arr_date_sorted=array();

     ;
if (!$r)
{echo "Failed";
   die(mysqli_error($conn)); 
}

else {
  
while ($row= mysqli_fetch_assoc($r)) 
        {
$myObj0 = new Anything();
$myObj0->id = $row['event_id'];
$myObj0->location =$row['location_id'];
$myObj0->name_event = $row['event_name'];
$myObj0->start = $row['start_time'];
$myObj0->start_date = $row['start_date'];
$myObj0->end_date = $row['end_date'];

$arr_date[$j] =  $row['start_date'];

$myObj0->end = $row['end_time'];
$arr[$i]=$myObj0;
$i++;
$j++;
    }
}
function date_sort($a, $b) {
    return strtotime($a) - strtotime($b);
}
usort($arr_date, "date_sort");

for ($k=0,$size=count($arr); $k < $size;$k++){
  for ($h=0,$sizeH=count($arr); $h < $sizeH;$h++){
   if ($arr[$h]->start_date == $arr_date[$k])
   {
       $arr_date_sorted[$k]=$arr[$h];
       break;
   }
        }
}
echo json_encode($arr_date_sorted);
?>

