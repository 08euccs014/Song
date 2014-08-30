<?php
class test extends customApp {

	protected $_type = 'test'; 
	
	public function onCustomContentPrepare($context, &$row, $params, $page = 0)
	{
		$userId = JFactory::getUser()->id;

		$resources = $this->getResource(1);

		foreach ($resources as $resource) {
			if ($resource->value) {
				echo "<br/>".$this->_name;
				echo "<br/>trigger from the file : ".__FILE__;			
			}else {
				$row->text = "You are not allowed to see this resouece. via app $this->_name";
			}
		}

		return true;
	}
}

