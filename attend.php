<!DOCTYPE html>
<html>
<title></title>
<style>
*{margin:0px; padding:0px; font-family:Helvetica, Arial, sans-serif;}

/* Full-width input fields */
input[type=text], input[type=password] {
    width: 90%;
    padding: 12px 20px;
    margin: 8px 26px;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
	font-size:16px;
}

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 26px;
    border: none;
    cursor: pointer;
    width: 90%;
	font-size:20px;
}
button:hover {
    opacity: 0.8;
}

/* Center the image and position the close button */
.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    position: relative;
}
.avatar {
    width: 200px;
	height:200px;
    border-radius: 50%;
}

/* The Modal (background) */
.modal {
	display:none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.4);
}

/* Modal Content Box */
.modal-content {
    background-color: #fefefe;
    margin: 4% auto 15% auto;
    border: 1px solid #888;
    width: 40%; 
	padding-bottom: 30px;
}

/* The Close Button (x) */
.close {
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;
}
.close:hover,.close:focus {
    color: red;
    cursor: pointer;
}

/* Add Zoom Animation */
.animate {
    animation: zoom 0.6s
}
@keyframes zoom {
    from {transform: scale(0)} 
    to {transform: scale(1)}
}
</style>
</style>
<body background="../background1.png">

<h1 style="text-align:center; font-size:50px; color:#fff">Please Login to attend</h1>

<button onclick="document.getElementById('modal-wrapper').style.display='block'" style="width:200px;  margin-top:200px; margin-left:600px;">
Sign In</button>

<div id="modal-wrapper" class="modal">
  
  <form class="modal-content animate" action="signToAttend.php" method="post">
        
    <div class="imgcontainer">
      <span onclick="document.getElementById('modal-wrapper').style.display='none'" class="close" title="Close PopUp">&times;</span>
      <img src="1.png" alt="Avatar" class="avatar">
      <h1 style="text-align:center">Please Sign in to attend</h1>
    </div>

    <div class="container">
      <input type="text" placeholder="Enter Username" name="email">
      <input type="password" placeholder="Enter Password" name="Password">        
      <button type="submit">Login</button>
      <input type="checkbox" style="margin:26px 30px;"> Remember me      
      <a href="#" style="text-decoration:none; float:right; margin-right:34px; margin-top:26px;">Forgot Password ?</a>
    </div>
    
  </form>
  
</div>


<?php
    require "conn.php";
    require "models.php";
    $event_id = $_GET["id"];
   
    

    session_start();
    $user=$_SESSION['user_data'];
    
    if($user == null)
    {
        
        echo "
        <script>
            // If user clicks anywhere outside of the modal, Modal will close
        
        var modal = document.getElementById('modal-wrapper');
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
        </script>";
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



    }

?>


</body>
</html>
