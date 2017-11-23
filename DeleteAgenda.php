<?php
$id = $_POST['id'];

$hostname = "localhost";
$username = "root";
$password = "";
$databaseName = "evento";
$connect = mysqli_connect($hostname, $username, $password, $databaseName);

$query = "DELETE FROM sessions WHERE sessions.agenda_id=$id";
$result = mysqli_query($connect, $query);
if (!$result)
{
    echo "NO Agneda";
}
else {
    
$query2 = "DELETE FROM agenda WHERE agenda.agenda_id=$id";
$result2 = mysqli_query($connect, $query2);
if (!$result2)
{
    echo "failed2";
}
else {
    echo "succ2";

}

}


?>