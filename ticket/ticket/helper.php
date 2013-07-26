<?php

class frameworkHelper extends stdClass
{
	
	function setParam(){
		
	}
	function getParam(){
		
	}
	

	public static function getVar($variableName,$default = null)
	{
		if(isset($_POST[$variableName]))
		{
			return $_POST[$variableName];
		}
		elseif(isset($_GET[$variableName]))
		{
			return $_GET[$variableName];
		}
		elseif(isset($_REQUEST[$variableName]))
		{
			return $_REQUEST[$variableName];
		}
		else
		{
			return $default;
		}
	} 
}