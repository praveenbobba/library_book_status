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

$bookno = $_POST["book"] ;
$i = $_SESSION['counter'] ;
$bk = "book".$i ;
$tm = "time".$i ;
$_SESSION[$bk] = $bookno ;

$_SESSION[$tm] = date("Y-m-d H:i:s");

//echo $_SESSION[$bk];
$i = $i + 1 ;
$_SESSION['counter'] = $i ;

?>


</body>
</html>
