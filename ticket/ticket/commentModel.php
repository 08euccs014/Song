<?php

class commentModel
{
	
	public $id 		= 0;
	public $parent_id = 0;
	public $content = '';
	public $like 	= 0;
	public $dislike = 0;
	public $param 	= '';
	public $popular = 50;
		
	
	//it will give me all comment of a discussion
	function getAllData($discussionId = 0)
	{
		$db = mFactory::getInstance();
		$db = $db->getDbo();
		
		$query = "select * from `comments` where `parent_id` = $discussionId";
	
		$records =  $db->loadRecords($query);
		
		$modifiedRecords = array();
		
		foreach ($records as $record){
			
			$obj = new discussionModel();
			
			$obj->id 		= $record->comment_id;
			$obj->parent_id = $record->parent_id;
			$obj->content 	= $record->content;
			$obj->like 		= $record->like;
			$obj->dislike 	= $record->dislike;
			$obj->param		= $record->param;	
			$obj->popular	= $record->popular;	
			
			$modifiedRecords[] = $obj;
		}
		
		return $modifiedRecords;
	}
	
	
	public static function getInstance($id = 0)
	{
		$obj = new commentModel();
		
		$db = mFactory::getInstance();
		$db = $db->getDbo();
		
		if($id == 0)
		{
			$query = "insert into `comments` (`parent_id`,`content`,`like`,`dislike`,`param`,`popular`) values ($obj->parent_id,'$obj->content',$obj->like,$obj->dislike,'$obj->param',$obj->popular)";

			$obj->id = $db->loadResult($query);
			
			return $obj;
		}
		
		$query = "select * from `comments` where `comment_id`= ".$id;
				
		$record = array_pop($db->loadRecords($query));
		
		if(empty($record) || $record == false)
		{
			return $obj;
		} 
		
		$obj->id 		= $record->comment_id;
		$obj->parent_id = $record->parent_id;
		$obj->content 	= $record->content;
		$obj->like 		= $record->like;
		$obj->dislike 	= $record->dislike;
		$obj->param		= $record->param;								
		$obj->popular	= $record->popular;	
		
		return $obj;
	}

	function save()
	{
		$db = mFactory::getInstance();
		$db = $db->getDbo();
		
		$query = "update `comments` set `parent_id`=$this->parent_id ,`content` = '$this->content' ,`like` = $this->like ,`dislike` = $this->dislike ,`param` = '$this->param', `popular` = $this->popular where `comment_id`= $this->id";
		
		return $db->loadExecute($query);
	}
}