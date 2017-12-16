
<?php

    require "conn.php";
    require "models.php";

   $event_id = $_GET["event_id"];
   $user_id = $_GET["user_id"];
    $mysql_qry="SELECT * FROM audience WHERE user_id = $user_id ";
    $result=mysqli_query($conn, $mysql_qry);
    $row = mysqli_fetch_assoc($result);
    $audience_id=$row['audience_id'];
    $mysql_qry3="DELETE FROM event_audience WHERE audience_id=$audience_id and event_id = $event_id";
    $result3=mysqli_query($conn, $mysql_qry3);

    $mysql_qry5="SELECT * FROM my_event WHERE event_id = $event_id ";
    $result5=mysqli_query($conn, $mysql_qry5);
    $row5 = mysqli_fetch_assoc($result5);
    $NoOfAttendeeFirst=$row5['NoOfAttendee'];
    $NoOfAttendeeSecond = $NoOfAttendeeFirst-1;;

    $mysql_qry6="UPDATE my_event SET NoOfAttendee = $NoOfAttendeeSecond  WHERE event_id = $event_id";
    $result6=mysqli_query($conn, $mysql_qry6);

?>


