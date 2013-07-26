<?php 
class db
{
	protected $con = null;
	
	public function connection($host, $root, $pass,$database_name)
	{
		$this->con = mysql_connect($host, $root, $pass);
		if (!$this->con)
		{
		  	die('Could not connect: ' . mysql_error()).'<br>';
		  	return false;
		}
		
		$result = mysql_select_db($database_name, $this->con);
		
		return $result;
	}
	
	public function fetch_data($query)
	{
		$rows = mysql_query($query,$this->con);
		if (!$rows)
		{
			echo 'The query you have enterd did not works correctly <br>';
		}
		return $rows;
	}
	
	public function insert_data($query)
	{
		$rows = mysql_query($query,$this->con);
		if (!$rows)
		{
			return false;
		}
		
		$queryId = mysql_insert_id();
		return $queryId;
	}
}
?>