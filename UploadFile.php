
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
            <div class="navbar-header">

                <!-- logo -->
                <div class="site-branding" style="padding-left: 20px;">
                    <a class="logo" href="index.html">
                        
                        <!-- logo image  -->
                        <img src="assets/images/logo.png" alt="Logo">

                        Evento
                    </a>
                </div>

            </div> 
        </div><!-- /.container -->
    </nav>


    <div class="container" style="background:gainsboro;align-items: center;height:300px;margin-top: 180px; ">
                <div  class="row"  style="margin-top:100px;margin-left: 20px;">
                  <h4 style="float:left;font-weight: bold;font-size:1.7em; " class="section-title">Choose File To Upload </h4>
           <div id="content">
	<form  method="post"  enctype="multipart/form-data">
 <div style="font-size: 1.3em;margin-right: 30px;">
   <input type="file" id="file" name="file" multiple>
 </div>
 <div style="font-size: 1.3em;">
     <button type="submit" name="upload" class="btn btn-black" style = "border-color: black;margin-left: 410px;margin-top: 25px;">Upload</button>
 </div>
</form> 
</div>
                </div>
                
    </div>

  </body>

</html>
