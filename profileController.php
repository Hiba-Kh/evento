<?php
header('Content-Type: application/json');
require "conn.php";
require "models.php";
require "sources.php";

$user_id = $_GET["id"];
$returnedUser = GetUser($user_id, $conn);

echo json_encode($returnedUser);

?>
