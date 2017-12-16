<?php
require "conn.php";
require "models.php";

$flag_firstname =  $flag_lastname = $flag_email = $flag_password  = $flag_gender = $flag_interest = $flag_birthDate = false;

if(empty($_POST['first_name'])) 
{
    $flag_firstname = true;
}
else     $first_name = $_POST["first_name"];


if(empty($_POST['last_name'])) 
{
    $flag_lastname = true;
}
else $last_name = $_POST["last_name"];


if(empty($_POST['email'])) 
{
    $flag_email=true;
}
else $email = $_POST["email"];


if(empty($_POST['password'])) 
{
    $flag_password = true;
}
else $password = $_POST["password"];


if(isset($_POST['phone'])) 
{
$phone = $_POST["phone"];
}

if(empty($_POST['Your_Intreset'])) 
{
    $flag_interest = true;
}
else $interest = $_POST["Your_Intreset"];


if(isset($_POST['Your_Profession'])) 
{
$prof = $_POST["Your_Profession"];
}

if(empty($_POST['gender'])) 
{
    $flag_gender = true;
}
else $gender = $_POST["gender"];

if(empty($_POST['birthDate'])) 
{
    $flag_birthDate = true;
}
else $birthDate = $_POST["birthDate"];


if(isset($_POST['Profession'])) 
{
$professional_student = $_POST["Profession"];
}

if(isset($_POST['address'])) 
{
$address = $_POST["address"];
}

if(isset($_POST['facebook'])) 
{
$facebook = $_POST["facebook"];
}
if(isset($_POST['gmail'])) 
{
$gmail = $_POST["gmail"];
}
if(isset($_POST['twitter'])) 
{
$twitter = $_POST["twitter"];
}
if(isset($_POST['linkedin'])) 
{
$linkedin = $_POST["linkedin"];
}


if (  $flag_firstname || $flag_lastname || $flag_email || $flag_password || $flag_interest || $flag_gender || $flag_birthDate)
{
    echo "<script type='text/javascript'>alert('enter all the required field')
    window.location.href='signUp.html';
    
    </script>";
    
}

$user_id;
$mysql_qry = "INSERT INTO users (user_id,first_name, last_name, email ,pass) VALUES (null,'$first_name', '$last_name', '$email','$password')";
$result=mysqli_query($conn, $mysql_qry);

if(!$result) 
{
	die(mysqli_error($conn));
}
$mysql_qry4 = "SELECT * FROM users ";
$result4=mysqli_query($conn, $mysql_qry4);
while($row4 = mysqli_fetch_assoc($result4)) 
{
  $user_id=$row4['user_id'];
}


$mysql_qry2 = "INSERT INTO meta_data (user_id,gender,interest,BirthDate,professional_student,job,address,phone_number,facebook,google,twitter,linkedin) VALUES ('$user_id','$gender', '$interest', '$birthDate','$professional_student','$prof','$address','$phone','$facebook','$gmail','$twitter','$linkedin')";
$result2=mysqli_query($conn, $mysql_qry2);
if(!$result2) 
{
	die(mysqli_error($conn));
}
$type="member";
$mysql_qry3 = "INSERT INTO login (email,password,type) VALUES ('$email', '$password','member')";
$result3=mysqli_query($conn, $mysql_qry3);
if(!$result3) 
{
	die(mysqli_error($conn));
}




session_start();
$user = new UserData();
$mysql_qry_user="SELECT * FROM users WHERE  email = '$email'";
$result_user=mysqli_query($conn, $mysql_qry_user);
                if(!$result_user) 
                {
                    die(mysqli_error($conn));
                }
                else {
                     if (mysqli_num_rows($result_user) == 1)
                     {
                        while($row = mysqli_fetch_assoc($result_user)) 
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
if (strcmp($user->gender , "female")==0)
{
 $image = "images/empty_female.jpg";
 
$sql = "INSERT INTO profilePic (image,user_id) VALUES ('$image',$user->id)";
  	mysqli_query($conn, $sql);

  	
}
else if (strcmp($user->gender , "male")==0)
{
   $image = "images/empty_boy.jpg";
  
    $sql = "INSERT INTO profilePic (image,user_id) VALUES ('$image',$user->id)";
  	mysqli_query($conn, $sql);

  	
    
}
header("location:memberProfileView.php");


//////////////// $new_row_id = mysql_insert_id();
?>