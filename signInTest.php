<?php

session_start();

echo (isset($_SESSION['user_data']) ? "anything" : "Success");
 // This string will be passed on to JavaScript



?>
