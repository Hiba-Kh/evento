
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
		$target = "images/".basename($_FILES['image']['name']);
		$image = $_FILES['image']['name'];
		$sql = "INSERT INTO sponsor (image,event_id) VALUES ('$image',$id)";
		mysqli_query($conn, $sql);

		if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
			$msg = "Image uploaded successfully";
		}else{
			$msg = "Failed to upload image";
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
    
<body background="assets/images/download.jpg">
    <nav id="site-nav" class="navbar navbar-fixed-top navbar-custom">
        <div >
            <div class="navbar-header">

                <!-- logo -->
                <div class="site-branding" style="padding-left: 20px;">
                    <a class="logo" href="index.html">
                        <img src="assets/images/logo.png" alt="Logo">
                        Evento
                    </a>
                </div>

            </div> 
        </div><!-- /.container -->
    </nav>

    <div class="container" style="background:gainsboro;align-items: center;height:300px;margin-top: 180px; ">
                <div  class="row"  style="margin-top:74px;margin-left: 20px;">
                  <h4 style="float:left;font-weight: bold;font-size:1.7em; " class="section-title">Add Sponsor </h4>
           <div id="content">
	<form method="POST"  enctype="multipart/form-data">
		<input type="hidden" name="size" value="1000000">
		<div style="margin-right:34px;">
			<input type="file" name="image">
		</div>
		
		<div>
			<button type="submit" name="upload"  style = "border-color: black;margin-left: 380px;margin-top: 25px;" class="btn btn-black" >Upload</button>
		</div>
	</form>
</div>
                </div>
                
    </div>


  </body>

</html>
