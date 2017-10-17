<?php
require "conn.php";

$flag_firstname =  $flag_lastname = $flag_email = $flag_password  = $flag_gender = $flag_interest = $flag_day = $flag_month =  $flag_year = false;

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

if(empty($_POST['day'])) 
{
    $flag_day = true;
}
else $day = $_POST["day"];

if(empty($_POST['month'])) 
{
    $flag_month = true;
}
else $month = $_POST["month"];

if(empty($_POST['year'])) 
{
    $flag_year = true;
}
else $year = $_POST["year"];
if(isset($_POST['Profession'])) 
{
$professional_student = $_POST["Profession"];
}

if(isset($_POST['address'])) 
{
$address = $_POST["address"];
}




if ( $flag_year || $flag_firstname || $flag_lastname || $flag_email || $flag_password || $flag_interest || $flag_gender || $flag_day || $flag_month || $flag_year)
{
    echo "<script type='text/javascript'>alert('enter all the required field')
    window.location.href='signUp.html';
    
    </script>";
    
}

echo $first_name,$last_name,$email,$password,$phone,$interest,$prof;
$mysql_qry = "INSERT INTO users (user_id,first_name, last_name, email ,pass) VALUES (null,'$first_name', '$last_name', '$email','$password')";
$result=mysqli_query($conn, $mysql_qry);

if(!$result) 
{
	die(mysqli_error($conn));
}

$mysql_qry2 = "INSERT INTO meta_data (gender,interest,BD_day,BD_month,BD_year,professional_student,job,address) VALUES ('$gender', '$interest', '$day','$month','$year','$professional_student','$prof','$address')";
$result2=mysqli_query($conn, $mysql_qry2);
if(!$result2) 
{
	die(mysqli_error($conn));
}


//////////////// $new_row_id = mysql_insert_id();
?>