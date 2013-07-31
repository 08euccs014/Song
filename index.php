<html>
<head>
<!--	<link href='http://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'>-->
	<link type="text/css" rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
	<link type="text/css" rel="stylesheet" href="/bootstrap/responsive/css/bootstrap.min.css">
	<script type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/bootstrap/jquery.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		

		$("button").click(function(){
			var id = $(this).attr("id");
			var data = $("."+id).val();	
			
			var request = $.ajax({
			  url: "save.php",
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

	});

	
	</script>
	<style>
		[class*="span"] {
			margin-left: 0px !important;
		}
	</style>

</head>
<?php 

	if(isset($_SERVER['HTTP_HOST']))
	{
		$serverUrl = $_SERVER['HTTP_HOST'];
	}
	if(isset($_GET['unlock'])){
		$unlock = $_GET['unlock'];
		$file = "/var/www/".$_GET['file'];
		if($unlock == 1)
		{	
			exec ("chmod 777 -R . ".$file);			
		}
	}

	if(isset($_GET['delete'])){
		$delete = $_GET['delete'];
		$file = "/var/www/".$_GET['file'];
		if($delete == 1)
		{	
			exec ("chmod 777 -R ".$file);		
			exec ("rm -r $file");
			exec ("mysqladmin -u root -ppassword drop -f {$_GET['file']}");
			header("Location: http://{$serverUrl}/index.php");
		}
	}
	
?>
<body style="font-size:1.5em; font-family: 'Fjalla One', sans-serif;">
<div class="visible-desktop">
	<div style='width:10%; text-align:center; float:left; margin-top:1%;'>PROJECT NAME</div>
	<div style='width:80%; text-align:center; float:left; margin-top:1%;'>UTILIZATION</div>
	<div style='width:10%; float:right; margin-top:1%;'><a href="http://<?php echo $serverUrl.'/editor.php'; ?>">My Editor</div>
</div>
<div class="visible-tablet">
	<div style='width:50%; text-align:center; float:left; margin-top:1%;'>PROJECT NAME</div>
	<div style='width:40%; text-align:center; float:left; margin-top:1%;'>UTILIZATION</div>
	<div style='width:10%; float:right; margin-top:1%;'><a href="http://<?php echo $serverUrl.'/editor.php'; ?>">My Editor</div>
</div>
<div class="visible-phone">
	<div style='width:50%; text-align:center; float:left; margin-top:1%;'>LOCALHOST UTILITY</div>
	<div style='width:50%; float:right; margin-top:1%;'><a href="http://<?php echo $serverUrl.'/editor.php'; ?>">My Editor</div>
</div>
<br><br><br><br>
<div class="container-fluid">
<?php

$handle = scandir(dirname(__FILE__));
$first =array(); 

foreach($handle as $file){

	if(is_dir($file)){
		if(stristr($file,'payplans')){
?>

	<div class="row-fluid">
		<div id=project class="span2">
			<a href='http://<?php echo $serverUrl.'/'.$file; ?>'><?php echo $file; ?></a>
		</div>		

		<div class="span1">
			<a class="text-warning" href="http://<?php echo $serverUrl.'/'.$file; ?>/administrator/index.php">admin</a>
		</div>
		
		<div class="span1">
			<a class="muted" href='http://<?php echo $serverUrl; ?>/index.php?unlock=1&file=<?php echo $file; ?>'>unlock</a>
		</div>

		<div class="span1">
			<a class="text-error" href='http://<?php echo $serverUrl; ?>/index.php?delete=1&file=<?php echo $file; ?>'>Delete</a>
		</div>

		<?php	$filecontent = file_get_contents(dirname(__FILE__)."/".$file."/README.txt",'r'); ?>
		<div class="span5">
			<span><textarea class=<?php echo $file; ?> style='width:28%; height:16%'><?php echo $filecontent; ?></textarea></span>
			<span id="example" data-toggle="tooltip" title="first tooltip" style='margin-left:1%;'>
				<button class='btn btn-info' id=<?php echo $file; ?> data-dismiss='alert' data-toggle='tooltip' >save</button>
			</span>
		</div>
		<div class="span2">
			<?php echo date("d, F Y", filemtime(dirname(__FILE__)."/".$file)); ?>
		</div>
	</div>
<?php		
		}
	}
}

?>
</div>
</body>
</html>

