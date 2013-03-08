<?php 
include 'room.php';

$silver = new room();
$silver->bedroom = 2;
$silver->kitchen = 1;
$silver->hall = 1;
$silver->rent = 2000;
$silver->available = 2;
$silver->type = 'silver';

$rakesh = new user();
$rakesh->name = 'rakesh';
$rakesh->pocket = 5000;


$manager = new managment();

$manager->allocate($silver, $rakesh);
echo $manager->display();

?><!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<img src='cptxt.php' height=200px; width=200px>
//
//if($silver->allocate($mohit)){
//echo "allocated\n";
//
//echo $silver->getAvailable().'\n';
//
//echo $mohit->getPocket();
//
//}
//else {
//echo"failed";
//}
//
//
//
//$rakesh = new user();
//$rakesh->name = 'rakesh';
//$rakesh->pocket = 5000;
//
//if($silver->allocate($rakesh)){
//echo "allocated\n";
//
//echo $silver->getAvailable().'\n';
//
//echo $rakesh->getPocket();
//
//}
//else {
//echo"failed";
//}
//
//$ankit = new user();
//$ankit->name = 'rakesh';
//$ankit->pocket = 5000;
//
//if($silver->allocate($ankit)){
//echo "allocated\n";
//
//echo $silver->getAvailable().'\n';
//
//echo $ankit->getPocket();
//
//}
//else {
//echo"failed";
//}


?>