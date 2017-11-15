
<?php
header('Content-Type: application/json');

    require "conn.php";
    require "models.php";
     $event_id = $_GET["id"];
    
     $notSigned=false;     
     $arr =array();
    session_start();
    $user=$_SESSION['user_data'];
    if($user == null)
    {

        
        $notSigned=true;
       // $arr[0]=$notSigned;
       $resp=$notSigned;
        echo json_encode($resp);
       // header("location: signToAttend.php?id=$event_id");
       
    }
     
 else 
   {
        
       $user=$_SESSION['user_data'];
       $user_id= $user->id;
       $mysql_qry="SELECT * FROM audience WHERE user_id = $user_id ";
       $result=mysqli_query($conn, $mysql_qry);
       $row = mysqli_fetch_assoc($result);
       $audience_id=$row['audience_id'];
            if($audience_id==null)
        {
            $mysql_qry2 = "INSERT INTO audience (user_id,audience_id) VALUES ('$user_id',null)";
            $result2=mysqli_query($conn, $mysql_qry2);

        }
        $mysql_qry3="SELECT * FROM audience WHERE user_id = $user_id ";
        $result3=mysqli_query($conn, $mysql_qry3);
        $row3 = mysqli_fetch_assoc($result3);
        $audience_id2=$row3['audience_id'];

        

        $mysql_qry4="INSERT INTO event_audience(event_id, audience_id) VALUES ($event_id,$audience_id2) ";
        $result4=mysqli_query($conn, $mysql_qry4);

        $mysql_qry5="SELECT * FROM my_event WHERE event_id = $event_id ";
        $result5=mysqli_query($conn, $mysql_qry5);
        $row5 = mysqli_fetch_assoc($result5);
        $NoOfAttendeeFirst=$row5['NoOfAttendee'];
        $NoOfAttendeeSecond = $NoOfAttendeeFirst+1;;
    
        $mysql_qry6="UPDATE my_event SET NoOfAttendee = $NoOfAttendeeSecond  WHERE event_id = $event_id";
        $result6=mysqli_query($conn, $mysql_qry6);




    }

?>


