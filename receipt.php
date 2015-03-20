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
	<meta http-equiv="refresh" content="1;URL='index.php'" />
	<title>Books Taken</title>
	<link rel="shortcut icon" href="images/images.jpg" />


</head>

<body>

<?php
include('mpdf/mpdf.php');
$mpdf=new mPDF();
/*
if($_SESSION['receipt'] != "")
{
	$def=unlink($_SESSION['receipt']);

} 

*/

$test = '

<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
	<title>Books Taken</title>
	<link rel="shortcut icon" href="images/images.jpg" />
<style>

td,th,h2,h3,p{
	padding : 5px ;
	text-align:center;
	color:black;
}

h2{
	padding : 10px;
}

table{
	border: 1px solid black ;
	border-collapse : collapse ;
	width:52%;
	
	text-align:center;
	margin: 0 auto;
	
}

p{
	font-size:15px;
}

</style>

</head>

<body>';

$rollno = strtoupper($_SESSION["rollno"]);
$receipt = "receipt_".$rollno.".pdf" ;
//$per= chmod($receipt,0777);

$test .= '

<table >
  <tr>
	<td><h2>NITC Library</h2><td>
  </tr>
  <tr>
	<td><h3 style="text-decoration:underline; text-align:center;">Books Issued Receipt</h3><td>

   </tr>';

$numb =  $_SESSION['counter'];
$stamp= $_SESSION['rec_time'] + 19800 ;
$date = date("d M Y h:i:s a",$stamp);

$test .= "
	<tr>
	<td><p>Time of issue  : $date</p><td>
	</tr>
	<tr>
	<td><p>Roll Number : $rollno</p><td>
	</tr>
	<tr>
	<td><p>Total Books : $numb</p><td>
	</tr>";



$i = 0 ;

while($i < $_SESSION['counter'])
{
	$bk = "book".$i ;
	$k = $i + 1;
	$bookcount = "Book-".$k;
	
	$test .= "<tr>
		<td><p style='text-align:center;'>$bookcount : $_SESSION[$bk]</p><td>
	
		</tr>";
	
	$i = $i + 1;
}

$test .= '
    <tr>
	<td><p style="text-align:center; font-style:italic; font-weight:bold;">"have a nice day :)"</p><td>
   </tr>

</table>

</body>
</html>';


$mpdf->WriteHTML($test);
$mpdf->Output($receipt,'D');

?>
</body>
</html>

