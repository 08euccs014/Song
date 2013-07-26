<?php
class ticketView extends mView
{
	function display()
	{
		
		$records = ticketModel::getAllData();
		
		$this->assign('records',$records);
		
		$this->loadTemplate('','','1');
		
		return true;
	}
	
	function add()
	{
		
		//call createticket function of model and send response accodrign 
		$ticket			 = ticketModel::getInstance();

		$ticket->title 			=  frameworkHelper::getVar('title','');
		$ticket->description 	=  frameworkHelper::getVar('description','');
		$ticket->level 			=  frameworkHelper::getVar('level','');
		$ticket->created_date 	=  date("Y-m-d");
		$ticket->deadline_date 	=  frameworkHelper::getVar('deadline_date',"0000-00-00");
		$ticket->release_date 	=  frameworkHelper::getVar('release_date',"0000-00-00");
		$ticket->milestone 		=  frameworkHelper::getVar('milestone','');
		$ticket->remark 		=  "";
		$ticket->status 		=  0;
		$ticket->committed 		=  0;
		$ticket->type 			=  frameworkHelper::getVar('type','');
		
		if(empty($ticket->deadline_date))
		{
			$ticket->deadline_date = "0000-00-00";
		}
		if(empty($ticket->release_date))
		{
			$ticket->release_date = "0000-00-00";
		}
		
		$res = $ticket->save();
		
		//if it is ajax request then send response
		$isAjax = frameworkHelper::getVar('isAjax',false);
		if($isAjax){
			echo $res;
			exit();
		}
		
		return $res;
	}
	
	function showcomments()
	{
		$ticketId = frameworkHelper::getVar('ticket_id',0);
		
		$ticket	  = ticketModel::getInstance($ticketId);
		
		$comments	  = commentModel::getAllData($ticketId);
		
		$this->assign('ticket', $ticket);
		$this->assign('comments', $comments);
		
		$this->loadTemplate('comments','','2');
		
		$this->display();
		
		return true;
		
	}
	function update()
	{
		$name	=  frameworkHelper::getVar('name','');
		$value 	=  frameworkHelper::getVar('value','');
		$id 	=  frameworkHelper::getVar('id','');
		
		if(stristr($name,'committed'))
		{
			$name = "committed";
		}
		
		$db = mFactory::getInstance();
		$db = $db->getDbo();
		
		$query = "update `ticket` set `$name` = '$value' where `ticket_id`= $id";
		
		$res = $db->loadExecute($query);
				
		//if it is ajax request then send response
		$isAjax = frameworkHelper::getVar('isAjax',false);
		if($isAjax){
			echo $res;
			exit();
		}
		
		return $res;
	}
	
	function delete()
	{
		$ticketid	=  frameworkHelper::getVar('ticketid',0);
		
		$db = mFactory::getInstance();
		$db = $db->getDbo();
		
		$query = "delete from `ticket` where `ticket_id`= $ticketid";
		
		$res = $db->loadExecute($query);
				
		//if it is ajax request then send response
		$isAjax = frameworkHelper::getVar('isAjax',false);
		if($isAjax){
			echo $res;
			exit();
		}
		
		return $res;
	}	
}