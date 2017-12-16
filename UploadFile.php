
<?php
$id = $_GET["id"];
$servername = "localhost";
$database = "evento";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);
$msg = "";
	if (isset($_POST['upload'])) {
            echo $id;
		$target = "uploads/".basename($_FILES['file']['name']);
		$file = $_FILES['file']['name'];
		$sql = "INSERT INTO file (file,event_id) VALUES ('$file',$id)";
		mysqli_query($conn, $sql);

		if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
			$msg = "file uploaded successfully";
		}else{
			$msg = "Failed to upload file";
		}
	}

?>
<html>
    <link rel="stylesheet" href="bower_components/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css">
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="bower_components/smooth-scroll/dist/js/smooth-scroll.min.js"></script>
    <script src="assets/js/main.js"></script>
    
<body background="assets/images/Files3.jpg">
    <nav id="site-nav" class="navbar navbar-fixed-top navbar-custom">
        <div >
            <div class="navbar-header" style="margin-left: 15px;">
                <div class="site-branding">
                    <a class="logo" href="index.html">
                        <img src="assets/images/logo.png"  alt="Logo">
                        Evento
                    </a>
                </div>

                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-items" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>

            <div class="collapse navbar-collapse" id="navbar-items" style="margin-right: 15px;">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index_signed.php">Home</a></li>
                    <li class="active"><a href="speakerProfileView.php">My Profile </a></li> 
                    <li><a href="Create.html">Create Conference </a></li> 
                    <li><a href="upComing.html">UpComing </a></li>
                    <li><a href="SpeakerDisplay.php">Speaker At </a></li>
                    <li><a  href="signout.php">Sign Out</a></li>   
                </ul>
            </div>
        </div>
    </nav>


    <div class="container" style="background:gainsboro;align-items: center;height:300px;margin-top: 180px; ">
                <div  class="row"  style="margin-top:70px;margin-left: 20px;">
                  <h4 style="float:left;font-weight: bold;font-size:1.7em; " class="section-title">Choose File To Upload </h4>
           <div id="content">
	<form  method="post"  enctype="multipart/form-data">
 <div style="font-size: 1.3em;margin-right: 30px;">
   <input type="file" id="file" name="file" multiple>
 </div>
  <div class="row" style="margin-top:35px; ">            
        <button type="submit" name="upload"  style = "border-color: black;float:left;" class="btn btn-black" >Upload</button>
       <?php 
     $new_id=$id; 
     echo " <a href='paper.php?id=$new_id' class='btn btn-black' style = 'display: inline;float:right;margin-right:30px;'>Done</a> ";
     ?>      
                </div>
</form> 
</div>
                </div>
                
    </div>

  </body>

</html>
