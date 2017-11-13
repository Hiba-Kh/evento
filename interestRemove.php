
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
       $mysql_qry="SELECT * FROM interested WHERE user_id = $user_id ";
       $result=mysqli_query($conn, $mysql_qry);
       $row = mysqli_fetch_assoc($result);
       $interested_id=$row['interested_id'];
       $mysql_qry3="DELETE FROM event_interested WHERE interested_id=$interested_id";
       $result3=mysqli_query($conn, $mysql_qry3);




    }

?>


