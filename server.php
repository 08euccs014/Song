<html>
<head>
	<link type="text/css" rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
	<link type="text/css" rel="stylesheet" href="/bootstrap/responsive/css/bootstrap.min.css">
	<script type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/bootstrap/jquery.js"></script>
</head>
<body>


<ul class="thumbnails">

<?php 
$parent = 'Music/Bollywood';
$backlink = $parent;

if(isset($_POST['folder']))
	$parent = $_POST['folder'];

if(isset($_POST['file']))
	changeTheMusic($parent,$_POST['file']);


$handle = scandir($parent);
$first =array(); 
?>


			<li class="span4">
			<div class="thumbnail">
			<div class="span6">
			<form  method='post' action='#' >
			
					<input type="image" src="folder-color.png" alt="folder" />
					<input type=hidden value="<?php echo $backlink; ?>" name='folder' />
			
					<input type=hidden value="<?php echo $backlink; ?>" name='backlink' />
			</form>
			</div>
			<h5 class="span6" style="word-wrap: break-word;">	GO Back</h3>
			</div>
			</li>

<?php

unset($handle[0]);
unset($handle[1]);

foreach($handle as $file){
	$fileordir = 0;
	
?>
			<li class="span2" style="height:200px;">
				<div class="thumbnail row-fluid">
					<div class="span12">
						<form  method='post' action='#' >
							<?php if(is_file($parent.'/'.$file)): ?>	
								<input type="image" height="50px" src="file_music.png" alt="file" />						
								<input type=hidden value="<?php echo $parent; ?>" 	 name='folder' />
								<input type=hidden value="<?php echo $file; ?>" 	 name='file' />
							<?php endif; ?>
							<?php if(is_dir($parent.'/'.$file)): ?>
								<input type="image"  height="50px" src="folder-color.png" alt="folder" />
								<input type=hidden value="<?php echo $parent.'/'.$file; ?>" name='folder' />
							<?php endif; ?>
								<input type=hidden value="<?php echo $backlink; ?>" name='backlink' />
							<h5 style="width:100%; word-wrap: break-word;"><?php echo $file; ?></h5>
						</form>

					</div>

				</div>
			</li>
			
	<?php	
}


function changeTheMusic($folder , $file)
{
	//$folder = str_replace('music/Bollywood','Music/Bollywood',$folder);
	$file	= compatibleFileName($file);
	$folder	= compatibleFileName($folder);
	
	//$cmd = "sudo -u mohit -p5 rm /var/www/y.mp3";
	//$cmd = "sudo -u mohit -p5 rm /var/www/x.mp3";
	//echo exec($cmd);
	if(file_exists('x.mp3'))
	unlink('x.mp3');

	if(!file_exists('x.mp3'))
	{
		$cmd = "smbget -a -n --outputfile=/var/www/x.mp3 smb://server-desktop/rbsl-server/".$folder."/".$file;
		system($cmd);
		
		//$cmd = "bash changesong.sh";
		//system($cmd);
	}
	//$cmd = "sudo -u mohit -p5 cp /var/www/y.mp3 /var/www/x.mp3";
	//system($cmd);
	return true;
}

function compatibleFileName($filename)
{
	$filename	= str_replace(' ','%20',$filename);
	$filename	= str_replace('(','\(',$filename);
	$filename	= str_replace(')','\)',$filename);

	return $filename;
}


?>
</ul>
</body>
