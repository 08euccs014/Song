<?php 

		function isfile($file){
		    return preg_match('/^[^.^:^?^\-][^:^?]*\.(?i)' . getexts() . '$/',$file);
		}
		
		function getexts(){
		    //list acceptable file extensions here
		    return '(js|css)';
		}

		$path = 'media/js';
		$filehadler = scandir($path);
	
		if(isset($filehadler)):
		foreach ($filehadler as $file):
		if(isfile($file)):
?>
		<script type="text/javascript" src="<?php echo $path.'/'.$file;?>"></script>
<?php 	endif;
		endforeach;
		endif;

		
		$path = 'media/css';
		$filehadler = scandir($path);
	
		if(isset($filehadler)):
		foreach ($filehadler as $file):
		if(isfile($file)):
?>
		<head><link type="text/css" rel="stylesheet" href="<?php echo $path.'/'.$file;?>"></head>
<?php 	endif;
		endforeach;
		endif;
