<?php
	$savedata 	= getVar('savedata','');
	$saveToFile = getVar('saveToFile',"/README.txt");
	$saveid		= getVar('saveid',"");
	$saveAppend	= getVar('saveAppend',false);
	
	if($saveAppend)
		$res = file_put_contents(dirname(__FILE__)."/".$saveid.$saveToFile, $savedata,FILE_APPEND);
	else
		$res = file_put_contents(dirname(__FILE__)."/".$saveid.$saveToFile, $savedata);
	
	echo $res;

	function getVar($var, $default = null)
	{
		if(isset($_POST[$var])) {
			return $_POST[$var];
		}

		if(isset($_GEt[$var])) {
			return $_GET[$var];
		}
		
		return $default;
	}

?>
