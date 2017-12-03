<!DOCTYPE html>
<html>
    
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="assets/css/style.css">
      <style>
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

select option {
    background: white;
    color: black;
    
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
	padding-bottom: 80px;
        margin-top: 180px;
}
.greenText{ background-color:white;
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
</style>
<body background="assets/images/flat_icons.jpg">

  <?php
    require "conn.php";
    require "models.php";
   
    if (isset($_POST['taskOption'])){
    $selectOption = $_POST['taskOption'];
    
    header("Location:Display_event.html?id=$selectOption");}

?>

    <form class="modal-content animate"  action="category.php" method="post">
        
    <div class="imgcontainer">
      <h1 style="text-align:center;color: #7ed321;">Please choose the category of the conferences you are interested in to see</h1>
    </div>

    <div class="container">
      <div class="row">
       <div class="form-group input-group">
   <select  onchange="this.className=this.options[this.selectedIndex].className"  class="form-control greenText" name="taskOption" id="category"  required>
                                <option  readonly>Choose Category</option> 
                                <option>All</option>
                                <option>Medicine</option>
                                <option>Politics</option>
                                <option>Sport</option>
                                <option>Technology</option>
                                <option>Art</option>
                                <option>Engineering</option>
                                <option>Science</option>
                                <option>Food</option>
                                <option>Law</option>
                                <option>Economy</option>                                
                                <option>Media and TV </option>                           
                              
        </select>
        </div>
      </div> 
        <input type="submit" value="Press Ok" style="color: #7ed321"/>
     
    </div>
    
  </form>
  
</body>
</html>





 