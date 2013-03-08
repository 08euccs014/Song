<?php
// start the session to store the variable
session_start();

$con = mysql_connect("localhost","root","password");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("test", $con);
 
// generate the random code
$chars = 'abcdefghkmnprstuvwxyzABCDEFGHJKLMNPQRSTUV2345689';
$length = 6;
$code = '';
for($i = 0; $i < $length; $i++){
   $pos = mt_rand(0, strlen($chars)-1);
   $code .= substr($chars, $pos, 1);
}
 
// store the code to compare later
$_SESSION['captcha'] = $code;

 $sql="insert into  cap_image(captext) VALUES ('$code')";
   $res=mysql_query($sql,$con);

 
// set up the image
// size
$width = 120;
$height = 30;
// colors
$r = mt_rand(160, 255);
$g = mt_rand(160, 255);
$b = mt_rand(160, 255);
// create handle for new image
$image = imagecreate($width, $height);
// create color handles
$background = imagecolorallocate($image, $r, $g, $b);
$text = imagecolorallocate($image, $r-128, $g-128, $b-128);
// fill the background
imagefill($image, 0, 0, $background);
 
// add characters in random orientation
for($i = 1; $i <= $length; $i++){
   $counter = mt_rand(0, 1);
   if ($counter == 0){
      $angle = mt_rand(0, 30);
   }
   if ($counter == 1){
      $angle = mt_rand(330, 360);
   }
   // "arial.ttf" can be replaced by any TTF font file stored in the same directory as the script
   imagettftext($image, mt_rand(14, 18), $angle, ($i * 18)-8, mt_rand(20, 25), $text, "arial.ttf", substr($code, ($i - 1), 1));
}
 
// draw a line through the text
imageline($image, 0, mt_rand(5, $height-5), $width, mt_rand(5, $height-5), $text);
 
// blur the image
$gaussian = array(array(1.0, 2.0, 1.0), array(2.0, 4.0, 2.0), array(1.0, 2.0, 1.0));
imageconvolution($image, $gaussian, 16, 0);
 
// add a border for looks
imagerectangle($image, 0, 0, $width - 1, $height - 1, $text);
 
// prevent caching
header('Expires: Tue, 08 Oct 1991 00:00:00 GMT');
header('Cache-Control: no-cache, must-revalidate');
 
// output the image
header("Content-Type: image/gif");
imagegif($image);
imagedestroy($image); 
?>
