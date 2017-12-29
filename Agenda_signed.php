<!DOCTYPE html>
<html lang="en">
<head>
    
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <?php
require 'conn.php';
$id=$_GET['id'];
$mysql="SELECT event_name FROM my_event WHERE my_event.event_id=$id";
$re=mysqli_query($conn, $mysql);
$row_s= mysqli_fetch_assoc($re); 
$event_name =$row_s['event_name'];

$event_name_without_number = strtok($event_name, '20');
$name_without_number=array();
$names_found=array();
$event_id_arr=array();
        
$s=0;
$i=0;
$j=0;
$count=0;
$list = "";

$mysql_user_qry="SELECT event_name FROM my_event";
$result=mysqli_query($conn, $mysql_user_qry);
while($row_sql= mysqli_fetch_assoc($result)) 
   {
$event_name_without_numbers[$s] = $row_sql['event_name'];
if (strpos($event_name_without_numbers[$s], $event_name_without_number) !== false) {
    $count++;
    $names_found[$i]=$event_name_without_numbers[$s];
$mysql2="SELECT event_id FROM my_event WHERE my_event.event_name='$names_found[$i]'";
$re2=mysqli_query($conn, $mysql2);
$row_s2= mysqli_fetch_assoc($re2); 
$event_id_arr[$j] =$row_s2['event_id'];
$list = $list."<li><a href='Agenda_signed.php?id=$event_id_arr[$j]'>$names_found[$i]</a></li>";

    $j++;
    $i++;
}
$s++;
   }
   if ($count === 1){
     $list="";
   }

   ?>
    <style>
                #map {
                  height: 400px;
                  width: 100%;
                 }
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
    <script src="js/jquery-3.2.1.min.js"></script>
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
    $(document).ready(function()
    {
        var speakersInConf = [];

        $.ajax
        ({
            url: "agendaController.php?id="+getUrlParameter("id"),
            dataType: 'json', 
            success: function(result)
            {
                console.log(result);
                $.each(result.agendas, function() {
                     $.each(this.sessions,function(index, value){
                        console.log('sessions: ' + value.session_id);
                        var node = '<div class="panel panel-default">'+
                        '    <div class="panel-heading" role="tab" id="headingTwo">'+
                        '        <h4 class="panel-title">'+
                        '            <a class="faq-toggle collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo'+value.session_id+'" aria-expanded="false" aria-controls="collapseTwo'+value.id+'">'+
                        '                <section id="section-ajenda" class="section-wrapper section-ajenda">'+
                        '                    <div class="container">'+
                        '                        <div class="row">'+
                        '                            <div class="col-md-4">'+
                        '                                <div class="session">'+
                        '                                    <time>'+value.start_time+' - '+value.end_time+'</time>'+
                        '                                    <h2>'+value.session_title+'</h2>'+
                        '                                </div>'+
                        '                            </div>'+
                        '                        </div>'+
                        '                    </div>'+
                        '                </section>'+
                        '            </a>'+
                        '        </h4>'+
                        '    </div>';

                        if (this.speakers) {
                            $.each(this.speakers,function(index, speaker){
                                console.log('speakers: ' + speaker.id);
                                speakersInConf.push(speaker);
                                node += '<div id="collapseTwo'+value.session_id+'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">'+
                                        '    <div class="panel-body">'+
                                        '        <h3>Speakers</h3>';
                                node += '        <p>' + speaker.firstname + ' ' + speaker.lastname +'</p>';
                                node += '    </div>'+
                                        '</div>';
                            });
                        }
                       
                       
                        node += '</div>';
                
                        $("#list_agenda").append(node);
                    });
                });

                var actionTool= '<div style="float:right;">';    
                if(result.isFree == '0') {
                    actionTool += ' <a class="btn btn-white inline"  onclick="payFees()" style="width:220px;">Reserve your seat</a>';
                } else {
                    actionTool += '<a class="btn btn-white inline"   id="attendButton" onclick="attendButton()" style="width:220px;" >Attend</a>';
                }                   
                    
                actionTool += ' <a class="btn btn-white inline"  id="interestButton" onclick="interestButton()" style="width:220px;" >Interest</a>';
                
                    
                
                actionTool += '</div>'+
                '<br>'+
                '<h2 class="section-title">Agenda</h2>'+
                '<h3 style="font-size:1.4em;color:black;">**'+result.description+'</h3>';
                
                $("#attend").append(actionTool);
                    
                drawSpeakerPanel(speakersInConf);
                


                initMap({lat: 32.2249, lng: 35.2359});

                drawFactsPanel(result.description, result.location_id, speakersInConf.length, 10, result.start_date);                  
                        
                },
                error:function(error, code){
                    console.log(error);
                    console.log(code);
                    alert("Error" + error);
                },
                  
        });
    });

    function payFees()
    {
        document.getElementById('modal-wrapper-fees').style.display='block';
                  var modal = document.getElementById('modal-wrapper');
                    window.onclick = function(event)
                     {
                        if (event.target == modal)
                        {
                            modal.style.display = "none";
                        }
                    } 
 

    }
    function drawFactsPanel (description, location_name, no_speaker, no_tickets, start_date) {
        var conc ='<div class="row">'+
                            '<div class="col-sm-3">'+
                                '<i class="ion-ios-calendar"></i>'+
                                '<h3>'+start_date+'</h3>'+
                            ' </div>'+
                            
                        ' <div class="col-sm-3">'+
                            ' <i class="ion-ios-location"></i>'+
                                '<h3>Hamdi Manko</h3>'+
                        ' </div>'+
                        
                        '  <div class="col-sm-3">'+
                        '     <i class="ion-pricetags"></i>'+
                            '    <h3>350</h3>'+
                            '</div>'+
                            
                        ' <div class="col-sm-3">'+
                            '    <i class="ion-speakerphone"></i>'+
                            '   <h3>'+no_speaker+'</h3>'+
                        ' </div> '+
                            '</div>'; 
                        
                        $("#conclusion").append(conc);
    }
    
    function drawSpeakerPanel(speakersInConf) {
        var row = '<div class="row">';
        for(var index = 0; index < speakersInConf.length; index++) {
             row += '<div class="col-md-4">'+
                        '<div class="speaker">'+

                            '<figure>'+
                            '    <img alt="" class="img-responsive center-block" src="assets/images/speakers/speaker-1.jpg">'+
                            '</figure>'+
                            '<h4>'+ speakersInConf[index].firstname +' '+ speakersInConf[index].lastname + '</h4>'+
                            '<p>Nablus</p>'+
                            '<ul class="social-block">'+
                            '     <li><a href=""><i class="ion-social-twitter"></i></a></li>'+
                            '    <li><a href=""><i class="ion-social-facebook"></i></a></li>'+
                            '    <li><a href=""><i class="ion-social-linkedin-outline"></i></a></li>'+
                            '    <li><a href=""><i class="ion-social-googleplus"></i></a></li>'+
                            '</ul>'+

                        '</div><!-- /.speaker -->'+
                    '</div><!-- /.col-md-4 -->';

           
        }
        row += '</div>';
        $('#speakersContainer').append(row);
    }

    function attendButton(){
        var resp;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function()
        {  
             if (this.readyState == 4 && this.status == 200) 
            {
               resp = this.responseText;
               if (resp=="Success")
               {
                  document.getElementById('modal-wrapper').style.display='block';
                  var modal = document.getElementById('modal-wrapper');
                    window.onclick = function(event)
                     {
                        if (event.target == modal)
                        {
                            modal.style.display = "none";
                        }
                    } 
 
               } else {
                   attendToEvent();
               }
           }
        };
        xhttp.open("GET", href="signInTest.php", true);
        xhttp.send(); 
    }
    function interestButton()
    {
        var resp;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function()
        {  
            if (this.readyState == 4 && this.status == 200) 
            {
                resp = this.responseText;
                if (resp=="Success")
                {
                    document.getElementById('modal-wrapper2').style.display='block';
                    var modal = document.getElementById('modal-wrapper2');
                    window.onclick = function(event)
                     {
                        if (event.target == modal)
                        {
                            modal.style.display = "none";
                        }
                    } 
 
               } else {
                    interestInEvent();
               }
           }
        };
        xhttp.open("GET", href="signInTest.php", true);
        xhttp.send(); 
    }
    function attendToEvent() {
        
        var text = document.getElementById("attendButton").innerText;
        if (text=='ATTEND')
        {
            $(document).ready(function() { 
                $.ajax ({
                    url :  "attend.php?id="+getUrlParameter("id"),
                    dataType: 'json', 
                    success: function(value){
                        console.log(value);
                        console.log('caste: ' + value);
                        console.log ('success');
                    },
                    error : function () {
                        console.log ('error');
                    }
                });
                document.getElementById("attendButton").innerHTML="attended";
            });
        } else if(text=="ATTENDED") {
            document.getElementById( "attendButton").innerHTML="attend";
            $(document).ready(function() { 
                $.ajax ({
                    url :  "attendRemove.php?id="+getUrlParameter("id"),
                    dataType: 'json', 
                    success: function(value){
                        console.log(value);
                        console.log('caste: ' + value);
                        console.log ('success');
                    },
                    error : function () {
                        console.log ('error');
                    }
                });
            });
        }
    }
    function interestInEvent() {
        var text = document.getElementById("interestButton").innerText;
        if (text=='INTEREST')
        {
            $(document).ready(function() { 
                $.ajax ({
                    url :  "interest.php?id="+getUrlParameter("id"),
                    dataType: 'json', 
                    success: function(value){
                        document.getElementById("interestButton").innerHTML="interested";
                        console.log(value);
                        console.log('caste: ' + value);
                        console.log ('success');
                    },
                    error : function () {
                        console.log ('error');
                    }
                });
            });
            
        } else if(text=="INTERESTED") {
           $(document).ready(function() { 
                $.ajax({
                    url :  "interestRemove.php?id="+getUrlParameter("id"),
                    dataType: 'json', 
                    success: function(value){
                        document.getElementById( "interestButton").innerHTML="interest";
                        console.log(value);
                        console.log('caste: ' + value);
                        console.log ('success');
                    },
                    error : function () {
                        console.log ('error');
                    }
                });
            });
        }
    }
    </script>
    
</head>
<body background="assets/images/White.jpg">
    <nav id="site-nav" class="navbar navbar-fixed-top navbar-custom">
        <div>
            <div class="navbar-header" style="margin-left:15px;">
                <div class="site-branding">
                    <a class="logo" href="index.html">
                        <img src="assets/images/logo.png" alt="Logo">
                        Conferencer
                    </a>
                </div>

                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-items" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div><!-- /.navbar-header -->

            <div class="collapse navbar-collapse" id="navbar-items" style="margin-right:15px;">
                <ul class="nav navbar-nav navbar-right">

                    <!-- navigation menu -->
                    <li><a href="upComing.html">UpComing </a></li>
                    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Program
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
           <?php $event_id=$id; echo "<li><a href='Proceeding.php?id=$event_id'>Proceedings</a></li>"; ?>
<li><a href="Panel.html">Panel</a></li>
          <li><a href="Awards.html">Awards</a></li>
          <li><a href="Paper.html">Paper</a></li>
          <li><a data-scroll href="#speakers">Speaker</a></li>
          <li><a  data-scroll href="#faq">Agenda</a></li>
         <?php $event_id=$id; echo "<li><a href='Sponsor_Display.php?id=$event_id'>Sponsors</a></li>"; ?>
        </ul>
                        
      </li>
      
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Venue
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="Accommodation.html">Accommodation</a></li>
          
        </ul>
      </li>
      
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Conf_Series
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
        <?php echo $list;?>
        </ul>      
      </li>
      
                </ul>
            </div>
        </div><!-- /.container -->
    </nav>
   
    <section id="faq" class="section-index2 faq">
        <div class="container">
            <div class="row">
                <div id="attend" class="col-md-12">
                </div>
            </div>
           
            <div class="row">
                <div id="list_agenda" class="col-md-12">
                </div>
            </div>
        </div>
    </section>
    
        <section id="speakers" class="section-speaker speakers">
            <div id="speakersContainer" class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="section-title">Speakers</h2>
                    </div>
                </div>
            </div>
        </section>
    
        <section id="facts" class="section bg-image-1 facts text-center">
                <div id="conclusion" class="container" >
                </div><!-- container -->
        </section> 
      
        <section id="location" class="section location">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <h2 class="section-title">Event Location</h2>

                        <address>
                            <p>Nablus<br> Hamdi Manko<br> Phone: +597136396 <br> Email: shoshoarafat-1996@hotmail.com</p>
                        </address>
                    </div>
                    <div class="col-sm-9">
               

                        <div id="map"></div>
                        <script>
                          function initMap(uluru)
                            {
                                if (!uluru) {
                                    uluru = {lat: 31.898043, lng: 35.204269};
                                }

                                var map = new google.maps.Map(document.getElementById('map'), {
                                zoom: 4,
                                center: uluru
                                });
                                var marker = new google.maps.Marker({
                                position: uluru,
                                map: map
                                });
                                 infoWindow = new google.maps.InfoWindow;
                                if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(function(position) {
                                    var pos = {
                                    lat: position.coords.latitude,
                                    lng: position.coords.longitude
                                    };
                                    infoWindow.setPosition(pos);
                                    infoWindow.setContent('Location found.');
                                    infoWindow.open(map);
                                    map.setCenter(pos);
                                }, function() {
                                    handleLocationError(true, infoWindow, map.getCenter());
                                });
                                } else {
                                // Browser doesn't support Geolocation
                                handleLocationError(false, infoWindow, map.getCenter());
                                }
                            }
                            function handleLocationError(browserHasGeolocation, infoWindow, pos)
                                {
                                    infoWindow.setPosition(pos);
                                    infoWindow.setContent(browserHasGeolocation ?
                                                        'Error: The Geolocation service failed.' :
                                                        'Error: Your browser doesn\'t support geolocation.');
                                    infoWindow.open(map);
                                }
                                                    </script>
                       <script async defer
                       src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhfGpSHEHb1lytFDkZ6sesd4H1MbIXzqs&callback=initMap">
                       </script>    
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
</body>


<div id="modal-wrapper" class="modal">
        
        <form class="modal-content animate" method="post" >
              
          <div class="imgcontainer">
            <span onclick="document.getElementById('modal-wrapper').style.display='none'" class="close" title="Close PopUp">&times;</span>
            <img src="1.png" alt="Avatar" class="avatar">
            <h1 style="text-align:center">Please Sign In first</h1>
          </div>
      
          <div class="imgccontainer">
            <input type="text" id = "email" placeholder="Enter Email" name="email">
            <input type="password" id="password" placeholder="Enter Password" name="password">        
            <button type="button" onclick="  loginAttendFunctoin()" style=" background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 26px;
            border: none;
            cursor: pointer;
            width: 90%;
            font-size:20px;">Login</button>
            <input type="checkbox" style="margin:26px 30px;"> Remember me      
            <a href="#" style="text-decoration:none; float:right; margin-right:34px; margin-top:26px;">Forgot Password ?</a>
          </div>
          
        </form>
        
      </div>
  

    <div id="modal-wrapper2" class="modal">
        
        <form class="modal-content animate" method="post" >
              
          <div class="imgcontainer">
            <span onclick="document.getElementById('modal-wrapper2').style.display='none'" class="close" title="Close PopUp">&times;</span>
            <img src="1.png" alt="Avatar" class="avatar">
            <h1 style="text-align:center">Please Sign In first</h1>
          </div>
      
          <div class="imgccontainer">
            <input type="text" id = "email2" placeholder="Enter Email" name="email2">
            <input type="password" id="password2" placeholder="Enter Password" name="password2">        
            <button type="button" onclick="  loginInterestFunctoin()" style=" background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 26px;
            border: none;
            cursor: pointer;
            width: 90%;
            font-size:20px;">Login</button>
            <input type="checkbox" style="margin:26px 30px;"> Remember me      
            <a href="#" style="text-decoration:none; float:right; margin-right:34px; margin-top:26px;">Forgot Password ?</a>
          </div>
          
        </form>
        
      </div>

      <div id="modal-wrapper-fees" class="modal">
        
     
      <form class="modal-content animate" method="post" >
              
          <div class="imgcontainer">
            <span onclick="document.getElementById('modal-wrapper2').style.display='none'" class="close" title="Close PopUp">&times;</span>
            <img src="2.jpg" alt="Avatar" class="avatar">
            <h3 style="text-align:center">Pay for Conference Fees</h3>
          </div>
      
          <div class="imgccontainer">
            <input type="text" id = "email2" placeholder="Name on Car" name="email2">
            <input type="password" id="password2" placeholder="Card Number" name="password2"> 

            <input type="password" id="password2" placeholder="CVV" name="password2">        
            <input type="password" id="password2" placeholder="Expiration Date" name="password2">        
       
            <button type="button" onclick="display_none()" style=" background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 26px;
            border: none;
            cursor: pointer;
            width: 90%;
            font-size:20px;">Make Your Payment</button>
          </div>
          
        </form>
        
      </div>

      <script>
          function display_none()
          {
            var modal = document.getElementById('modal-wrapper-fees');
                   
                            modal.style.display = "none";
                        
                     
          }
          function  loginAttendFunctoin(){
            document.getElementById('modal-wrapper').style.display='none';
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            $(document).ready(function() 
                { 
                 $.ajax
                ({
                        url :  "signToAttend.php?email="+email+"&pass="+password+"&id="+getUrlParameter("id"),
                        dataType: 'json', 
                        success: function(value){
                            attendToEvent();
                            document.getElementById("attendButton").innerHTML="attended";
                            
                            console.log(value);
                            console.log('caste: ' + value);
                            console.log ('success');
                        },
                        error : function () {
                            alert("Your cridentials are wrong!");
                            document.getElementById('modal-wrapper').style.display='block';
                            console.log ('error');
                        }
                });
                });
          }
          function loginInterestFunctoin()
          {
              
            document.getElementById('modal-wrapper2').style.display='none';
            var email = document.getElementById('email2').value;
            var password = document.getElementById('password2').value;
            $(document).ready(function() 
                { 
                 $.ajax
                    ({
                        url :  "signToInterest.php?email="+email+"&pass="+password+"&id="+getUrlParameter("id"),
                        dataType: 'json', 
                        
                        success: function(value){
                            interestInEvent();
                            document.getElementById("interestButton").innerHTML="interested";
                            console.log(value);
                            console.log('caste: ' + value);
                            console.log ('success');
                        },
                        error : function () {
                            alert("Your cridentials are wrong!");
                            document.getElementById('modal-wrapper2').style.display='block';
                            console.log ('error');
                        }
                    });
                });
          }
    
      </script>
      </body>

</html>



