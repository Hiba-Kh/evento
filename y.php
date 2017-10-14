<?php
header('Content-Type: application/json');

$id = $_GET["id"];

/*class speaker {
    //var $id;
    var $name;
   // var picture;
}*/
class Anything {
    var $id;
    var $name;
    var $start;
    var $end;
    var $speakers;
}

$resp = [];

if ($id == 10) {

    $myObj0 = new Anything();
    $myObj0->id = 10;
    $myObj0->name = "Greeting";
    $myObj0->start = "09:00 am";
    $myObj0->end = "10:00 am";
    $myObj0->speakers = [];
    
    $myObj1 = new Anything();
    $myObj1->id = 20;
    $myObj1->name = "Break";
    $myObj1->start = "03:00 am";
    $myObj1->end = "10:30 am";
    $myObj1->speakers = array("Hiba Khaliefeh" , "Shahira Arafat");
    
    $myObj2 = new Anything();
    $myObj2->id = 30;
    $myObj2->name = "Do Something";
    $myObj2->start = "02:00 am";
    $myObj2->end = "11:30 am";
    $myObj2->speakers = [];
       
    $myObj3 = new Anything();
    $myObj3->id = 40;
    $myObj3->name = "Closing";
    $myObj3->start = "02:00 am";
    $myObj3->end = "11:30 am";
    $myObj3->speakers = array("DaiGooR");

       
    $myObj4 = new Anything();
    $myObj4->id = 50;
    $myObj4->name = "QA";
    $myObj4->start = "02:00 am";
    $myObj4->end = "11:30 am";
    $myObj4->speakers = [];

    $resp = array($myObj0, $myObj1, $myObj2, $myObj3, $myObj4);

}


echo json_encode($resp);

?>