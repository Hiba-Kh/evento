<?php
header('Content-Type: application/json');
$event_id = $_GET["id"];
require "models.php";
require "conn.php";
require "sources.php";
$adminEvent = GetEvent($event_id, $conn);

echo json_encode($adminEvent);
?>