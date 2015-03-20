<?php
       if ($_POST["submit"] == "View") {
?>      
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <head>
                <style type="text/css" media="all">
                    * {
                        margin:0px;
                        padding:0;
                    }
                    body {
                        margin:0px;
                        padding:0px;
                        font-family:Verdana, Arial, Helvetica, sans-serif;
                        font-size:12px;
                    }

                    span {
                        font-size:12px;
                    }

                    th, td {
                        width: 100mm;
                        height: 33.5mm;
                    }
                    table {
                        border-collapse:collapse;
                    }
                </style>
                <title>Hotel Label -  <?php echo $_SESSION["tourname"]; ?></title>
            </head>
            <body>
                <div style="margin:0px; padding:0; width:210mm; margin-top:12mm; margin-bottom:12mm; margin-left:0.5cm; margin-right:0cm; ">
<?php
        //echo $getno;
   /* } // View Tag Close
    else {

         ini_set("memory_limit", "50M");
         ob_start();*/

?>
            <style type="text/css" media="all">
                <!--
                body {
                    margin:0px;
                    font-family:Verdana, Arial, helvetica, sans-serif;
                    font-size:12px;
                }

                span {
                    font-size:12px;
                }

                td {
                    width: 100mm;
                    max-width: 100mm;
                    height: 33.5mm;
                    max-height:33.5mm;
                    top:0mm;
                }
                table {
                    border-collapse:collapse;
                }
                -->
            </style>
            <page backtop="13mm" backbottom="1mm" backleft="5mm" backright="5mm" style="font-size: 10px; font-family: Verdana;">
<?php

?>
                <?php

                $ctr16 = 0;
                $ctr16_2 = 0;
                $nctr = 0;
                $ctr = 0;
                $mctr = 0;
                $lblctr = 0;
                while ($lbl = mysql_fetch_assoc($get)) {
                    $ctr16++;
                    $ctr16_2++;
                    $nctr++;
                    $ctr++;
                    $lblctr++;
                    $getno--;

                    if ($ctr == 1) {
                        echo "<table border=\"0\" align=\"left\" style =\"width: 210mm;\">";
                        echo "\n <tr> \n ";
                        echo "\n <tr> \n ";
                        echo "\n <td style=\"width: 100mm; max-width: 100mm; height:33.5mm; padding-left:1mm;\" valign=\"top\"> \n";

                        if ($lblctr > 16) {
                         echo "<br>";
                         echo "<br>";
                        $lblctr = 1;
                    }

                    if ($ctr16 > 64) {
                        echo "<br>";
                        echo "<br>";
                        $ctr16 = 1;
                    }

                    }
                    else {
                        echo "\n <td style=\"width: 100mm; max-width: 100mm; height:33.5mm; padding-left:15mm;\" valign=\"top\"> \n";
                        if ($nctr > 16) {
                         echo "<br>";
                         echo "<br>";
                         $nctr = 1;
                    }
                    if ($ctr16_2 > 64) {
                        echo "<br>";
                        echo "<br>";
                        $ctr16_2 = 1;
                    }

                    }
                    echo "<br />". "<span><font size='3px'><b>$lbl[hotelname]</b></font>";
// echo "<font size='2px'>$lbl[hotelname]";

echo "<br />"."<br />"."<font size='2px'>Haji No.-$lbl[hajino]</font>";
echo "<br />"."$lbl[suffix] $lbl[surname] $lbl[name]$lbl[midname] <br />";

echo "<br />"."<font size='2px'><b>Room No - $lbl[roomno] &nbsp;&nbsp;&nbsp; Bus No - $lbl[busname]</font></b>";
echo "<br />";

echo "<br />";
echo "<br />";
echo "</span> ";

                   // echo "<br />";
                    echo "</td>";
                    if ($ctr == 2 || $getno == 0) {
                    echo '<br />';
                    $ctr = 0;
                    echo "</table>";

                    }
                }
                mysql_free_result($get);
                ?>

            </div>
        </body>
    </html>
  <?php

 } else($_POST["submit"]== "Print"){

     $filecontents = file_get_contents("hotel_label_print.php");
     print $filecontents;
 } ?>
