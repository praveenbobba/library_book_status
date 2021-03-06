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
	<title>Details</title>
	<link rel="shortcut icon" href="images/images.jpg" />
</head>

<body>
<p id="movtop" style="float:left;"></p>
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
//for deleting the file created by admin query
if($_SESSION['del_file'] != "")
{
	$del = unlink($_SESSION['del_file']);
}

$fname = "admin_download/".$rollno."_".$bookno."_from_".$from_dd."-".$from_mm."-".$from_yy."_to_".$to_dd."-".$to_mm."-".$to_yy."_".time().".csv"; 
										
$_SESSION['del_file'] = $fname ; // to delete file

$from_dd = $_POST['from_dd'] ;
$from_mm = $_POST['from_mm'] ;
$from_yy = $_POST['from_yy'] ;

$to_dd = $_POST['to_dd'] ;
$to_mm = $_POST['to_mm'] ;
$to_yy = $_POST['to_yy'] ;

$bookno = $_POST['bookno'];
$rollno = $_POST['rollno'];

// finding a filename

$fname = "admin_download/".$rollno."_".$bookno."_".$from_dd."-".$from_mm."-".$from_yy."_".$to_dd."-".$to_mm."-".$to_yy."_".time().".csv"; 
										
$_SESSION['del_file'] = $fname ; // to delete file


//POSTting date in yyyy-mm-dd format
if($from_dd !="")
{


	//echo"hi";
	$from_date =  $from_yy ."-". $from_mm ."-". $from_dd . " 00:00:00";
	$to_date = $to_yy ."-". $to_mm ."-". $to_dd ." 23:59:59";

}

else
{
	$from_date = "";
	$to_date = "";		

}


$_SESSION['from_search'] = $from_date;
$_SESSION['to_search'] = $to_date;
$_SESSION['bookno_search'] = $bookno;
$_SESSION['rollno_search'] = $rollno;

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
					ORDER BY ROLL_NO" ;
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

//----------- printing details in a table

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
?>



<div class="container">
 <div class="row">
  <div class="col-md-2">
    </div>
  <div class="col-md-6">

<?php
//----- start printing
 while($row = mysql_fetch_array( $retval, MYSQL_ASSOC ) )
 {
	$date =  date('d/m/Y', $row['UNIXDATE']);
	$time = date('h:i:s a',$row['UNIXDATE']);
      if($status == 0)
	{
	 echo" <div class='container-fluid '>
		<h2>Books Issued Details</h2>
		<table class='table table-bordered'>
 		  <tr>
			<th>S.No</th>
			<th>Roll No</th>
			<th>Book No</th>
			<th>Date</th>
			<th>Time</th>
			
		</tr> ";


	   $status = 1 ;
	}
	

	  if($first_row_status == 1 && ($previous_date == $date) && ($previous_roll == $row['ROLL_NO'])  )
          {
		$sno_count = $sno_count - 1 ;
	  }
	  
	  echo"
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

?>

	</table>
     </div>

 </div>

<div class='col-mid-4'>

<!-- downloading the details files-->


<div class="container"  >
	<div id="pos_fixed">
	<p style="font-family:Ubuntu; font-size:18px;">Total number of student records found : <?php echo $sno_count ; ?> </p>
	<p style="font-family:Ubuntu; font-size:18px;">Total number of book records found : <?php echo $total_records ; ?> </p>
	<a href="<?php echo $fname; ?>" class="btn btn-info ">Download csv file <span class="glyphicon glyphicon-download"></span></a></br></br>
	<a href="search.php" class="btn btn-info ">Download pdf file <span class="glyphicon glyphicon-download"></span></a></br>
	<a href="#movtop" class="btn btn-default btn-lg" style="margin-top:75%; margin-left:70%">Top <span class="glyphicon glyphicon-chevron-up"></span></a>
	</div>
     </div>	     
  </div>

<!-- ******************* -->

</div>
</div>
</div> 

<?php
//----------------------------------------------------------------------------------------------------------------

//---------- printing details to an csv(excel) file named issue_details.csv-------



$status = 0 ;
$file = fopen( $fname,"w+");
$sno_count = 1 ;
$first_row_status = 0;
$retval = mysql_query($sql,$conn) ;

$permi = chmod($fname,0766);

if(! $retval)
{
	die('cound not insert the data : '. mysql_error()) ;
}


while($row = mysql_fetch_array( $retval, MYSQL_ASSOC ) )
{

  	if($status == 0)
  	{
		
		$list = array
		(
			"S.No,Roll No,Accession No,Date,Time",

		);

		foreach ($list as $line)
  		{
  			fputcsv($file,explode(',',$line));
  		}
		
		$status = 1 ;
  	}


	$date =  date('d/m/Y', $row['UNIXDATE']);
	$time = date('h:i:s a',$row['UNIXDATE']);

	if($first_row_status == 1 && ($previous_date == $date) && ($previous_roll == $row['ROLL_NO'])  )
        {
		$sno_count = $sno_count - 1 ;
	}

	  $list = array
	  (
		"{$sno_count},{$row['ROLL_NO']},{$row['BOOK_NO']},{$date},{$time}",

	  );	

	  foreach ($list as $line)
  	  {
  		fputcsv($file,explode(',',$line));
  	  }
	   $previous_date = $date;
	   $previous_roll = $row['ROLL_NO'] ;
	   $first_row_status = 1 ;
	   $sno_count = $sno_count + 1 ;
}
fclose($file);

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
