<?php
header('Content-Type: application/json');
$servername = "localhost";
$database = "evento";
$username = "root";
$password = "";
$id = $_GET["id"];
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
$mysql_qry="SELECT * FROM event_type where event_type_name='$id' ";
$r=mysqli_query($conn,$mysql_qry);
$row= mysqli_fetch_assoc($r);
$event_type_id = $row['event_type_id']; 
$mysql_qry2="SELECT * FROM my_event where event_type_id='$event_type_id'";
$r2=mysqli_query($conn,$mysql_qry2);

$i=0;
$j=0;
$l=0;
$arr=array();
$arr_date=array();
$arr_date_sorted=array();
if (!$r2)
{
       echo "NO events for that Category";
   die(mysqli_error($conn)); 
}
else {
  
while ($row2= mysqli_fetch_assoc($r2)) 
        {
$myObj0 = new Anything();
$myObj0->id = $row2['event_id'];
$myObj0->location =$row2['location_id'];
$myObj0->name_event = $row2['event_name'];
$myObj0->start = $row2['start_time'];
$myObj0->start_date = $row2['start_date'];
$myObj0->end_date = $row2['end_date'];
$myObj0->end = $row2['end_time'];

$arr_date[$j] =  $row2['start_date'];

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
header("Location:temp.php?id=$id");
/*echo 
*/


?>

