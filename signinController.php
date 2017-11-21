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
                $arr=array();
                $arr2=array();
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

$i=0;               
$mysql_qry_event="SELECT * FROM my_event where my_event.admin_id=$user->id";
$r_event=mysqli_query($conn,$mysql_qry_event);
$row_event= mysqli_fetch_assoc($r_event);

if (!$r_event)
{
   echo "NO events for this admin";
   die(mysqli_error($conn)); 
}
else {
while ($row_event= mysqli_fetch_assoc($r_event)) 
    {
$event = new eventData();
$event->event_id = $row_event['event_id'];
$event->location = $row_event['location_id'];
$event->name_event = $row_event['event_name'];
$event->start_date = $row_event['start_date'];
$event->end_date = $row_event['end_date'];

$id=$row_event['event_id'];
$arr_date[$j] = $row_event['start_date'];
//Display If it has Agenda
$mysql_qry3="SELECT * FROM agenda WHERE agenda.event_id = $id ";
$r3=mysqli_query($conn,$mysql_qry3);
if (!$r3)
{
$event->start = 'un';
$event->end ='un';
}
else{
 $row3= mysqli_fetch_assoc($r3);
$event->start = $row3['start_time'];
$event->end = $row3['end_time'];
}
$arr[$i]=$event;
$i++;
    }
}


$j=0;               
$mysql_qry_Intrested="SELECT * FROM interested where interested.user_id=$user->id";
$r_Intrested=mysqli_query($conn,$mysql_qry_Intrested);

if (!$r_Intrested)
{
   echo "NOTHING TO SHOW";
   die(mysqli_error($conn)); 
}
else {
 $row_Intrested= mysqli_fetch_assoc($r_Intrested);
 $conference_type=$row_Intrested['interested_id'];
 $mysql_qry_Intrested2="SELECT * FROM my_event where my_event.event_type_id=$conference_type";
 $r_Intrested2=mysqli_query($conn,$mysql_qry_Intrested2);
    
while ($row_Intrested2= mysqli_fetch_assoc($r_Intrested2)) 
    {
$event2 = new eventData();
$event2->event_id = $row_Intrested2['event_id'];
$event2->location = $row_Intrested2['location_id'];
$event2->name_event = $row_Intrested2['event_name'];
$event2->start_date = $row_Intrested2['start_date'];
$event2->end_date = $row_Intrested2['end_date'];

$id2=$row_Intrested2['event_id'];
$arr_date2[$j] = $row_Intrested2['start_date'];
//Display If it has Agenda
$mysql_qry3_Intrested="SELECT * FROM agenda WHERE agenda.event_id = $id2 ";
$r3_Intrested=mysqli_query($conn,$mysql_qry3_Intrested);
if (!$r3_Intrested)
{
$event2->start = 'un';
$event2->end ='un';
}
else{
$row3_Intrested= mysqli_fetch_assoc($r3_Intrested);
$event2->start = $row3_Intrested['start_time'];
$event2->end = $row3_Intrested['end_time'];
}
$arr2[$j]=$event2;
$j++;
    }
}

                $_SESSION['event_data'] = $arr;
                $_SESSION['event_Intrested'] = $arr2;
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

