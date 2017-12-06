<?php
header('Content-Type: application/json');
$event_id = $_GET["id"];
require "models.php";
require "conn.php";
require "sources.php";
$adminEvent = GetEvent($event_id, $conn);

$sessions = $adminEvent->sessions;
$_SESSION['session_data'] = $sessions;
$_SESSION['Agenda_id'] = $adminEvent->agendas;
$_SESSION['event_id'] = $id;
$_SESSION['description'] = $description;

 header("location: Agenda_Display_Test.php");
?>