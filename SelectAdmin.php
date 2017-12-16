<?php
$id=$_GET['id'];
//DataBase
$hostname = "localhost";
$username = "root";
$password = "";
$databaseName = "evento";
$connect = mysqli_connect($hostname, $username, $password, $databaseName);
require "models.php";

session_start();
$_SESSION['event_id']=$id;

//Variables
$first_name_speaker=array();
$last_name_speaker=array();
$i=0;
$options = "";
//QUERY
$query = "SELECT * FROM users";
$result = mysqli_query($connect, $query);
while($row = mysqli_fetch_array($result))
{
    $user_id=$row['user_id'];
    
    $first_name_speaker[$i]=$row['first_name'];
    //$last_name_speaker[$i]=$row2['last_name'];
    //setList
    //$options = $options."<option>$first_name_speaker[$i] $last_name_speaker[$i]</option>";
    $options = $options."<option>$first_name_speaker[$i]</option>";

    //incement counter
    $i++;
}

?>
<!DOCTYPE html>
<html>
 <head>
    <title>Choose Admin</title>
    <link rel="stylesheet" href="bower_components/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
  
 </head>
 <body background="assets/images/administrator.jpg" style="background-size: 1850px 1200px; background-repeat: no-repeat;">
    <nav id="site-nav" class="navbar navbar-fixed-top navbar-custom">
        <div >
            <div class="navbar-header" style="margin-left: 20px;">
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

            <div class="collapse navbar-collapse" id="navbar-items" style="margin-right: 20px;">
                <ul class="nav navbar-nav navbar-right">

                    <!-- navigation menu -->
                    <li><a  href="about.html">About</a></li>          
                    <li><a  href="upComing.html">UpComing</a></li> 
                   <?php 
                   $event_id=$id;
             echo "<li><a  href='conf_sett.html?id=$event_id'>Conf_Settings</a></li>" ;?>
                    <?php 
                   $event_id=$id;
             echo "<li><a  href='Agenda_Display_DB.php?id=$event_id'>Agenda_Settings</a></li>" ;?>
                    <li><a  href="index.html">Home</a></li>

                </ul>
            </div>
        </div><!-- /.container -->
    </nav>

  <br /><br />
  <div class="container" style="background:gainsboro;align-items: center;height:250px;margin-top: 180px; ">
   <br />
   <h4 style="float:left;font-weight: bold;font-size:1.7em; " class="section-title">Select Admin/s for this session</h4>

   <br />
   <div>
    <form method="post" id="multiple_select_form">
     <select name="framework" id="framework" class="form-control selectpicker" data-live-search="true" multiple>
                <?php echo $options;?>
        </select>
      
     </select>
     <br /><br />
     <input type="hidden" name="hidden_framework" id="hidden_framework" />
     <input type="submit" name="Submit" class="btn btn-info" value="Submit"style="padding:10px;" />  
   
    </form>
    <br />
    
   </div>
  </div>
 </body>
</html>

<script>
$(document).ready(function(){
    
 $('.selectpicker').selectpicker();

 $('#framework').change(function(){
  $('#hidden_framework').val($('#framework').val());
 });

 $('#multiple_select_form').on('submit', function(event){
  event.preventDefault();
  if($('#framework').val() != '')
  {
   var form_data = $(this).serialize();
   $.ajax({
    url:"InsertAdminDB.php",
    method:"POST",
    data:form_data,
    success:function(data)
    {
     $('#hidden_framework').val('');
     $('.selectpicker').selectpicker('val', '');
     alert(data);
    }
   })
  }
  else
  {
   alert("Please select speaker");
   return false;
  }
 });
});
</script>
