<?php
include_once 'connection.php';
	
class mFactory
{
	public $database 	= null;
	public $server 		= 'localhost';
	public $dbusername 	= 'root';
	public $dbpassword 	= 'password';
	public $dbname 		= 'tickets';
	public $db 			= null;
	
	public function getDbo()
	{
		
		$this->db = new db();
		$res = $this->db->connection($this->server,$this->dbusername,$this->dbpassword,$this->dbname);
		if($res){
			return $this;
		}
		return false; 
	}
	
	public function loadRecords($query)
	{
		$result 	= array();
		$resource 	= $this->db->fetch_data($query);
		
		if(empty($resource) || $resource == false)
		{
			return $result;
		}
		
		while ($row = mysql_fetch_array($resource, MYSQL_ASSOC))
		{
			$obj = new stdClass();
			foreach ($row as $key => $value)
				$obj->$key = $value;
			$result[]= $obj; 
		}
		
		return $result;
	}
	
	public function loadExecute($query)
	{
		return $this->db->fetch_data($query);
	}
	
	public function loadResult($query)
	{
		return $this->db->insert_data($query);
	}
	
	public static function getInstance()
	{
		$obj = new mFactory();
		return $obj;	
	}

}
