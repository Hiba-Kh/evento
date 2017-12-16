<?php
header('Content-Type: application/json');
require "conn.php";
require "Firebase.php";
require "models.php";
require "sources.php";

$registeredUser = GetUser(111111, $conn);
//Get it from database -_-
$ids = array($registeredUser->token);

$msg = new push();
$msg->title = "Edit"; // send update on interested or attended (-_-)
$msg->message = "You attended new event!";

$firebase = new Firebase();
$firebase->send($ids, $msg);

echo json_encode($registeredUser->token);

?>