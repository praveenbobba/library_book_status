<?php
session_start();
?>
<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="refresh" content="0;URL='book.php'" />
<title>Home</title>
</head>

<body>

<?php

$_SESSION["rollno"] = $_POST["roll"] ;
$_SESSION["rollno"] = strtoupper($_SESSION["rollno"]);
$_SESSION["counter"] = 0 ; //------------ for counting no of books

?>

</body>
</html>
