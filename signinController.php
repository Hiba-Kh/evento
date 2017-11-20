<?php
require "conn.php";
require "models.php";

session_start();

$error='';
if (empty($_POST["email"]) || empty($_POST['Password']))
{
    
    $error = "Email or Passwrd is invlid";
}

else 
{     echo "here";
   
    $user_email = $_POST["email"];
    $user_pass = $_POST["Password"];
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
                
                $user = new UserData();
                $type_row = mysqli_fetch_assoc($result);                
                $user->type = $type_row['type'];
                echo $user->type;
                
                $mysql_qry="SELECT * FROM users WHERE  email = '$user_email'";
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
                }

                $_SESSION['user_data'] = $user;
                
                if (strcmp($user->type , "member")==0)
                {
                    
                    header("location: memberProfileView.php");
                    

                }
                if (strcmp($user->type , "admin")==0)
                {
                    
                    header("location: adminProfileView.php");
                    

                }


                if (strcmp($user->type , "speaker")==0)
                {                    
                    header("location: speakerProfileView.php");
                    
                }
            
            }
            else
            {
                    $error = "Email or Password is invalid";
            }
        }
}


?>

