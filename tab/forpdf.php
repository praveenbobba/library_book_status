<!DOCTYPE html>
<html>
  <head>
 </head>
<body>

<?php
include('mpdf/mpdf.php');
$mpdf=new mPDF();
$test = '<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  </head>

  <body>
	<p>hi html</p>';
$test = $test . 'hi buddy' ;
$ch = 'for check now';

$test .= "<p>$ch</p>"; 
  $test .= '</body>

</html>
' ;

$mpdf->WriteHTML($test);
$mpdf->Output('receipts/filename.pdf','F');

?>

</body>
</html>




