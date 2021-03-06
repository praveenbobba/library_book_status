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
	<title>Admin Page</title>
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


<h1>Admin Query</h1>
<!-- taking admin queries -->

<div class="container">
 <div class="row">
  <div id="para" class="col-md-7">
	<p>This webpage is for admin only. Leaving all inputs blank gives all records  </p></br>
  </div>
  <div class="col-md-5">

  <div class="container-fluid">
	

	<form method="POST" action="output.php" role="form" id="admin" >

	     <div class="form-group">
		<div class="col-xs-10">
		    <input type="text" name="rollno" placeholder="Student Roll No" class="form-control">
		</div></br>
	      </div></br>
	     <div class="form-group">
		<div class="col-xs-10">	
		 
		 <input type="text" name="bookno" placeholder= "Book No" class="form-control">
		</div></br>
	      </div>
		
	      <label class="container-fluid" >From Date:</label>
	     <div class="form-group">
		<div class="col-xs-10">	
	
			<select  name="from_dd" form="admin">
 			 <option value="">Day</option>
  			<option value=01>01</option>
  			<option value=02>02</option>
  			<option value=03>03</option>
  			<option value=04>04</option>
  			<option value=05>05</option>
  			<option value=06>06</option>
  			<option value=07>07</option>
  			<option value=08>08</option>
  			<option value=09>09</option>
  			<option value=10>10</option>
  			<option value=11>11</option>
  			<option value=12>12</option>
  			<option value=13>13</option>
  			<option value=14>14</option>
  			<option value=15>15</option>
  			<option value=16>16</option>
  			<option value=17>17</option>
  			<option value=18>18</option>
  			<option value=19>19</option>
  			<option value=20>20</option>
  			<option value=21>21</option>
  			<option value=22>22</option>
  			<option value=23>23</option>
  			<option value=24>24</option>
  			<option value=25>25</option>
  			<option value=26>26</option>
  			<option value=27>27</option>
  			<option value=28>28</option>
  			<option value=29>29</option>
  			<option value=30>30</option>
  			<option value=31>31</option>
			</select>

			<select name="from_mm" form="admin">
  			<option value=''>Month</option>
  			<option value=01>Jan</option>
  			<option value=02>Feb</option>
  			<option value=03>Mar</option>
  			<option value=04>Apr</option>
  			<option value=05>May</option>
  			<option value=06>June</option>
  			<option value=07>July</option>
  			<option value=08>Aug</option>
  			<option value=09>Sep</option>
  			<option value=10>Oct</option>
  			<option value=11>Nov</option>
  			<option value=12>Dec</option>
			</select>

			<select name="from_yy" form="admin" >
 			 <option value="">Year</option>
  			<option value=2005>2005</option>
  			<option value=2006>2006</option>
  			<option value=2007>2007</option>
  			<option value=2008>2008</option>
  			<option value=2009>2009</option>
  			<option value=2010>2010</option>
  			<option value=2011>2011</option>
  			<option value=2012>2012</option>
  			<option value=2013>2013</option>
  			<option value=2014>2014</option>
  			<option value=2015>2015</option>
  			<option value=2016>2016</option>
  			<option value=2017>2017</option>
  			<option value=2018>2018</option>
  			<option value=2019>2019</option>
  			<option value=2020>2020</option>
  			<option value=2021>2021</option>
  			<option value=2022>2022</option>
  			<option value=2023>2023</option>
  			<option value=2024>2024</option>
			</select>

		</div></br>
  	     </div>

		<label class="container-fluid">To Date:</label>
	     <div class="form-group">
		<div class="col-xs-10">		


			<select name="to_dd" form="admin">
 			<option value="<?php echo date('d'); ?>"><?php echo date('d'); ?></option>
  			<option value=01>01</option>
  			<option value=02>02</option>
  			<option value=03>03</option>
  			<option value=04>04</option>
  			<option value=05>05</option>
  			<option value=06>06</option>
  			<option value=07>07</option>
  			<option value=08>08</option>
  			<option value=09>09</option>
  			<option value=10>10</option>
  			<option value=11>11</option>
  			<option value=12>12</option>
  			<option value=13>13</option>
  			<option value=14>14</option>
  			<option value=15>15</option>
  			<option value=16>16</option>
  			<option value=17>17</option>
  			<option value=18>18</option>
  			<option value=19>19</option>
  			<option value=20>20</option>
  			<option value=21>21</option>
  			<option value=22>22</option>
  			<option value=23>23</option>
  			<option value=24>24</option>
  			<option value=25>25</option>
  			<option value=26>26</option>
  			<option value=27>27</option>
  			<option value=28>28</option>
  			<option value=29>29</option>
  			<option value=30>30</option>
  			<option value=31>31</option>
			</select>

			<select name="to_mm" form="admin">
  			<option value="<?php echo date('m'); ?>"><?php echo date('M'); ?></option>
  			<option value=01>Jan</option>
  			<option value=02>Feb</option>
  			<option value=03>Mar</option>
  			<option value=04>Apr</option>
  			<option value=05>May</option>
  			<option value=06>June</option>
  			<option value=07>July</option>
  			<option value=08>Aug</option>
  			<option value=09>Sep</option>
  			<option value=10>Oct</option>
  			<option value=11>Nov</option>
  			<option value=12>Dec</option>
			</select>

			<select name="to_yy" form="admin" >
 			<option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
  			<option value=2005>2005</option>
  			<option value=2006>2006</option>
  			<option value=2007>2007</option>
  			<option value=2008>2008</option>
  			<option value=2009>2009</option>
  			<option value=2010>2010</option>
  			<option value=2011>2011</option>
  			<option value=2012>2012</option>
  			<option value=2013>2013</option>
  			<option value=2014>2014</option>
  			<option value=2015>2015</option>
  			<option value=2016>2016</option>
  			<option value=2017>2017</option>
  			<option value=2018>2018</option>
  			<option value=2019>2019</option>
  			<option value=2020>2020</option>
  			<option value=2021>2021</option>
  			<option value=2022>2022</option>
  			<option value=2023>2023</option>
  			<option value=2024>2024</option>
			</select>

		</div></br>
  	     </div></br>
	
	    <div class="container-fluid">
	     <button type="submit" style="font-size:20px;" class="btn btn-primary">Search <span class="glyphicon glyphicon-search"></span></button>
	     </div>
	</form>
  </div>

 </div>
</div>
</div>
<!-- ************************ -->



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
