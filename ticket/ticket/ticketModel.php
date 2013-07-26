<?php

class ticketModel
{
	
	public $id = 0;
	public $title 	 = "";
	public $description  = "";
	public $level 	= 0; 
	public $created_date = "0000-00-00";
	public $deadline_date = "0000-00-00";
	public $release_date = "0000-00-00";	
	public $milestone = 0;	
	public $remark  = "";
	public $status  = 0;
	public $committed = "";
	public $type  = 0;

	
	//it will give me all ticket topics or all comments
	function getAllData()
	{
		$db = mFactory::getInstance();
		$db = $db->getDbo();
		
		$query = "select * from `ticket`";
	
		$records =  $db->loadRecords($query);
		
		$modifiedRecords = array();
		
		foreach ($records as $record){
			
			$obj = new ticketModel();
			
			$obj->id 			= $record->ticket_id;
			$obj->title 		= $record->title;
			$obj->description	= $record->description;
			$obj->level 		= $record->level;
			$obj->created_date	= $record->created_date;	
			$obj->deadline_date = $record->deadline_date;
			$obj->release_date 	= $record->release_date;
			$obj->milestone 	= $record->milestone;
			$obj->remark 		= $record->remark;
			$obj->status 		= $record->status;
			$obj->committed 	= $record->committed;
			$obj->type 			= $record->type;
			
			
			
			$modifiedRecords[] = $obj;
		}
		
		return $modifiedRecords;
	}
	
	public static function getInstance($id = 0)
	{
		$obj = new ticketModel();
		
		$db = mFactory::getInstance();
		$db = $db->getDbo();
		
		if($id == 0)
		{
			$query = "insert into `ticket` (`title`,`description`,`level`,`created_date`,`deadline_date`,`release_date`,`milestone`,`remark`,`status`,`committed`,`type`) values ('$obj->title','$obj->description',$obj->level,$obj->created_date,$obj->deadline_date,$obj->release_date,$obj->milestone,'$obj->remark',$obj->status,'$obj->committed',$obj->type)";

			$obj->id = $db->loadResult($query);
			
			return $obj;
		}
		
		$query = "select * from `ticket` where `ticket_id`= ".$id;
	
		$record = array_pop($db->loadRecords($query));
		
		if(empty($record) || $record == false)
		{
			return $obj;
		} 
		
		$obj->id 			= $record->ticket_id;
		$obj->title 		= $record->title;
		$obj->description	= $record->description;
		$obj->level 		= $record->level;
		$obj->created_date	= $record->created_date;	
		$obj->deadline_date = $record->deadline_date;
		$obj->release_date 	= $record->release_date;
		$obj->milestone 	= $record->milestone;
		$obj->remark 		= $record->remark;
		$obj->status 		= $record->status;
		$obj->committed 	= $record->committed;
		$obj->type 			= $record->type;
										
		return $obj;
	}

	function save()
	{
		$db = mFactory::getInstance();
		$db = $db->getDbo();
		
		$query = "update `ticket` set `title` = '$this->title' 
									 ,`description` = '$this->description'
									 ,`level` = $this->level 
									 ,`created_date` = '$this->created_date'
									 ,`deadline_date` = '$this->deadline_date' 
									 ,`release_date`  = '$this->release_date'
									 ,`milestone` = $this->milestone
									 ,`remark` = '$this->remark'
									 ,`status` = $this->status
									 ,`committed`=$this->committed
									 ,`type` = $this->type
									 where `ticket_id`= $this->id";
		
		return $db->loadExecute($query);
	}

	
	function deleteticket()
	{
		$db = mFactory::getInstance();
		$db = $db->getDbo();
		
		$query = "delete from `ticket` where `ticket_id`= $this->id";
		
		return $db->loadExecute($query);
	}
}