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
	<title>About</title>
	<link rel="shortcut icon" href="images/images.jpg" />
</head>

<body>
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

<!-- homepage and admin page links-->
  <div class="container" >
	<ul class="nav nav-pills">
	   <li id="menu_bar"><a href="index.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
	   <li id="menu_bar"><a href="admin.php"><span class="glyphicon glyphicon-globe"></span>Search</a></li>
	   <li id="menu_bar"><a href="http://library.nitc.ac.in/people/index.html" target="_blank"><span class="glyphicon glyphicon-wrench"></span>Support</a></li>
	   <li id="menu_bar"><a href="about.php"><span class="glyphicon glyphicon-question-sign"></span>About</a></li>
	</ul>
  </div>

 <h1>About the Page</h1>
 
<!-- for scanning the roll no of a student -->
<div class="container-fluid" id="about">
	<h2 style="text-align:left; ">For Issuing Books</h2>
	<p style="color:black;"><span class="glyphicon glyphicon-hand-right" style="color:orange;"></span> This web application is developed to keep the track of books and students</br><span class="glyphicon glyphicon-hand-right" style="color:orange;"></span>  The <a href="index.php" target="_blank" style="text-decoration:underline;">homepage</a> has a column which asks for a student Roll number. Submit it</br><span class="glyphicon glyphicon-hand-right" style="color:orange;"></span> After submitting, it takes you to the page where you can add books or remove added books</br><span class="glyphicon glyphicon-hand-right" style="color:orange;"></span> After adding all the books press <span style="font-family:Times New Roman; color:green;">ISSUE BOOKS</span> button to insert into database</br><span class="glyphicon glyphicon-hand-right" style="color:orange;"></span> On doing that a page with  books issued will be shown where you can <span style="font-family:Times New Roman; color:green;">DOWNLOAD</span> the receipt</p>
	<h2 style="text-align:left;">For Searching</h2>
	<p style="color:black;"><span class="glyphicon glyphicon-hand-right" style="color:orange;"></span> <a href="admin.php" target="_blank" style="text-decoration:underline;">Search menu</a> is available at the top left corner, search by a book or a Roll number or a date</br><span class="glyphicon glyphicon-hand-right" style="color:orange;"></span> Finally you can <span style="font-family:Times New Roman; color:green;">DOWNLOAD</span> the search content in the next page as a csv or a pdf file</br></p>
</div>

</body>
</html>
