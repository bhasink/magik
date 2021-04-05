<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>QR Code</title>
</head>
<body>
	<p style="line-height:30px; font-family: Arial; font-size: 24px;">Welcome to - {{ $title }}</p><br>

<table>

@php	
$columns = 4;
$i = 0;
@endphp

		@foreach($qr as $qrcode)


@php

$key=$qrcode->qr_id;

$i++;
    //if this is first value in row, create new row
    if ($i % $columns == 1) {
        echo "<tr>";
    }
    echo "<td style='text-align:center'><img src=".env('APP_URL')."/images/".$qrcode->image."><br>".$key."</td>";
    //if this is last value in row, end row
    if ($i % $columns == 0) {
        echo "</tr>";
    }
@endphp

@endforeach

@php 
$spacercells = $columns - ($i % $columns);
if ($spacercells < $columns) {
    for ($j=1; $j<=$spacercells; $j++) {
        echo "<td></td>";
    }
    echo "</tr>";
}

@endphp

</table>                
</body>
</html>