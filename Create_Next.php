<?php
require "conn.php";
if(isset($_POST['email'])) 
{
    $user_name = $_POST["email"];
}
echo $user_name;
if(isset($_POST['Password'])) 
{
$user_pass = $_POST["password"];
}

echo $user_pass;

$mysql_qry="SELECT email FROM login WHERE login.email = '$user_name'";
$result=mysqli_query($conn, $mysql_qry);
if(!$result) 
{
    echo "wrong";
	die(mysqli_error($conn));
}

else
{
   if (mysqli_num_rows($result) > 0) 
   { 
       //echo "tahnks";
       // output data of each row
       while($row = mysqli_fetch_assoc($result)) 
       {
           if ($row["password"] == $user_pass)
            {
                header("Location:http://localhost/PhpProject1/conference-master/profile.html");
                
                //$link ="<script>window.open('http://localhost/conference/profile.html')</script>";
                //echo $link;
               // echo"<br>";
              // echo $row["username"];
               //echo"<br>";
               
               //echo $row["password"];
              
           } 
       }
   } 
}

?>