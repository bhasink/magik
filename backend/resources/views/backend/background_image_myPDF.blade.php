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
<body bgColor="#000" style="margin:0; padding: 0; background-position:top;background: url(https://www.magiklights.com/qrcode/backend/public/pdf/Prism-Plus.jpg) no-repeat #003b5d; background-size:cover;">
	

@php	
$columns =1;
$i = 0;
@endphp

		@foreach($qr as $qrcode)
		<!--<p style="line-height:30px; font-family: Arial; font-size: 24px;">Welcome to - {{ $title }}</p><br>-->
		
		
<table cellpadding="0" cellspacing="0" align="center" style="width:580px; height:450px;">
		<tr>
			<td height="270"></td>
		</tr>
@php

$key=$qrcode->qr_id;

$i++;
    //if this is first value in row, create new row
	
    if ($i % $columns == 1) {
        echo "<tr>";
    }
	
    echo "<td valign='top' align='center' style='background: none; line-height: 0;'><img src=".env('APP_URL')."/images/".$qrcode->image." style='display: block;'>
	<strong style='display: block; text-align: center; font-size: 20px; '>".$key."</strong></td>";
    //if this is last value in row, end row
    if ($i % $columns == 0) {
        echo "</tr>";
    }

@endphp
</table> 
@endforeach



               
</body>
</html>