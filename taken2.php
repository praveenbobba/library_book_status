<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<meta http-equiv="refresh" content="2;URL='index.php'" />
	
	<title>Books Taken</title>
	<link rel="shortcut icon" href="images/images.jpg" />



<style>

#nitc {
    background-color:black;
    color:white;
    font-family: Times New Roman;
    padding:5px;
    font-size:30px;
}

#header
{
    text-align:left;
    	margin-left:60px;
}

li
{
	
	float:left;
	font-size:18px;
}


td,th,h2,h3,p{
	padding : 3px ;
	text-align:center;
	color:black;
}

h2{
	padding : 3px;
}

.take{
	border: 1px solid black ;
	border-collapse : collapse ;
	width:80%;
	
	text-align:center;
	margin: 0 auto;
	
}

p{
	font-size:30px;
}

</style>

</head>

<body >

<div id="nitc" >
  <p1 id="header" >NITC Library</p1>
</div>

<!-- homepage and admin page links-->
  <div class="container" >
	<ul class="nav nav-pills">
	   <li id="menu_bar"><a href="index.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
	   <li id="menu_bar"><a href="admin.php"><span class="glyphicon glyphicon-globe"></span>Search</a></li>
	   <li id="menu_bar"><a href="http://library.nitc.ac.in/people/index.html" target="_blank"><span class="glyphicon glyphicon-wrench"></span>Support</a></li>
	   <li id="menu_bar"><a href="about.php"><span class="glyphicon glyphicon-question-sign"></span>About</a></li>
	</ul>
  </div>


<?php

$rollno = strtoupper($_SESSION["rollno"]);
$i = 0 ;

// connecting to the database

$dbhost = 'sql105.epizy.com' ;
$dbuser = 'epiz_20683779';
$dbpass = 'praveens22222';

//connecting to the database
$conn = mysql_connect($dbhost,$dbuser,$dbpass);

if(! $conn)
{
	die("could not connect to the database server : " . mysql_error());
}

mysql_select_db('epiz_20683779_books');   //------------- selecting the LIBRARY database

//------ sql query----------

$i = 0 ;

 
while($i < $_SESSION['counter'])
{
    $bk = "book".$i ;
    $tm = "time".$i;
    $bookno = $_SESSION[$bk]  ;
     $ctime = $_SESSION[$tm] ;
    //echo $_SESSION[$bk];
     
    $sql = "INSERT INTO BOOKS_TAKEN VALUES('{$rollno}','{$bookno}','{$ctime}')";
    $retval = mysql_query($sql,$conn) ;
 
    if(! $retval)
    {
        die('cound not insert the data : '. mysql_error()) ;
    }
 
    mysql_free_result($retval); //freeing memory of cursor
    $i = $i + 1;
}

mysql_close($conn) ;

?>

<h2 style="color:navy">Books Issued Successfully</h2>

<a href="receipt.php" class="btn btn-info " style="right:12%; top:88%; position:fixed; font-size:18px; ">Generate receipt <span class="glyphicon glyphicon-download"></span></a></br>

<table class="take">

<?php

$numb =  $_SESSION['counter'];
$stamp= time()  ;
$_SESSION['rec_time'] = $stamp;
$date = date("d M Y h:i:s a",$stamp);

echo   "

	<tr>
	<td><p style='font-size:70px;'>Roll Number : $rollno</p><td>
	</tr>
	<tr>
	<td><p style='font-size:70px;'>Total Books : $numb</p><td>
	</tr>
	<tr>
	<td><p>Time of issue  : $date</p><td>
	</tr>
		";



$i = 0 ;

while($i < $_SESSION['counter'])
{
	$bk = "book".$i ;
	$k = $i + 1;
	$bookcount = "Book-".$k;
	
	echo"<tr>
		<td><p style='text-align:center;'>$bookcount : $_SESSION[$bk]</p><td>
	
		</tr>";
	
	$i = $i + 1;
}
?>
    <tr>
	<td><p style="text-align:center; font-style:italic; font-weight:bold;">"have a nice day :)"</p><td>
   </tr>

</table></br>

<a> </a>

</body>
</html>



