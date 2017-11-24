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
    <?php
    require "conn.php";
    require "models.php";

    session_start();
    $session_data=$_SESSION['session_data'];
    $Agenda_id=$_SESSION['Agenda_id'];
    $event_id =$_SESSION['event_id'] ;
    $description=$_SESSION['description'] ;
   ?>
    <script src="js/jquery-3.2.1.min.js"></script>
     <script>
      $(document).ready(function() {
            
            $(".delete").click(function(){
             var item = $(this).parent();
             var id =$(this).attr('rel'); 

            $.post('DeletePage.php',{'id' : id},function(data){
              $(item).hide();
            });     
    });
    
    $(".deleteAgenda").click(function(){
             var item_Agenda = $(this).parent();
             var id_Agenda =$(this).attr('rel'); 

            $.post('DeleteAgenda.php',{'id' : id_Agenda},function(data){
              $(item_Agenda).hide();
            });     
    });
    
    
});                
             </script>
   
    
</head>
<body>
    <nav id="site-nav" class="navbar navbar-fixed-top navbar-custom">
        <div class="container">
            <div class="navbar-header">
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

 <section id="faq" class="section-index2 faq">
        <div class="container">
            <div  id ="addAgenda" class="row">
                <div class="col-md-12">
                                       
                </div>
            </div>
            <div class="row">
            <div id="list_agenda" class="col-md-12">
              
           <?php echo  " <a href='Create_Next.html?id=$event_id'> <img  src='assets/images/photos/add1.png' alt='add' width='28' height='28' style='float:left;' /><p class='section-title' style='font-size:1.3em; font-weight:bold;'>Add Agenda</p></a>" ;?>
           <h2 class="section-title"  style='float:left;'>Agenda</h2>
           <br> <br> <br>
        <?php echo    "<h3 class='section-title'>**$description</h3>";?>
     <?php echo  "<a href='#' class='deleteAgenda' rel ='$Agenda_id'><img  src='assets/images/photos/delete.png' alt='Delete' width='30' height='30' style='float:left;' /><p class='section-title'  style='font-size:1.3em;font-weight:bold;'>Delete Agenda</p></a>";?>
           <?php    
            foreach($_SESSION['session_data'] as $key=>$value)
    {
                echo '  <div class="panel panel-default" >';
                 echo '          <div class="panel-heading" role="tab" id="headingTwo">';
                  echo '              <h4 class="panel-title">';
                   echo '                <a class="faq-toggle collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo$value->event_id" aria-expanded="false" aria-controls="collapseTwo$value->event_id">';
                    echo '                   <section id="section-ajenda" class="section-wrapper section-ajenda">';
                     echo '                       <div class="container">';
                       echo '                         <div class="row">';
                         echo '                         <div class="col-md-4">';
                           echo '                              <div class="session">';
                             echo "                            <time>$value->start - $value->end</time>";
                               echo "                             <h2>$value->name</h2>";
                                echo '                        </div>';
                                 echo '                   </div>';
                                    echo '            </div>';
                                    echo '         </div>';
                                  echo '      </section>';
                                echo '    </a>';
                             echo '    </h4>';
                          echo   "<a href='#' class='delete' rel ='$value->session_id'><img  src='assets/images/photos/delete.png' alt='Delete' width='30' height='30' style='float:left;' /><p class='section-title'>Delete Session</p></a>";
                         echo   "<a href='SelectSpeaker.php?id=$value->session_id'><img  src='assets/images/photos/add1.png' alt='add' width='30' height='30' style='float:left;' /><p class='section-title'>Add Speaker/s</p></a>";
                        echo '      </div>';
                      echo '    </div>';
    } 
           ?> 
            <br><br>
            <?php echo  " <a href='create_agenda.html?id=$Agenda_id'> <img  src='assets/images/photos/add1.png' alt='add' width='28' height='28' style='float:left;' /><p class='section-title' style='font-size:1.3em; font-weight:bold;'>Add Session</p></a>" ;?>

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

    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="bower_components/smooth-scroll/dist/js/smooth-scroll.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>