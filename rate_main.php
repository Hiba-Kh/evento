<html>
<head>
	<title>Rating system</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="js/ratingstar.css">  	
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
<?php
session_start();
$event_id=$_GET['id'];
$_SESSION['event_id']=$event_id;

?>    
</head>


<body background="assets/images/white.jpg">
 <nav id="site-nav" class="navbar navbar-fixed-top navbar-custom">
        <div >
            <div class="navbar-header" style="margin-left: 15px;" >
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

            <div class="collapse navbar-collapse" id="navbar-items"  style="margin-right: 15px;">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index_signed.php">Home</a></li>
                    <li class="active"><a href="adminProfileView.php">My Profile </a></li> 
                    <li><a href="Create.html">Create Conference </a></li> 
                    <li><a href="upComing.html">UpComing </a></li>
                    <li><a href="Administrated_display.php">My Conferences </a></li>
                    <li><a href="signout.php">Sign Out</a></li>   
                </ul>
            </div>
        </div>
    </nav>    
<div class="container" style="background:white;align-items: center;height:220px;margin-top: 180px; ">    
<div class="row">
<div class="col-md-12">
	<div class="form-group">
            <label for="email" style="font-size: 1.5em;font-family:Verdana, Geneva, sans-serif;margin-top: 10px;">Overall,How entertaining was the conference ? </label>	  	
	  <br>	<div class='starrr' id='rating-student'></div> 	<br><br>
	  	<input type="button" id="submit" class="btn btn-success" value="Submit">
	  	<div class="msg"></div>
	</div>	
</div>  
</div>
 </div>

    
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/ratingstar.js"></script>
<script>
// rating
var rate;
$('#rating-student').starrr({
  change: function(e, value){ 
  	rate = value;  	       
    if (value) {
      $('.your-choice-was').show();      
    } else {
      $('.your-choice-was').hide();
    }
  }
});
// ajax submit
$("#submit").click(function(){	
	
	$.ajax({		
        url: "rating.php",
        type: 'post',
        data: {v3 : rate},
        success: function (status) {
        	if(status == 1){
            	$('.msg').html('<b>Thanks for your submission :)</b>');
        	}else{
            	$('.msg').html('<b>Do it again please !</b>');        		
        	}
        }
    });

});
</script>
</body>
</html>