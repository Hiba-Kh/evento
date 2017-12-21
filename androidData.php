<?php
header('Content-Type: application/json');
require "conn.php";
require "models.php";
require "sources.php";

if(!isset($_POST["email"]) && !isset($_POST["password"])) {
    echo json_encode("{\"error\": \"no param\"}");
    return;
}

$user_email = $_POST["email"];
$user_pass = $_POST["password"];

$token=  $_POST["token"];

$mysql_qry="SELECT * FROM login WHERE password = '$user_pass' AND email = '$user_email'";
$result=mysqli_query($conn, $mysql_qry);

if(!$result) 
{
    die(mysqli_error($conn));
}
else
{
    $rows = mysqli_num_rows($result);
    if ($rows == 1)
    {
        $type_row = mysqli_fetch_assoc($result);                
        $type = $type_row['type'];
        $mysql_qry="SELECT * FROM users WHERE  email = '$user_email'";
        $result=mysqli_query($conn, $mysql_qry);
        if(!$result) 
        {
            die(mysqli_error($conn));
        }
        else 
        {
            if (mysqli_num_rows($result) == 1)
            {  
               $row = mysqli_fetch_assoc($result);
               $user_id = $row["user_id"];

               $mysql_qry6="UPDATE users SET token = '$token'  WHERE user_id = '$user_id'";
               $result6=mysqli_query($conn, $mysql_qry6);

               $returnedUser = GetUser($user_id, $conn);

               $mysql_qry="SELECT * FROM admin WHERE user_id = '$user_id' ";
               $result=mysqli_query($conn, $mysql_qry);
               $row = mysqli_fetch_assoc($result);
               $admin_id = $row['admin_id'];
               $mysql_qry2="SELECT * FROM admin INNER JOIN event_admin ON 
               admin.admin_id = event_admin.admin_id";
               $result2=mysqli_query($conn, $mysql_qry2);
               while ($row2 = mysqli_fetch_assoc($result2))
               {
                   if($row2["admin_id"]==$admin_id)
                   {
                       $adminEvents = GetEvent($row2['event_id'], $conn);
                       array_push($returnedUser->myEvents,$adminEvents);
                   }
               }
                $mysql_qry_attended="SELECT * FROM audience WHERE user_id = '$user_id' ";
                $result_attended=mysqli_query($conn, $mysql_qry_attended);
                $row_attended = mysqli_fetch_assoc($result_attended);
                $audience_id=$row_attended["audience_id"];
                $mysql_qry_event_attended="SELECT * FROM audience INNER JOIN event_audience ON 
                audience.audience_id = event_audience.audience_id";
                $result_event_attended=mysqli_query($conn, $mysql_qry_event_attended);
                while ($row_event_attended = mysqli_fetch_assoc($result_event_attended))
                {
                    if($row_event_attended["audience_id"]==$audience_id)
                    {
                        $attendedEvents = GetEvent($row_event_attended['event_id'], $conn);
                        array_push($returnedUser->attendedEvents,$attendedEvents);
                    }
                }   

                $mysql_qry_interested="SELECT * FROM interested WHERE user_id = '$user_id' ";
                $result_interested=mysqli_query($conn, $mysql_qry_interested);
                $row_interested = mysqli_fetch_assoc($result_interested);
                $interested_id=$row_interested["interested_id"];
                $mysql_qry_event_interested="SELECT * FROM interested INNER JOIN event_interested ON 
                interested.interested_id = event_interested.interested_id";
                $result_event_interested=mysqli_query($conn, $mysql_qry_event_interested);
                while ($row_event_interested = mysqli_fetch_assoc($result_event_interested))
                {
                    if($row_event_interested["interested_id"]==$interested_id)
                    {
                        $interestedEvents = GetEvent($row_event_interested['event_id'], $conn);
                        array_push($returnedUser->intrestedEvents,$interestedEvents);
                        
                    }
                }

                $current_date = date('Y-m-d');
                $mysql_qry3="SELECT * FROM my_event  WHERE start_date > '$current_date' ";
                $result3=mysqli_query($conn, $mysql_qry3);
                $row3 = mysqli_fetch_assoc($result3);
                while($row3 = mysqli_fetch_assoc($result3))
                {
                    $UpComingEvent = GetEvent($row3['event_id'], $conn);
                    array_push($returnedUser->upcomingEvents,$UpComingEvent);
                }

               echo json_encode($returnedUser);
               
            }
        }
    }
    else
    {
        echo json_encode("{\"error\": \"no user\"}");
    }

}


?>