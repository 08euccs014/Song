<?php
class test extends customApp {

	protected $_type = 'test'; 
	
	public function onCustomContentPrepare($context, &$row, $params, $page = 0)
	{
		$userId = JFactory::getUser()->id;

		//if nothing there is no app instances is created then just do nothing
		$allAppInstances = $this->getAllInstances();
		
		if(empty($allAppInstances) )
		{
			return true;
		}
		
		$results = array();
		
		foreach ($allAppInstances as $instnace) {
			
			$resources = $instnace->getResource($userId);
			
			foreach ($resources as $resource) {
				
				if ($resource->value == 1) {
					$results[$instnace->_id] = true;
				}else {
					$results[$instnace->_id] = false;
				}
			}
			
		}
		
		if(in_array(false, $results)) {
			$row->text = "You are not allowed to see this resouece.";
		}
		else {
			echo "<br/>trigger from the app.";
		}

		return true;
	}
}

