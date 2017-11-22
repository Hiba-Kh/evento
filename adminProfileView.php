<!DOCTYPE html>
<html lang="en">
<head>
<title>Profile</title>
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
<?php
    require "conn.php";
    require "models.php";

    session_start();
    $user=$_SESSION['user_data'];
    $event=$_SESSION['event_data'];
    if($user == null) {
        header("location: signinView.php");
    }
?>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: "profileController.php?id=" + $("#user_id").val(),
                dataType: 'json', 
                success: function(value){        
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
</head>
    <body>
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user->id ?>">
    <nav id="site-nav" class="navbar navbar-fixed-top navbar-custom">
        <div class="container">
            <div class="navbar-header">
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

            <div class="collapse navbar-collapse" id="navbar-items">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="adminProfileView.php">My Profile </a></li> 
                    <li><a href="Create.html">Create Conference </a></li> 
                    <li><a href="upComing.html">UpComing </a></li>
                    <li><a href="Administrated_display.php">My Conferences </a></li>
                    <li><a href="signout.php">Sign Out</a></li>   
                </ul>
            </div>
        </div>
    </nav>
    
     <div class="main" id="home">
	<div class="banner" id="banner">
		
    </div>
    
	</div>

<div class="about" id="about">
		
 </div>
   
 <section id="upComing" class="section schedule">
        <div class="container" style="width:1400px;">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="section-title" style="color:black; font-weight:bold; font-size: 2em;">My Conferences</h3>
                </div>
            </div>
                <div  id="coming_events" class="bs-docs-example row" >
     <?php
     $i=0;
     $j=0;
     foreach($_SESSION['event_data'] as $key=>$value)
    {
         $i++;
     if ($i<4){
               echo'<div class="col-md-4 col-sm-6">';
                    echo'<div class="schedule-box">';
                      echo"<h3>'$value->name_event'</h3>";
                 echo" <p>'$value->location'</p>";
                 echo' <div class="time">';
                 echo"<time datetime='$value->start'></time>'$value->start' - <time datetime='$value->end'>'$value->end'</time>";
                 echo'</div>';
                 echo'<button type="button" class="btn btn-link"  onclick="window.open(Agenda.html?id=$value->event_id)"> MORE </button>    ';                     
                     echo' </div>';
                    echo' </div>';   
          
    } 
     }  
if(count($_SESSION['event_data']) > 3)
{
   echo '<input type="button" class="btn btn-black" name="Show More" value="Show More" style="margin-top:20px;height:50px;margin-left:17px;" onClick="showMore()"> ';     
    
}
    ?>             
                    
                    </div>
             <div  id="showmore" style="display:none;" class="bs-docs-example row" >
     <?php
    
     foreach($_SESSION['event_data'] as $key=>$value)
    {
               echo'<div class="col-md-4 col-sm-6">';
                    echo'<div class="schedule-box">';
                      echo"<h3>'$value->name_event'</h3>";
                 echo" <p>'$value->location'</p>";
                 echo' <div class="time">';
                 echo"<time datetime='$value->start'></time>'$value->start' - <time datetime='$value->end'>'$value->end'</time>";
                 echo'</div>';
                 echo'<button type="button" class="btn btn-link"  onclick="window.open(Agenda.html?id=$value->event_id)"> MORE </button>    ';                     
                     echo' </div>';
                    echo' </div>';   
          
    } 
       echo '<input type="button" class="btn btn-black" name="Show less" value="Show less" style="margin-top:50px;margin-right:470px;margin-left:15px;width:150px;height:50px;" onClick="showLess()"> ';     

    ?>             
                    
                    </div>
            
            
            
            
 </section>
    
    
 <section class="section schedule">
        <div class="container" style="width:1400px;">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="section-title" style="color:black; font-weight:bold; font-size: 2em;">Interested Conferences</h3>
                </div>
            </div>
                <div  id="InterestedComing" class="bs-docs-example row" >
                        <?php
     $j=0;
     foreach($_SESSION['event_Intrested'] as $key=>$value)
    {
         $j++;
     if ($j<4){
               echo'<div class="col-md-4 col-sm-6">';
                    echo'<div class="schedule-box">';
                      echo"<h3>'$value->name_event'</h3>";
                 echo" <p>'$value->location'</p>";
                 echo' <div class="time">';
                 echo"<time datetime='$value->start'></time>'$value->start' - <time datetime='$value->end'>'$value->end'</time>";
                 echo'</div>';
                 echo'<button type="button" class="btn btn-link"  onclick="window.open(Agenda.html?id=$value->event_id)"> MORE </button>    ';                     
                     echo' </div>';
                    echo' </div>';   
          
    } 
     }  
if(count($_SESSION['event_data']) > 3){

  
    echo '<input type="button" class="btn btn-black" name="Show More" value="Show More" style="margin-top:20px;height:50px;margin-left:17px;" onClick="showMore2()"> ';     
}
    ?>             
                    
                    </div>
             <div  id="showmore2" style="display:none;" class="bs-docs-example row" >
     <?php
    
     foreach($_SESSION['event_Intrested'] as $key=>$value)
    {
               echo'<div class="col-md-4 col-sm-6">';
                    echo'<div class="schedule-box">';
                      echo"<h3>'$value->name_event'</h3>";
                 echo" <p>'$value->location'</p>";
                 echo' <div class="time">';
                 echo"<time datetime='$value->start'></time>'$value->start' - <time datetime='$value->end'>'$value->end'</time>";
                 echo'</div>';
                 echo'<button type="button" class="btn btn-link"  onclick="window.open(Agenda.html?id=$value->event_id)"> MORE </button>    ';                     
                     echo' </div>';
                    echo' </div>';   
          
    } 
    
       echo '<input type="button" class="btn btn-black" name="Show less" value="Show less" style="margin-top:50px;margin-right:470px;margin-left:15px;width:150px;height:50px;" onClick="showLess2()"> ';     

    ?>             
                    
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
    
    <script src="assets/js/bootstrap.js"></script>
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="bower_components/smooth-scroll/dist/js/smooth-scroll.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/jquery-2.2.3.min.js"></script> 
    <script src="assets/js/pie-chart.js" type="text/javascript"></script>
    <script src="assets/js/responsiveslides.min.js"></script>
    <script src="assets/js/jquery.tools.min.js"></script>
    <script src="assets/js/jquery.mobile.custom.min.js"></script>
    <script src="assets/js/jquery.cm-overlay.js"></script>
    <script src="assets/js/bars.js"></script>
    <script type="text/javascript" src="assets/js/move-top.js"></script>
    <script type="text/javascript" src="assets/js/easing.js"></script>
    
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
<script>
	$(function () {
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
				
<script>
		$(document).ready(function(){
		$('.cm-overlay').cmOverlay();
			});
</script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>


	<script type="text/javascript">
		$(document).ready(function() {			
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
        
        <script type="text/javascript">
		function showMore ()
                {
      
    document.getElementById("showmore").style.display = "";
    document.getElementById("coming_events").style.display = "none";
             }
             
             function showLess ()
                {
      
    document.getElementById("coming_events").style.display = "";
    document.getElementById("showmore").style.display = "none";
             }
             
             function showMore2 ()
                {
      
    document.getElementById("showmore2").style.display = "";
    document.getElementById("InterestedComing").style.display = "none";
             }
             
             function showLess2 ()
                {
      
    document.getElementById("InterestedComing").style.display = "";
    document.getElementById("showmore2").style.display = "none";
             }
	</script>
</body>
</html>