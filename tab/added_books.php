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

   <style> 
   form {margin-top: 1em;} 
   #accession {margin-top: -1em;}
   </style>

</head>

<body >



     <div class="container" style="margin-left:14%">
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
		<form  role="form" action="cancel.php" method="GET" id="print">
		  <div class="form-group">

			<div class="col-sm-4">
			<label for="<?php echo $bk ; ?>"><?php echo "Book-".$k. ":"; ?></label>
		        </div>
			<div class="col-xs-6">
			 
			<input type="text" id="<?php echo $bk ; ?>"  class="form-control" value="<?php echo $_SESSION[$bk]; ?>" readonly >
			</div>		 
			
			<input type="number" name="cancel" value="<?php echo $i ; ?>" hidden>			
			
			
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



<!-- ************ -->

<!-- opening the page from bottom-->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
