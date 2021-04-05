<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>QR Code</title>
	
	<style>
		.page-break {
			page-break-after: always;
		}
		@page { margin: 0px;  padding: 0;}
		body { margin: 0px; padding: 0;}
		@page {
		  /* size: 793px 814px; */
		  margin: 0;
		}
		@page { size: 770px 580px landscape; }
	</style>
</head>
<body bgColor="#000" style="margin:0; padding: 0; background: url(http://192.168.1.19/magikqrcode/backend/public/pdf/final.jpg) no-repeat #003b5d; background-size: 100% 100%;">
	

<?php 
		$columns =1;
	$i = 0;
	// echo $start;
	// echo $end;
	
	
		for($j=$start;$j < $end; $j++)
		{
			
			//echo $qr[$j]->code;	
			
				?>
			
		<!--<p style="line-height:30px; font-family: Arial; font-size: 24px;">Welcome to - {{ $title }}</p><br>-->
	<table cellpadding="0" cellspacing="0" align="center" style="width:500px; height:706px; background: url(http://192.168.1.19/magikqrcode/backend/public/pdf/QR-code-bg.png) no-repeat; background-size: 100%; margin-bottom: 15px; page-break-after: always;">
		<tr>
			<td height="280"></td>
		</tr>
		
	<?php

	$key=$qr[$j]->qr_id;

	$i++;
    //if this is first value in row, create new row
	
    if ($i % $columns == 1) {
        echo "<tr>";
    }
	
    echo "<td valign='middle' align='center' style='background: none; line-height: 24px;'><img src=".env('APP_URL')."/images/".$qr[$j]->image."><br>".$key."</td>";
    //if this is last value in row, end row
    if ($i % $columns == 0) {
        echo "</tr>";
    }

	 ?>
	
	</table> 
	
	
	<?php }?>


               
</body>
</html>