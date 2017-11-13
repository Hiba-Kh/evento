
<?php
require "conn.php";
require "models.php";
$user_email=$_GET["email"];
$user_pass=$_GET["pass"];
$event_id=$_GET["id"];
echo $user_email;
session_start();

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
            $mysql_qry="SELECT * FROM users WHERE  email = '$user_email'";
            $result=mysqli_query($conn, $mysql_qry);
            if(!$result) 
            {
                die(mysqli_error($conn));
            }
            else
                {
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
            $user=$_SESSION['user_data'];
            $user_id= $user->id;
            $mysql_qry="SELECT * FROM interested WHERE user_id = $user_id ";
            $result=mysqli_query($conn, $mysql_qry);
            $row = mysqli_fetch_assoc($result);
            $interested_id=$row['interested_id'];
                    if($interested_id==null)
                {
                    $mysql_qry2 = "INSERT INTO interested (user_id,interested_id) VALUES ('$user_id',null)";
                    $result2=mysqli_query($conn, $mysql_qry2);

                }
                $mysql_qry3="SELECT * FROM interested WHERE user_id = $user_id ";
                $result3=mysqli_query($conn, $mysql_qry3);
                $row3 = mysqli_fetch_assoc($result3);
                $interested_id2=$row3['interested_id'];

                $mysql_qry4="INSERT INTO event_interested(event_id, interested_id) VALUES ($event_id,$interested_id2) ";
                $result4=mysqli_query($conn, $mysql_qry4);
        
        }
    }









/*
$event_id = $_GET["id"];

session_start();
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
$error='';
if (empty($_POST["email"]) || empty($_POST['Password']))
{
    
    $error = "Email or Passwrd is invlid";
}
 
else 
{ 
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

                            
                header("location: agenda_signed.html?id=$event_id");
            
            }
            else
            {
                    $error = "Email or Password is invalid";
            }
        }
}

*/
?>

<!-- <!DOCTYPE html>
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

  <form class="modal-content animate" action="" method="post">
        
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
<script>

    
    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : sParameterName[1];
            }
        }
    };
</script> 
</body>
</html>

-->