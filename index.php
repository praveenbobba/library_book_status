<?php
session_start();
?>
<!DOCTYPE html>
 
<html lang="en">
 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <title>Home Page</title>
        <link rel="shortcut icon" href="images/images.jpg" />
 
<script>
function loadXMLDoc()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","usr_count.php?t=" + Math.random(),true);
xmlhttp.send();
}
</script>
 
 
</head>
 
<body>
 
<?php
$_SESSION["counter"] = 0 ; //------------ for counting no of books
?>
 
<?php
//for deleting the file created by admin query
if($_SESSION['del_file'] != "")
{
    $del = unlink($_SESSION['del_file']);
    //$del = unlink($_SESSION['del_pdf']);    
}
?>
 
<div id="nitc" >
  <p1 id="header" >NITC Library</p1>
</div>
 
<!--
    <div class="container-fluid">
      <div class="jumbotron">
        <h2>NITC Libraray</h2>            
      </div>
    </div>
-->
 
<!-- homepage and admin page links-->
  <div class="container" >
    <ul class="nav nav-pills">
       <li class="active" id="menu_bar"><a href="index.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
       <li  id="menu_bar" ><a href="admin.php" ><span class="glyphicon glyphicon-globe"></span>Search</a></li>
       <li id="menu_bar"><a href="http://library.nitc.ac.in/people/index.html" target="_blank"><span class="glyphicon glyphicon-wrench"></span>Support</a></li>
       <li id="menu_bar"><a href="about.php"><span class="glyphicon glyphicon-question-sign"></span>About</a></li>
    </ul>
  </div>
 
 <h1>Welcome</h1>
  
<!-- for scanning the roll no of a student -->
<div class="container-fluid">
 <div class="row">
  <div id="track" class="col-md-7">
    <p id="myDiv"></p>
  </div>
  <div class="col-md-5">
    <div class="container-fluid" >
    <form  method="POST" action="read_rollno.php" role="form" style="margin-top:80px;">
        <label class="container-fluid">Roll No:</label>
        <div class="form-group">
          <div class="col-xs-8">
             
            <input type="text" name="roll" id="rollno" placeholder="Enter Student Roll Number" autofocus class="form-control" required>
          </div></br>
        </div></br>
        <div class="container-fluid">
         <button type="submit" class="btn btn-primary ">Submit</button>
         </div>   
    </form>
     </div>
 
 </div>
</div>
</div>
 
<!-- runs for counting no of check outs -->
 
 
<script>
 
setInterval(function () {loadXMLDoc()}, 10);
 
</script>
<!-- done-->
 
<div class="footer" id ="copyright" style="text-align:center; margin-top:19.1%; padding:0.5%;">
 <p>This Web Application is Developed & Maintained by Nalanda Admin Team.</p>
 <p>© Copyright 2014; Nalanda Digital Library, NIT Calicut, Kozhikode, Kerala, India - 673601</p>
</div>
 
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
 
</body>
</html>
