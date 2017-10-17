<?php
header('Content-Type: application/json');
require "conn.php";
class UserData {
    var $id;
    var $firstname;
    var $lastname;
    var $gender;
    var $address;
    var $email;
    var $job;
}

session_start();
$signed_user = $_SESSION['login_user'];
$user = new UserData();
$mysql_qry="SELECT * FROM users WHERE  email = '$signed_user'";
$result=mysqli_query($conn, $mysql_qry);
if(!$result) 
{
	die(mysqli_error($conn));
}
else {
     if (mysqli_num_rows($result) == 1)
     {
        while($row = mysqli_fetch_assoc($result)) 
        {
        
            $user->firstname=$row["first_name"];
            $user->lastname=$row["last_name"];
            $user->email=$row["email"];
            $user->id=$row["user_id"];
          
        }
         
        $mysql_qry2="SELECT * FROM meta_data WHERE  user_id = '$user->id'";
        $result2=mysqli_query($conn, $mysql_qry2);
        if(!$result2) 
        {
            die(mysqli_error($conn));
        }
        if (mysqli_num_rows($result2) == 1)
        {
            
            while($row2 = mysqli_fetch_assoc($result2)) 
            {
                
                $user->gender=$row2["gender"];
                $user->address=$row2["address"];
                $user->job=$row2["job"];
            }

        }
    

    } 


     echo json_encode($user);
      
       
}


?>
