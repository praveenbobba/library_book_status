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
	<title>Books</title>
	<link rel="shortcut icon" href="images/images.jpg" />
   <style> 
   form {margin-top: 2em;} 
   #accession {margin-top: -1em;}
   </style>

</head>

<body>

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
<!--*******-->

   <h1>Issue Books</h1>

<div class="container">
 <div class="row">
  <div class="col-md-7">

<!-- printing the books entered-->

  <div class="container-fluid">
   <form class="form-horizontal" role="form" > 
     <div class="form-group" id="pos_fixed2" style="position: fixed; margin-left:635px;  margin-top:55px;">
	
	<label class="control-label col-sm-4" >Roll No: </label>
	<div class="col-sm-8" >
	<input type="text" id="rollnos" name="roll" class="form-control" value="<?php echo $_SESSION['rollno']; ?>" readonly>
	</div>
     </div>
      
	<?php
		$added_count = $_SESSION['counter'] ; ;
	?>

     <div class="container" style="position: fixed; margin-left:640px;  ">
	<h3> <?php echo "Number of Books Added are : {$added_count}<br>" ; ?> </h3>
     </div>
   </form>
  </div>

      <?php
	$status = 0;
	$i = 0;
	$count_books = $_SESSION['counter'] ;
	while($i < $count_books)
	{	
		$bk = "book".$i;
		$_SESSION['cancel'] = $i;
		$status = 1; //for submit button
		$k = $i + 1;
		?>
		<form class="form-horizontal" role="form" action="cancel.php" method="POST" id="print">
		  <div class="form-group">
			<label class="control-label col-sm-2" for="<?php echo $bk ; ?>"><?php echo "Book-".$k. ":"; ?></label>
		 
			<div class="col-sm-5">
			 
			<input type="text" id="<?php echo $bk ; ?>"  class="form-control" value="<?php echo $_SESSION[$bk]; ?>" readonly >
					 

			<input type="number" name="cancel" value="<?php echo $i ; ?>" hidden>			
			
			</div>
			<button class="btn btn-warning btn-sm">
          			<span class="glyphicon glyphicon-remove"></span>
        		</button>
			
		</div>
	
		</form>
		<?php
		  $i += 1;
	}
   ?>
  


</div>



<!--******************-->

<!-- scanning the book nos-->

	
  
  <div class="col-md-5">

     <div class="container-fluid">
	<form action="read.php" method="POST" role="form" id="accession" style="margin-top:130px; position: fixed; margin-left:60px;">
	    <label class="container-fluid">Accession No:</label>
	    <div class="form-group">
		  <div class="col-xs-12">
	    		<input type="text" id="booknos" name="book" autofocus class="form-control" placeholder="Enter Accession No" required>
		</div></br>
	     </div></br>
	    <div class="container-fluid">
	     <button type="submit" class="btn btn-primary">Add Book</button>
	     </div>
		
	</form>

     </div>

<form>
<?php

if($status == 1)
{	

	 
	?>
	<div >	
       	   <a  style="position: fixed; margin-top:20%; font-size:48px;" href="taken2.php"  class="btn btn-success btn-lg">Issue Books</a>
	</div> 
	<?php
}

?>
</form>

 </div>
</div>
</div>

<!-- ************ -->

<!-- opening the page from bottom-->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
