<?php 

session_start();

$_SESSION['user_data'] = null;
session_destroy();
header("location: index.html");

?>