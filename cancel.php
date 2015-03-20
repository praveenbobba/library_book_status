<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="refresh" content="0;URL='book.php'" />
	<title>Books Taken</title>
</head>

<body>


<?php

$i =$_POST["cancel"] ;

$max = $_SESSION["counter"];

while($i < ($max - 1))
{
	$first = "book".$i ;
	$first_tm = "time".$i ;
	$k = $i + 1;
	$next = "book".$k ;
	$next_tm = "time".$k ;
	$_SESSION[$first] = $_SESSION[$next] ;
	$_SESSION[$first_tm] = $_SESSION[$next_tm] ;
	$i += 1;
}

$max = $max - 1 ;

$_SESSION["counter"] = $max ;
?>


</body>
</html>
