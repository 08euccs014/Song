<html>
<head>
	<link type="text/css" rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
	<link type="text/css" rel="stylesheet" href="/bootstrap/responsive/css/bootstrap.min.css">
	<script type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/bootstrap/jquery.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		

		$("button").click(function(){
			var id = $(this).attr("id");
			var data = $("#filecontent").val();	
			
			var request = $.ajax({
			  url: "editor.php",
			  type: "POST",
			  data: {saveid : id,
				 savedata : data},
			  dataType: "html"
			});

			request.done(function(msg) {
				if(msg !="0"){
				  alert("Data added successfully !");
				}
				else{
				  alert("ERROR OCCURED !");
				}
			});

		});
		$('#element').tooltip('show');
	});

	
	</script>

</head>
<?php 
if(isset($_POST['savedata'])){
	$savedata = $_POST['savedata'];
	$saveid   = $_POST['saveid'];
	

	$res = file_put_contents($saveid, $savedata);
	
	echo $res;
	exit;
}

	if(isset($_POST['parent'])){
		$fileordir = $_POST['file'];
		$folder = $_POST['parent'];
		$file = $_POST['submit'];
		
		if($fileordir == 1)
		{	
			$content = file_get_contents($folder.'/'.$file);
			?>
			<form  method='post' action='editor.php' >
				<input class='btn' type=submit value="GO BACK" name='goback' />
				<input type=hidden value="<?php echo $folder; ?>" name='folder' />
			</form>
			<?php

			echo "<h1>$folder/$file</h1><br><br>";			
			?>
			
			<div><textarea id="filecontent"style="width:90%; height:80%; background:#F2F1F0;"><?php echo $content; ?></textarea><div>
			<div id="example" data-toggle="tooltip" title="first tooltip" style='margin-left:1%;'>
				<button class='btn btn-info' id="<?php echo $folder.'/'.$file; ?>" data-dismiss='alert' data-toggle='tooltip' >save</button>
			</div>
			<?php
			exit();
		}
	}


$parent = (isset($_POST['folder']))?$_POST['folder']:dirname(__FILE__);
$handle = scandir($parent);
$first =array(); 

foreach($handle as $file){
	$fileordir = 0;
	
	?>
			<span style="height:100px; width:100px;">
			<form  method='post' action='#' >
				<input class='btn' type=submit value="<?php echo $file; ?>" name='submit' />
				<?php if(!is_dir($file)){?>			
				<input type=hidden value="<?php echo $parent; ?>" name='parent' />
				<input type=hidden value="<?php echo $fileordir; ?>" name='file' />
				<?php
				}
				else{ ?>
					<input type=hidden value="<?php echo $parent.'/'.$file; ?>" name='folder' />
				<?php } ?>
			</form>
			</span>
	<?php	
}
?>

