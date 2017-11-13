
<!DOCTYPE html>
<html lang="en">
<head>
<title>Profile</title>

<?php
    require "conn.php";
    require "models.php";

    session_start();
    $user=$_SESSION['user_data'];
    if($user == null) {
        header("location: signinView.php");
    }
?>

    <!-- Javascript -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script>
        // A $( document ).ready() block.
        $(document).ready(function() {
            $.ajax({
                url: "profileController.php?id=" + $("#user_id").val(),
                dataType: 'json', 
                success: function(value){
                  console.log(value);
        
                        console.log('caste: ' + value);
                        var x = '<div class="container">'+
                                    '<h3 class="w3l_head" style="font-size: 2.2em;">'+'My Account'+'</h3>'+
                                    '<div class="w3l-grids-about">'+
                                            '<div class="col-md-5 w3ls-ab-right">'+
                                                '<div class="agile-about-right-img">'+
                                                    '<img src="assets/images/ab.jpg" alt="">'+
                                                    '</div>'+
                                                    '</div>'+
                                                    '<div class="col-md-7 w3ls-agile-left">'+
                                                '<div class="w3ls-agile-left-info">'+
                                                    '<h4 style="font-size:1.3em;">'+'JobTitle'+'</h4>'+
                                                    '<p>'+value.job+'</p>'+
                                                '</div>'+
                                                '<div class="w3ls-agile-left-info">'+
                                                    '<h4 style="font-size:1.3em;">'+'Name'+'</h4>'+
                                                    '<p>'+value.firstname+' '+value.lastname+'</p>'+
                                                '</div>'+
                                                '<div class="w3ls-agile-left-info">'+
                                                    '<h4 style="font-size:1.3em;">'+'Sex'+'</h4>'+
                                                    '<p>'+value.gender+'</p>'+
                                                '</div>'+
                                                '<div class="w3ls-agile-left-info">'+
                                                    '<h4 style="font-size:1.3em;">'+'Address'+'</h4>'+
                                                    '<p>'+ value.address+'</p>'+
                                                    '</div>'+
                                                '<div class="w3ls-agile-left-info">'+
                                                    '<h4 style="font-size:1.3em;">'+'Email Address'+'</h4>'+
                                                    '<p><a href="mailto:example@email.com">'+value.email+'</a></p>'+
                                                '</div>'+
                                        '</div>'+
                                        '<div class="clearfix"> </div>'+
                                    '</div>'+
                                '</div>';
                                    var y = '<img src="assets/images/pic2.jpg" alt=" " class="img-responsive" >'+
                                         '<br>'+
                                        '<h2 style="font-size: 2em;">'+value.firstname+' '+value.lastname+'</h2>'+
					                    '<span>'+value.job+'</span>'+
                                         '<div class="callbacks_container">'+
			                                '<div class="clearfix"></div>'+
		                                    '</div>'+
                                            '<br><br>'+
                                              '<ul class="top-links">'+
	                                                '<li><a href="#"><i class="fa fa-facebook"></i></a></li>'+
    	                                            '<li><a href="#"><i class="fa fa-twitter"></i></a></li>'+
		                                            '<li><a href="#"><i class="fa fa-linkedin"></i></a></li>'+
                                                    '<li><a href="#"><i class="fa fa-google-plus"></i></a></li>'+
                                    
	                                             '</ul>';
                        $("#about").append(x);
                        $("#banner").append(y);

              
                },
                error:function(error, code){
                    console.log(error);
                    console.log(code);
                    alert("Error" + error);
                }   
            });
        });
        
    </script>

<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Classy Resume Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free web designs for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="assets/css/style_profile.css" rel="stylesheet" type="text/css" media="all" />
<!-- gallery -->
<link type="text/css" rel="stylesheet" href="assets/css/cm-overlay.css" />

<!-- //gallery -->
<!-- font-awesome icons -->
<link href="assets/css/font-awesome.css" rel="stylesheet"> 

<!-- //font-awesome icons -->
<link href="//fonts.googleapis.com/css?family=Gidugu" rel="stylesheet">
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/main_profile.css">
</head>
	

    <body>
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user->id ?>">
    <nav id="site-nav" class="navbar navbar-fixed-top navbar-custom">
        <div class="container">
            <div class="navbar-header">

                <!-- logo -->
                <div class="site-branding">
                    <a class="logo" href="index.html">
                        
                        <!-- logo image  -->
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

            </div><!-- /.navbar-header -->

            <div class="collapse navbar-collapse" id="navbar-items">
                <ul class="nav navbar-nav navbar-right">

                    <!-- navigation menu -->
                    <li><a href="speakerProfileView.php">My Profile </a></li> 
                    <li><a href="Create.html">Create Conference </a></li> 
                    <li><a href="upComing.html">UpComing </a></li>
                    <li><a href="administrated.html">Speaker At </a></li>
                     <li><a  href="photos.html">Photos</a></li>
                    <li><a  href="signout.php">Sign Out</a></li>   
                 
                   
                   
                
                </ul>
            </div>
        </div><!-- /.container -->
    </nav>

<div class="main" id="home">
<!-- banner -->
	<div class="banner" id="banner">
			
		
    </div>
    
<!-- //banner -->
	</div>
<!-- header -->
	

<!-- //header -->
<!-- about -->

<div class="about" id="about">
		
        </div>
                    
    
<!-- //about-bottom -->
<!-- services -->
 <section id="upComing" class="section schedule">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="section-title">To be attended Conferences</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="schedule-box">
                        <div class="time">
                            <time datetime="09:00">09:00 am</time> - <time datetime="22:00">10:00 am</time>
                        </div>
                        <h3>Welcome and intro</h3>
                        <p> SD Asia</p>
                          <button type="button" class="btn btn-link"  onclick="window.open('Agenda.html')">MORE</button>                         
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="schedule-box">
                        <div class="time">
                            <time datetime="10:00">10:00 am</time> - <time datetime="22:00">10:00 am</time>
                        </div>
                        <h3>Tips and share</h3>
                        <p>Mustafizur Khan, SD Asia</p>
                          <button type="button" class="btn btn-link"  onclick="window.open('Agenda.php')">MORE</button>                         
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="schedule-box">
                        <div class="time">
                            <time datetime="10:00">10:00 am</time> - <time datetime="22:00">10:00 am</time>
                        </div>
                        <h3>View from the top</h3>
                        <p>Mustafizur Khan, SD Asia</p>
                       
                          <button type="button" class="btn btn-link"  onclick="window.open('Agenda.php')">MORE</button>                         
                    </div>
                </div>
            </div>
    </section>

<!-- //services -->
<!-- /education -->
 <section id="upComing" class="section schedule">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="section-title">Intrested Conferences</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="schedule-box">
                        <div class="time">
                            <time datetime="09:00">09:00 am</time> - <time datetime="22:00">10:00 am</time>
                        </div>
                        <h3>Welcome and intro</h3>
                        <p> SD Asia</p>
                          <button type="button" class="btn btn-link"  onclick="window.open('Agenda.html')">MORE</button>                         
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="schedule-box">
                        <div class="time">
                            <time datetime="10:00">10:00 am</time> - <time datetime="22:00">10:00 am</time>
                        </div>
                        <h3>Tips and share</h3>
                        <p>Mustafizur Khan, SD Asia</p>
                          <button type="button" class="btn btn-link"  onclick="window.open('Agenda.php')">MORE</button>                         
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="schedule-box">
                        <div class="time">
                            <time datetime="10:00">10:00 am</time> - <time datetime="22:00">10:00 am</time>
                        </div>
                        <h3>View from the top</h3>
                        <p>Mustafizur Khan, SD Asia</p>
                       
                          <button type="button" class="btn btn-link"  onclick="window.open('Agenda.php')">MORE</button>                         
                    </div>
                </div>
            </div>
    </section>
	<footer class="site-footer">
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
	
<!-- //mail -->
<!-- footer -->
	
<!-- //footer -->
<script src="assets/js/jquery-2.2.3.min.js"></script> 
<!-- skills -->
<script src="assets/js/pie-chart.js" type="text/javascript"></script>
 <script type="text/javascript">

        $(document).ready(function () {
            $('#demo-pie-1').pieChart({
                barColor: '#44c7f4',
                trackColor: '#fff',
                lineCap: 'round',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });

            $('#demo-pie-2').pieChart({
                barColor: '#44c7f4',
                trackColor: '#fff',
                lineCap: 'butt',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });

            $('#demo-pie-3').pieChart({
                barColor: '#44c7f4',
                trackColor: '#fff',
                lineCap: 'square',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });
			
			$('#demo-pie-4').pieChart({
                barColor: '#44c7f4',
                trackColor: '#fff',
                lineCap: 'square',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });
        });
    </script>
<!-- skills -->	
						<script src="assets/js/responsiveslides.min.js"></script>
							<script>
								// You can also use "$(window).load(function() {"
								$(function () {
								  // Slideshow 4
								  $("#slider3").responsiveSlides({
									auto: true,
									pager:true,
									nav:false,
									speed: 500,
									namespace: "callbacks",
									before: function () {
									  $('.events').append("<li>before event fired.</li>");
									},
									after: function () {
									  $('.events').append("<li>after event fired.</li>");
									}
								  });
							
								});
							 </script>
							 <!-- js -->
				<script src="assets/js/jquery.tools.min.js"></script>
				<script src="assets/js/jquery.mobile.custom.min.js"></script>
				<script src="assets/js/jquery.cm-overlay.js"></script>
				<script>
					$(document).ready(function(){
						$('.cm-overlay').cmOverlay();
					});
				</script>
<!-- js files -->



<script src="assets/js/bars.js"></script>

<!-- start-smoth-scrolling -->
<script type="text/javascript" src="assets/js/move-top.js"></script>
<script type="text/javascript" src="assets/js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->

<!-- //js -->
	<script src="assets/js/bootstrap.js"></script>
<!-- //for bootstrap working -->
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->
</body>
</html>