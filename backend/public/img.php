<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


 
 $source = realpath("public/qrcode.pdf");
 
 echo $source;
 
// output file
$target = "converted.jpg";
// create a command string
 
exec($source .'" -colorspace RGB -resize 800 "'.$target.'"', $output, $response);
 
echo $response ? "PDF converted to JPEG!!" : 'PDF to JPEG Conversion failed';
?>