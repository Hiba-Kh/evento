<?php

require "conn.php";

function GetUser($user_id, $conn) {

    $user = new UserData();
    
    $mysql_user_qry="SELECT * FROM users WHERE user_id='$user_id'";
    $result=mysqli_query($conn, $mysql_user_qry);
    
    if(!$result) 
    {
        die(mysqli_error($conn));
    }
    else 
    {
        if (mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_assoc($result);
            $user->firstname=$row["first_name"];
            $user->lastname=$row["last_name"];
            $user->email=$row["email"];
            $user->id=$user_id;
             
            $mysql_meta_qry="SELECT * FROM meta_data WHERE user_id='$user->id'";
            $meta_result=mysqli_query($conn, $mysql_meta_qry);
            
            if(!$meta_result) 
            {
                die(mysqli_error($conn));
            }
            
            if (mysqli_num_rows($meta_result) == 1)
            {
                while($row2 = mysqli_fetch_assoc($meta_result)) 
                {
                    $user->gender=$row2["gender"];
                    $user->address=$row2["address"];
                    $user->job=$row2["job"];
                }
            }
        } 
    
        return $user;
    }
}

?>