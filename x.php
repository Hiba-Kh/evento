<?php

header('Content-Type: application/json');
require "conn.php";
class Anything {
    var $id;
    var $name;
    var $start;
    var $end;
}

// Get data from database and do your logic 

$myObj0 = new Anything();
$myObj0->id = 10;
$myObj0->name = "John";
$myObj0->start = "09:00 am";
$myObj0->end = "10:00 am";

$myObj1 = new Anything();
$myObj1->id = 20;
$myObj1->name = "Hiba";
$myObj1->start = "03:00 am";
$myObj1->end = "10:30 am";

$myObj2 = new Anything();
$myObj2->id = 30;
$myObj2->name = "Asmar";
$myObj2->start = "02:00 am";
$myObj2->end = "11:30 am";

$resp = array($myObj0, $myObj1, $myObj2);

echo json_encode($resp);

?>