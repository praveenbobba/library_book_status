<?php
session_start();
?>
<!DocTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="mystyle.css">
	<meta http-equiv="refresh" content="0;URL='index.php'" />
	<title>Search</title>
	<link rel="shortcut icon" href="images/images.jpg" />
</head>
<body>

<?php
include('mpdf/mpdf.php');
$mpdf=new mPDF();

$test = '
<!DocTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="mystyle.css">
	<title>Details</title>
	<link rel="shortcut icon" href="images/images.jpg" />
</head>

<body>';


//for deleting the file created by admin query
/*
if($_SESSION['del_pdf'] != "")
{

	$del = unlink($_SESSION['del_pdf']);	
}

*/
																			
//$_SESSION['del_pdf'] = $pdf ; // to delete file

$pdf = "search_list.pdf" ;
//$permi = chmod($pdf,0766);

	$from_date = $_SESSION['from_search'] ;
	$to_date = $_SESSION['to_search'] ;		
	$bookno = $_SESSION['bookno_search'] ;
	$rollno = $_SESSION['rollno_search'] ;

/*echo $bookno."<br>" ;
echo $rollno."<br>" ;
echo $from_date."<br>" ;
echo $to_date."<br>" ; */

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

//------------------ all queries-----------

if( ($bookno !="") && ($rollno == "") && ($from_date == "") && ($to_date == "") )
{
	$sql = "SELECT ROLL_NO,BOOK_NO,UNIX_TIMESTAMP(TAKEN_DATE)  AS UNIXDATE
			FROM BOOKS_TAKEN 
				WHERE   BOOK_NO = '{$bookno}' 
					" ;		//-------- when only bookno is given
}

if( ($bookno =="") && ($rollno != "") && ($from_date == "") && ($to_date == "") )
{
	$sql = "SELECT ROLL_NO,BOOK_NO,UNIX_TIMESTAMP(TAKEN_DATE)  AS UNIXDATE 
			FROM BOOKS_TAKEN 
				WHERE BOOK_NO !='' AND ROLL_NO = '{$rollno}' 
				   " ;		//-------- when only rollno is given
}

if( ($bookno =="") && ($rollno == "") && ($from_date != "") && ($to_date != "") )    //-------- when from and to date is given
{
	$sql = "SELECT ROLL_NO,BOOK_NO,UNIX_TIMESTAMP(TAKEN_DATE)  AS UNIXDATE				
			FROM BOOKS_TAKEN 
				WHERE BOOK_NO !='' AND TAKEN_DATE BETWEEN '{$from_date}' AND '{$to_date}' 
					" ;		
}

if( ($bookno !="") && ($rollno != "") && ($from_date == "") && ($to_date == "") )	//-------- when rollno and bookno are given
{
	$sql = "SELECT ROLL_NO,BOOK_NO,UNIX_TIMESTAMP(TAKEN_DATE)  AS UNIXDATE 
			FROM BOOKS_TAKEN 
				WHERE ROLL_NO = '{$rollno}' AND BOOK_NO = '{$bookno}' 
					" ;
}

if( ($bookno !="") && ($rollno == "") && ($from_date != "") && ($to_date != "") )    //-------- when from and to date and bookno are given
{
	$sql = "SELECT ROLL_NO,BOOK_NO,UNIX_TIMESTAMP(TAKEN_DATE)  AS UNIXDATE 
			FROM BOOKS_TAKEN 
				WHERE BOOK_NO = '{$bookno}' AND TAKEN_DATE BETWEEN '{$from_date}' AND '{$to_date}' 
					" ;		
}

if( ($bookno =="") && ($rollno != "") && ($from_date != "") && ($to_date != "") )    //-------- when from and to date and rollno are given
{
	$sql = "SELECT ROLL_NO,BOOK_NO,UNIX_TIMESTAMP(TAKEN_DATE)  AS UNIXDATE
			FROM BOOKS_TAKEN 
				WHERE BOOK_NO !='' AND ROLL_NO = '{$rollno}' AND TAKEN_DATE BETWEEN '{$from_date}' AND '{$to_date}' 
					" ;
		
}

if( ($bookno !="") && ($rollno != "") && ($from_date != "") && ($to_date != "") )    //-------- when all are given
{
	$sql = "SELECT ROLL_NO,BOOK_NO,UNIX_TIMESTAMP(TAKEN_DATE)  AS UNIXDATE
			FROM BOOKS_TAKEN 
			WHERE BOOK_NO = '{$bookno}' AND ROLL_NO = '{$rollno}' AND TAKEN_DATE BETWEEN '{$from_date}' AND  '{$to_date}'
				" ; 		
}

if( ($bookno =="") && ($rollno == "") && ($from_date == "") && ($to_date == "") )    //-------- when none of them given
{
	$sql = "SELECT ROLL_NO,BOOK_NO,UNIX_TIMESTAMP(TAKEN_DATE)  AS UNIXDATE
			FROM BOOKS_TAKEN
				WHERE BOOK_NO !=''  
					" ;
						
}

//--------------------end of query declaration 

//-----------making a pdf

$retval = mysql_query($sql,$conn) ;

if(! $retval)
{
	die('cound not retrive the data : '. mysql_error()) ;
}

$total_records = mysql_num_rows($retval) ;
$status = 0;
$sno_count = 1 ;
$first_row_status = 0;

if($total_records == 0)
{
	?>
	<p id="para" style="margin-top:5px; margin-left:30%; ">Corresponding data items entered are not found</p>
	<?php
	die();
}


$test .= '

<div class="container">
 <div class="row">
  <div class="col-md-2">
    </div>
  <div class="col-md-6">';


//----- start making pdf
 while($row = mysql_fetch_array( $retval, MYSQL_ASSOC ) )
 {
	$date =  date('d/m/Y', 19800+$row['UNIXDATE']);
	$time = date('h:i:s a',19800+$row['UNIXDATE']);
      if($status == 0)
	{
	  $test .= "<div class='container-fluid '>
		<h2>Books Issued Details</h2>
		<table >
 		  <tr>
			<th style=' text-align:center;'>S.No</th>
			<th style=' text-align:center;'>Roll No</th>
			<th style=' text-align:center;'>Book No</th>
			<th style=' text-align:center;'>Date</th>
			<th style=' text-align:center;'>Time</th>
			
		</tr> ";


	   $status = 1 ;
	}
	

	  if($first_row_status == 1 && ($previous_date == $date) && ($previous_roll == $row['ROLL_NO'])  )
          {
		$sno_count = $sno_count - 1 ;
	  }
	  
	  $test .= "
		<tr>
			<td>$sno_count</td>
			<td>{$row['ROLL_NO']}</td>
			<td>{$row['BOOK_NO']}</td>
			<td>{$date}</td>
			<td>{$time}</td>
		</tr> ";
	   $previous_date = $date;
	   $previous_roll = $row['ROLL_NO'] ;
	   $first_row_status = 1 ;
	   $sno_count = $sno_count + 1 ;
           
	



 }
$sno_count = $sno_count - 1 ;

$test .= '

	</table>
     </div>

 </div>

<div class="col-mid-4">';

  $test .= '</body>

</html>
' ;

$mpdf->WriteHTML($test);
$mpdf->Output($pdf,'D');

//-------------------------
mysql_free_result($retval); //freeing memory of cursor
mysql_close($conn) ;

?>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>


</body>
</html>



