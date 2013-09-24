<?php
	$savedata = $_POST['savedata'];
	$saveid   = $_POST['saveid'];
	

	$res = file_put_contents(dirname(__FILE__)."/".$saveid."/README.txt", $savedata);
	
	echo $res;
?>
