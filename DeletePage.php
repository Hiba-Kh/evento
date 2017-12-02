<?php
$id = $_POST['id'];

$hostname = "localhost";
$username = "root";
$password = "";
$databaseName = "evento";
$connect = mysqli_connect($hostname, $username, $password, $databaseName);

$query = "DELETE FROM sessions WHERE sessions.session_id=$id";
$result = mysqli_query($connect, $query);
if (!$result)
{
    echo "failed";
}
else {
    echo "succ";

}
?>