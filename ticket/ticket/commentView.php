<?php
class commentView
{
	const increament = 10;
	
	function display()
	{
		return true;
	}
	
	function add()
	{
		
		$discussion_id 		= discussionHelper::getVar('discussion_id',0); 
		$comment 			= commentModel::getInstance();
		$comment->parent_id = $discussion_id;
		$comment->content 	=  discussionHelper::getVar('content','');
		
		$res = $comment->save();
		if($res)
		{
			$discussion = discussionModel::getInstance($discussion_id);
			$discussion->popular = $discussion->popular + self::increament;
			$discussion->save();
		}
		
		//if it is ajax request then send response
		$isAjax = discussionHelper::getVar('isAjax',false);
		if($isAjax){
			echo $res;
			exit();
		}
		
		if($res){
			return true;
		}
		
		return false;
	}
}