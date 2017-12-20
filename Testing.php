<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



<script>
$(document).ready(function (){
    $("input").change(function(){
            var input = document.getElementById('txt1').value;
            document.getElementById('btn_2').style.visibility='visible';
              
});
});
</script>

</head>
<body>

    <input type="text" id='txt1' >
    <input type="text" id='txt2' >

<input id='btn_2' type="submit" class="button" value='Save' style='visibility:hidden' onclick='javascript:saved()' />

</body>
</html>
 