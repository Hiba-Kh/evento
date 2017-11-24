<?php

$con = mysqli_connect('localhost','root','','evento');

$Q="SELECT * FROM logs ORDER BY id DESC";
$result1 = mysqli_query($con,$Q);

while($extract = mysqli_fetch_array($result1)) {
	echo "<span>" . $extract['username'] . "</span>: <span>" . $extract['msg'] . "</span><br />";
}