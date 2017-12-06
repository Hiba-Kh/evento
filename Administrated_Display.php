 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Conference</title>
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="lib/jquery.bootpag.js"></script>
        <script src="js/jquery-3.2.1.min.js"></script>
<?php
    require "models.php";

    session_start();
    $user=$_SESSION['user_data'];
    if($user == null) {
        header("location: signinView.php");
    }
?>
<style type="text/css">
            
            p{
                text-align: center;
            }
        </style>

    <script>
        $(document).ready(function() {
            $.ajax({
               url: "administrated.php?id=" + $("#user_id").val(),
               dataType: 'json', 
                success: function(result){
                  console.log(result);
          $.each(result, function(index, value) {
                 console.log('caste: ' + value['name']);
                       
                     x = '<div class="col-md-4 col-sm-6">'+
                                '<div class="schedule-box">'+
                                    '<h3>'+ value.name_event +'</h3>'+
                                    '<p>'+ value.location +'</p>'+
                                    '<div class="time">'+
                                        '<date datetime="'+ value.start_date +'">'+ value.start_date +'</date> - <date datetime="'+ value.end_date +'">'+ value.end_date +'</date>'+
                                    '</div>'+
                                    '<br>'+
                                    '<div class="time">'+
                                        '<time datetime="'+ value.start +'">'+ value.start +'</time> - <time datetime="'+ value.end +'">'+ value.end +'</time>'+
                                    '</div>'+
                                    
                    '<button type="button" class="btn btn-link"  onclick="window.open(\'conf_sett.html?id='+value.event_id+'\')">Settings</button>'+                       
                    '<button type="button" class="btn btn-link"  onclick="window.open(\'Agenda_signed.html?id='+value.event_id+'\')">Agenda</button>'+    
                    '<button type="button" class="btn btn-link"  onclick="window.open(\'Agenda_Display_DB.php?id='+value.event_id+'\')">Agenda Settings</button>'+    
                    '<button type="button" class="btn btn-link"  onclick="window.open(\'chat.php?id='+value.event_id+'\')">CHAT</button>'+                       
                                   '</div>'+
                                   '</div>';
                   
                        $("#coming_events").append(x);
                    
                    });
                    
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
 <body background="assets/images/blueNew.jpg">
  <input type="hidden" name="user_id" id="user_id" value="<?php echo $user->id ?>">
    <nav id="site-nav" class="navbar navbar-fixed-top navbar-custom">
        <div class="container">
            <div class="navbar-header">
                <div class="site-branding">
                    <a class="logo" href="index.html">
                        <img src="assets/images/logo.png" alt="Logo" >
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
                    <li><a href="adminProfileView.php">My Profile </a></li> 
                    <li><a href="Create.html">Create Conference </a></li> 
                    <li><a href="upComing.html">UpComing </a></li>
                    <li class="active"><a href="Administrated_display.php">My Conferences </a></li>
                    <li><a href="signout.php">Sign Out</a></li>   
                </ul>
            </div>
        </div><!-- /.container -->
    </nav>


    <section id="upComing" class="section schedule">
        <div class="container" style="width:1400px;">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="section-title" style="color:black; font-weight:bold; font-size: 2em;">My Conferences</h3>
                </div>
            </div>
         
                <div  id="coming_events" class="bs-docs-example row" >
                       
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

    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="bower_components/smooth-scroll/dist/js/smooth-scroll.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>