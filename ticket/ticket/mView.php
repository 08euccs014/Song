<?php
class mView extends stdClass
{
	public function assign($variableName,$variable)
	{
		if(!empty($variableName))
		{
			$this->$variableName = $variable;
		}
		
	}	
	
	public function loadTemplate($layout = 'default',$path = null,$position=0)
	{
		if(empty($path) || $path == '')
		{
			$path  = (dirname(__FILE__)).'/template';
		}
		
		if(empty($layout) || $layout == '')
		{
			$layout = 'default';
		}
		
		$filename = $layout.'.php';
		
		ob_start();
		
		include($path.'/'.$filename);
		
		$output = ob_get_contents();
		ob_clean();
		
		$this->tmplToRenderWithPosition[$position] = $output;
	}
	
	public function render()
	{
		$path 			= (dirname(__FILE__));
		$tmplfile 		= 'template.php';
		$positionfile 	= 'position.xml';
		
		ob_start();
		
		include($path.'/'.$tmplfile);
		
		$output = ob_get_contents();
		ob_clean();
		
		$positions = $this->parseXML($positionfile,$path);
		
		foreach($positions as $position)
		{
			$pattern 	 = '[[POSITION::'.$position.']]';
			$replacement = $this->position($position);
			$output 	 = str_replace($pattern, $replacement,$output);
		}
		
		echo $output;
		
		return true;
	}
	
	public function position($position)
	{
		if(isset($this->tmplToRenderWithPosition[$position]))
			return $this->tmplToRenderWithPosition[$position];
		
		return '';
	}
	
	public function parseXML($file= null,$path = null)
	{
		$xml = simplexml_load_file($path.'/'.$file);
		//$positions = $this->objectsIntoArray($xml);
		
		$positions = array();
		
		if($xml->getName() == 'positions')
		{
			foreach ($xml->children() as $child)
			{
				if($child->getName() =='position')
				$positions[] = (string)$child;	
				
			}
		}
		
		return $positions;
	}
	
	function objectsIntoArray($arrObjData, $arrSkipIndices = array())
	{
	    $arrData = array();
	   
	    // if input is object, convert into array
	    if (is_object($arrObjData)) {
	        $arrObjData = get_object_vars($arrObjData);
	    }
	   
	    if (is_array($arrObjData)) {
	        foreach ($arrObjData as $index => $value) {
	            if (is_object($value) || is_array($value)) {
	                $value = $this->objectsIntoArray($value, $arrSkipIndices); // recursive call
	            }
	            if (in_array($index, $arrSkipIndices)) {
	                continue;
	            }
	            $arrData[$index] = $value;
	        }
	    }
	    return $arrData;
	}
	
}