
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
</head>

<body>


<?php
//---------------- for database to maintain no of users per day


// connecting to the database

$dbhost = 'localhost:3036' ;
$dbuser = 'root';
$dbpass = 'praveens22222';

//connecting to the database
$conn = mysql_connect($dbhost,$dbuser,$dbpass);

if(! $conn)
{
	die("could not connect to the database server : " . mysql_error());
}

mysql_select_db('LIBRARY');   //------------- selecting the LIBRARY database

//-------query

$today = date("Y-m-d");

$sql = "SELECT DISTINCT ROLL_NO
			FROM BOOKS_TAKEN 
				WHERE   TAKEN_DATE LIKE '%{$today}%' " ;

//--------end of query
 

$retval = mysql_query($sql,$conn) ;

if(! $retval)
{
	die('cound not retrive the data : '. mysql_error()) ;
}

$total_stnd = mysql_num_rows($retval) ;
//-------------------------------- end of users


//------------- for books

$sql = "SELECT DISTINCT BOOK_NO
			FROM BOOKS_TAKEN 
				WHERE   TAKEN_DATE LIKE '%{$today}%' " ;

$retval = mysql_query($sql,$conn) ;

if(! $retval)
{
	die('cound not retrive the data : '. mysql_error()) ;
}

$total_book = mysql_num_rows($retval) ;

//---------------- end of books


mysql_free_result($retval); //freeing memory of cursor
mysql_close($conn) ;

echo "<p id='myDiv' style='font-size:30px; margin-top:90px; font-family:Bree Serif; font-style:italic; margin-left:115px;' >Number of people who took books today :<span class='glyphicon glyphicon-user' style='font-size:22px; color:navy;'></span> $total_stnd</br>
      Number of books issued today :<span class='glyphicon glyphicon-book' style='font-size:22px; color:green;'></span> $total_book</p>";

?>

</body>
</html>
