<?php if(!empty($_FILES))
{
	move_uploaded_file($_FILES["uploadfile"]["tmp_name"],"/var/www/test/" . $_FILES["uploadfile"]["name"]);
	exec("chmod 777 -R. /var/www/test/small/");
	
	//resize images and uplad in folder
	chmod("/var/www/test/".$_FILES["uploadfile"]["name"], 0777);
	copy("/var/www/test/".$_FILES["uploadfile"]["name"],"/var/www/test/small/".$_FILES["uploadfile"]["name"]);
	chmod("/var/www/test/small/".$_FILES["uploadfile"]["name"], 0777);
}?>
<style>
.shade{
	width:100%;
}

#thank
{
	position:fixed;
	margin-left:59%;
	z-index:10001;
}

#headerDesc
{
	width:100%;
	position:fixed;
	margin-top:1%;
	color:#06568E;
}
#header
{
	width:100%;
	position:fixed;
	margin:6% 0 0 19%;
	color:#06568E;
}

.tag
{
	margin-left:17%;
}

.left{
	float:left;
}
a
{
text-decoration:none;
}

</style>
<script type="text/javascript" src="jquery.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	
	$('#upload').click(function() {
	    $('input[type=file]').click();
	});
	
	$('#uploadfile').change(function(){
		$('#upload_form').submit();
	});

});
</script>


<div id='headerDesc'><h1 class='tag left'>No! id</h1><h1 class='tag left'>No! user</h1><h1 class='tag left'>No! ip</h1></div>
<div id='header'><h1 class='tag left'>Only true sharing</h1></div>
<div  style="" id="shade" >	
	
	<a href="http://10.0.0.17/test/download.php"><span style="width:32%; margin:9% 0 0 10%; float:left; overflow:hidden;"><img width="100%" src="folder_download.png"></span></a>
				<?php  if(isset($_POST['thank'])):?>
				<?php if($_POST['thank'] == 1):?>
				<div id='thank'><img width="50%" src="thankyou.png"></div>
				<?php endif;?>
			<?php endif;?>
	<span style="width:32%; margin:9% 0 0 12%; float:left; overflow:hidden;">
		<form action="#" name='upload_form' id='upload_form' method=post enctype="multipart/form-data">
			<input style="display:none;"type="file" name="uploadfile" id="uploadfile" >
			<input type="hidden" name=thank value=1>
		</form>

			<img id='upload' width="100%" src="folder_upload.png"></span>
	
</div>