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
$list = $list."<li><a href='Agenda_signed.html?id=$event_id_arr[$j]'>$names_found[$i]</a></li>";

    $j++;
    $i++;
}
$s++;
   }
   if ($count === 1){
     $list="";
   }

   ?>
<html lang="en">
    <head>
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    </head>
   <body>
<nav id="site-nav" class="navbar navbar-fixed-top navbar-custom">
        <div>
           

            <div class="collapse navbar-collapse" id="navbar-items" style="margin-right:15px;">
                <ul class="nav navbar-nav navbar-right">

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

<script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="bower_components/smooth-scroll/dist/js/smooth-scroll.min.js"></script>
    <script src="assets/js/main.js"></script>
    
   </body>

</html>  