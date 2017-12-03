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

               $returnedUser = GetUser($user_id, $conn);

               $mysql_qry="SELECT * FROM admin WHERE user_id = '$user_id' ";
               $result=mysqli_query($conn, $mysql_qry);
               
               if(!$result) 
               {
                   die(mysqli_error($conn));
               }
               else 
               {
                   while($row = mysqli_fetch_assoc($result)) 
                   {
                       
                       $id = $row['admin_id'];
                       $mysql_qry2="SELECT * FROM event_admin  WHERE admin_id = '$id' ";
                       $result2=mysqli_query($conn, $mysql_qry2);
                       $row = mysqli_fetch_assoc($result2);
               
                       $adminEvent = GetEvent($row['event_id'], $conn);
                       $adminEvent->admin_id = $row['admin_id'];
               
                       array_push($returnedUser->events,$adminEvent);
               
               
                       /// 
               
                   }
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