<?php
$id = $_GET["id"];
$servername = "localhost";
$database = "evento";
$username = "root";
$password = "";
$conn = mysqli_connect($servername, $username, $password, $database);
$result = mysqli_query($conn, "SELECT * FROM file WHERE file.event_id=$id");
        $i =0;

 echo'  <section id="faq" class="section-index2 faq">';
     echo'   <div class="container">';
          echo'  <div class="row">';
          echo'      <div class="col-md-12">';
            echo'        <br>';
            echo'        <h2 class="section-title">Accepted Papers</h2>';
            echo'        <br>';
             echo'       <h3 class="panel-title" style="color:blue;"> Main Conference </h3>';
       
while ($row = mysqli_fetch_array($result)) {
echo"<object data= type='application/pdf' width='300' height='200'>";
echo"<a href='uploads/".$row['file']."'>File$i.pdf</a>";
echo'</object>';
            echo'<br>';
$i++;
	}
        echo'          </div>';
         echo'       </div>';
         echo'   </div>';
   echo' </section>';
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Conference</title>

    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body data-spy="scroll" data-target="#site-nav">
    <nav id="site-nav" class="navbar navbar-fixed-top navbar-custom">
        <div class="container">
            <div class="navbar-header">

                <!-- logo -->
                <div class="site-branding">
                    <a class="logo" href="index.html">
                        <img src="assets/images/logo.png" alt="Logo">
                        Evento
                    </a>
                </div>

                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-items" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div><!-- /.navbar-header -->

            <div class="collapse navbar-collapse" id="navbar-items">
                <ul class="nav navbar-nav navbar-right">

                    <!-- navigation menu -->
                    <li><a href="Create.html">CreateConf. </a></li> 
                    <li><a href="profile.html">Profile</a></li>
                    <li><a href="upComing.html">UpComing </a></li>
                    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Program
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="Proceeding.php">Proceedings</a></li>
          <li><a href="Panel.html">Panel</a></li>
          <li><a href="Awards.html">Awards</a></li>
          <li><a href="paper.php">Paper</a></li>
          <li><a href="Agenda_signed.php">Agenda</a></li>
          <li><a href="Sponsor_Display.html">Sponsors</a></li>
        </ul>
                        
      </li>
      
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Venue
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          
          <li><a href="Photos_event.html">Photos</a></li>
          <li><a href="Videos_event.html">Videos</a></li>
         
        </ul>
                        
      </li>
     
                
                    <li><a href="index.html">SignOut </a></li>
                
      
    
                
                </ul>
            </div>
        </div><!-- /.container -->
    </nav>

    <header id="site-header-index2" class="site-header-index2 valign-center"> 
       
    </header>

    
   

    
  
    <footer class="site-footer" style ="margin-top: 230px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="social-block">
                        <li><a href=""><i class="ion-social-twitter"></i></a></li>
                        <li><a href=""><i class="ion-social-facebook"></i></a></li>
                        <li><a href=""><i class="ion-social-linkedin-outline"></i></a></li>
                        <li><a href=""><i class="ion-social-googleplus"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- script -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="bower_components/smooth-scroll/dist/js/smooth-scroll.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>