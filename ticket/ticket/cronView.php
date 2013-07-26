<?php
class cronView extends mView
{
	const decreament = 10;

	function trigger()
	{
		//need an entry in cron log file 
		$content = file_get_contents('log');
		if(empty($content) || $content != false)
		{
			$content = $content.time()."\n";
			file_put_contents('log', $content);
		}
		
		$records = discussionModel::getAllData();

		if(!empty($records))
		{
			foreach ($records as $record)
			{
				if($record->popular > 0)
				{
					$record->popular = $record->popular - self::decreament;
					$record->save();  	
				}
				else
				{
					$record->deleteDiscussion();
				}
			}
			return true;
		}
		return false;
	}
	
	
	
	
}