<?php
if(isset($_SERVER['HTTP_HOST'])){
	$root_url = $_SERVER['HTTP_HOST']; //10.0.0.17 ip
	$current_url = $_SERVER['REQUEST_URI']; //test/downlaod
	$complete_url = 'http://'.$root_url.'/'.$current_url;
}

if(isset($_GET['file']))
{
	$file = $_GET['file'];

    header('Content-Description: File Transfer');
    header('Content-Type: application/jpg');
    header('Content-Disposition: attachment; filename='.basename($file));
    ob_clean();
    flush();
	echo file_get_contents($file);
    exit;
}

if(!empty($_FILES))
{
	move_uploaded_file($_FILES["uploadfile"]["tmp_name"],"/var/www/test/upload/" . $_FILES["uploadfile"]["name"]);
	exec("chmod 777 -R. /var/www/test/upload/");
	
	//resize images and uplad in folder
	chmod("/var/www/test/upload/".$_FILES["uploadfile"]["name"], 0777);
//	copy("/var/www/test/".$_FILES["uploadfile"]["name"],"/var/www/test/upload/".$_FILES["uploadfile"]["name"]);
//	chmod("/var/www/test/small/".$_FILES["uploadfile"]["name"], 0777);
}

if(isset($_POST['folder']))
{
	$foldername = $_POST['folder'];	
}

if(isset($_POST['sharing']) && $_POST['sharing']==true)
{
	$ftpusername = $_POST['ftpusername']; 
	$ftppassword = $_POST['ftppassword']; 
	$ipaddress	 = $_POST['ipaddress']; 
	$sharedfoldername = $_POST['sharedfolder']; 
	echo sharefolder($ftpusername,$ftppassword,$ipaddress,$sharedfoldername);
	exit();
}

if(isset($_POST['ip']))
{
	session_start();
	$_SESSION['ip'] = $_POST['ip'];	
	$ip = $_POST['ip'];	
}elseif(isset($_SESSION['ip']))
{
	$ip = $_SESSION['ip'];
}


if(isset($_GET['playing']))
{
	$fileWithUrl = $_GET['filename'];
	$reqipaddres = $_GET['ipaddress'];
	
	$reqftpusers = file_get_contents('ftpusers.json');
	$reqftpusers = json_decode($reqftpusers);
	$reqftpusername = $reqftpusers->$reqipaddres->username; 
	$reqftppassword = $reqftpusers->$reqipaddres->password; 
	
	$ftpConn  = ftp_connect($reqipaddres);
	ftp_login($ftpConn,$reqftpusername,$reqftppassword);
	$x = ftp_get($ftpConn,'temp.mp3',$fileWithUrl, FTP_BINARY);
	
	//chmod('/var/www/test/temp.mp3', 0777);

    header('Content-Description: File Transfer');
    header('Content-Type: application/mp3');
    header('Content-Disposition: attachment; filename='.basename('/var/www/test/temp.mp3'));
    ob_clean();
    flush();
	echo file_get_contents('/var/www/test/temp.mp3');
    exit;
}
?>
	
<html>

<head>
	<script type="text/javascript" src="jquery.js"></script>
	<link type="text/css" rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="bootstrap/jquery.lazyload.js"></script>
	<script type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript">

	function upload()
	{
		$('#upload_form').submit();	
	}

	$(document).ready(function(){

		$('#second').hide();
		$("img.lazy").lazyload();
		var counter = 1;
		//function ality to add data
		$("#add").live("click",function(){

			var data = $(this).parent().parent().parent().html();
			var inputid = $(this).parent().parent().children('div:first').children('input:first').attr('name');
			var inputid = $(this).parent().parent().children('div:first').children('input:first').attr('name',inputid+counter);
			counter++;
			data = "<div id='tmpl'>"+data+"</div>";
			$(this).parent().remove();
			$('#container').append(data);

		});


		//functionality to remove data
		$(".remove").live("click",function(){

//			var res=confirm("Are you want to delete it!");
//			if (res==true)
//			{
			 $(this).parent().parent().parent().remove();
//			}
		});

	});

	function sharefolder(pathname)
	{
		var ftpusername = $('#ftpusername').val();
		var ipaddress	= $('#ipaddress').val();
		var ftppassword = $('#ftppassword').val();
		var sharedfolder  = $('#sharedfolder').val();


		if( ipaddress == ''){
			$('#ipaddress').css('background-color','#AF0017');
			return false;
		}
		if( ftpusername == ''){
			$('#ftpusername').css('background-color','#AF0017');
			return false;
		} 
		if( ftppassword == ''){
			$('#ftppassword').css('background-color','#AF0017');
			return false;	
		}
		if( sharedfolder == ''){
			$('#sharedfolder').css('background-color','#AF0017');
			return false;
		}

		
		var request = $.ajax({
		  url: "<?php echo $complete_url; ?>",
		  type: "POST",
		  data: {sharing : true,
			  	 ftpusername : ftpusername,
			  	 ftppassword : ftppassword,
			  	 sharedfolder  : sharedfolder,
			  	 ipaddress	 : ipaddress
				},
		  dataType: "html"
		});

		request.done(function(msg) {
			if(msg == true){
				msg = "<div>Thank for sharing ! :)</div>";
			}else{
				msg = "<div>Sorry :( ! some error happend</div>";
			}
			$('#sharefolder #modal-body').html(msg);
		});
	}

	function formsubmit(id,folder)
	{
		id = "#"+id;
		$('#folder').val(folder);
		$(id).submit();		
	}

	function filedownload()
	{
		var filewithurl = $('#downloadbutton').attr('name');
		var htmldata 	= "<iframe id='uselessframe' src='http://10.0.0.17/test/index.php?file="+filewithurl+"'></iframe>";
		$('#modal-body').append(htmldata);
		setTimeout(function() {
			$('#uselessframe').remove();
		}, 100);
		
	}
	
	function anyfiledownload(ip,file)
	{		
//		var completeurl = "ftp://"+ip+"/../../../.."+file;
//		var request = $.ajax({
//			  url: "<?php echo $complete_url; ?>",
//			  type: "GET",
//			  data: {playing : true,
//				  	 filename : file,
//				  	 ipaddress : ip
//					},
//			  dataType: "html"
//		});	

		var fileurl = 'http://10.0.0.17/test/index.php?playing=true&ipaddress='+ip+'&filename='+file;
		//$('#myMusicModal').modal('show');
		$('#musiciframe').attr('src',fileurl);
		//var filewithurl = $('#musiciframe').attr('src','http://10.0.0.17/test/index.php?file=temp.mp3');
//		var htmldata 	= "<iframe id='uselessframe' src='http://10.0.0.17/test/index.php?file="+filewithurl+"'></iframe>";
//		alert(htmldata);
//		$(document).append(htmldata);
	}
	function filesettoview(file)
	{
		$('#uselessimage').attr('src',file);
		$('#downloadbutton').attr('name',file);
	}

	function gohome()
	{
		window.location="http://10.0.0.17/test/index.php";
	}

	function gohelp()
	{
		window.location="http://10.0.0.17/test/help.php";
	}

	function goback()
	{
		window.location="http://10.0.0.17/test/index.php";
	}

	function gosuggestion()
	{
		$('#suggestion').hide();
		$('#first').css('width','70%');
		$('#second').show();
	}

	function hidesuggestion()
	{
		$('#suggestion').show();
		$('#first').css('width','100%');
		$('#second').hide();
	}
	
	</script>
	<style>
	
	#shade {
	
	width:18%; 
	//height:100%;
	padding:5px; 
	float:left;
	//overflow:hidden;
	margin-left:20px;
	
	}
	
	#shade a{
		text-decoration:none;
		color:#3A3A47;
	}
	
	#dshade:hover {
	box-shadow: 10px 10px 5px #888;overflow:hidden;
	width:18.2%; padding:1px; float:left;
	}
	
	
	.left
	{
		float:left;
	}
	
	.cust_button
	{
	float:left;
	margin-top:1px;
	}
	.cust_row
	{
	clear:both;
	float:left;
	margin-top:5px;
	}
	#container{
		float:left;
		width:80%;
	}
	#upload{
		float:left;
		width:20%;
	}
	
	.grid_100
	{
		width:100%;
	}
	.control-group
	{
		float:left;
		overflow:hidden;
		width:100%;
	}
	.control-input
	{
		float:left;
		width:47%;
		height:35px !important;
	}
	.control-label
	{
		float:left;
		width:17%;
		padding:8px;
	}
	#shareme
	{
		cursor:pointer;
	}
	#shareme:hover
	{
		font-size:1.7em;
        text-shadow: -4px 3px 2px #838383;
		cursor:pointer;
	}
	
	#helpme
	{
		position:fixed;
		margin: -2% 0 0 89%;
		cursor:pointer;
	}	
	
	#suggestion
	{
		position:fixed;
		margin:20% 0 0 94%;
		cursor:pointer;
	}
	
	#suggestion:hover
	{
		position:fixed;
		margin:20% 0 0 89%;
		cursor:pointer;
	}
	.comment-input
	{
		float:left;
		width:98%;
		height:48px !important;
	}
	.comment-group
	{
		float:left;
		overflow:hidden;
		width:100%;
		margin-top:15px;
	}

	</style>
</head>

<body style="font-size:1.5em; font-style:verdana;">
<!-- -share me popup -->

<div id="sharefolder" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="shareFolderLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
<h3 id="shareFolderLabel">Enter your details</h3>
</div>
<div class="modal-body" id="modal-body">

	    <div class="control-group">
	   		<label class="control-label" for="ipaddress">IP Address</label>
		  	<input class="control-input"  type="text" id="ipaddress" placeholder="IP-Address">
	    </div>
	    <div class="control-group">
		    <label class="control-label" for="ftpuser">Username</label>
		    <input class="control-input"  type="text" id="ftpusername" placeholder="Username">
	    </div>
	    <div class="control-group">
		    <label class="control-label" for="ftppassword">Password</label>
		    <input class="control-input" type="password" id="ftppassword" placeholder="Password">
	    </div>
	   	<div class="control-group">
		    <label class="control-label" for="sharedfoldere">Shared Folder</label>
		    <input class="control-input" type="text" id="sharedfolder" placeholder="foldername">
	    </div>

</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Cancle</button>
<button class="btn btn-primary" onclick="sharefolder();">Share</button>
</div>
</div>
<!-- -favaroite colors (pink)#FF0057 (mera shirt)#017890  
#4FAAA5
#4ECDC4


-->
<div style='width:92%; padding:3% 4% 3%; float:left; background-color:#4FAAA5;'>
	<div style='width:100%; float:left;'>
	<span style='float:left; cursor:pointer;'onclick='gohome();' ><img src="hangout.png"></span>
	<span style="float:left; color:white; margin-left:3%;">
		<h1 >Hangout</h1>
		<span style="color:black" data-toggle="modal" data-target="#sharefolder" id=shareme onclick="sharefolder('<?php echo $foldername; ?>');">Share me</span>
	</span>
	<span style='width:8%; float:right;' onclick='goback();'><img src="goback.png"></span>
<!--	<span style='width:8%; float:right;'><img src="home.png"></span>-->
	</div>
	<div id="helpme" onclick='gohelp();' ><b>HELP ME</b></div>
	<div id="suggestion" onclick='gosuggestion();'><img src="play.png"></div>
</div>


<div  id="first" onclick="hidesuggestion();" style="width:100%; float:left; padding-top:4%;">

<?php

$ftpusers = file_get_contents('ftpusers.json');
if(empty($ftpusers)){
	echo "<div style='width:80%; margin:4%; float:left; '><h1>Sorry :( No folder is shared !</h1></div>";
	exit();
}
$ftpusers = json_decode($ftpusers);

//first time page open show shared folder list
if(!isset($ip)):
	foreach ($ftpusers as $ip_address => $ftpuser):
		foreach ($ftpuser->folder as $folder):
		?>
		<div  id="shade" >	
		<form action='http://10.0.0.17/test/index.php' method='post' id='requestfolder'>
			<input type='hidden' name=ip value=<?php echo $ip_address;?>>
			<input type='hidden' id=folder name=folder value=folder>
			<span style="width:100%; height:20%; float:left; overflow:hidden; text-align:center">
				<span class="left grid_100"  onclick="formsubmit('requestfolder','<?php echo $folder;?>');"><img height="100%" src="folder.png"></span>
				<span class="left grid_100"><?php echo strrev(strtok(strrev($folder),'/'));?></span>
			</span>	
		</form>
		</div>

		<?php 
		endforeach;
	endforeach;
//if not then full fill the ip and folder request
else:

	$ftpConn  = ftp_connect($ip);
	if($ftpConn):
		$ftpuser = $ftpusers->$ip;
		ftp_login($ftpConn,$ftpuser->username,$ftpuser->password);
		
		$foldername = (isset($foldername))?$foldername : array_pop($ftpuser->folder);
		$handle = ftp_nlist($ftpConn,$foldername);
	echo "<div style='width:100%; float:left;'><form action='http://10.0.0.17/test/index.php' method='post' id='requestfolder'><input type='hidden' name=ip value= $ip><input type='hidden' id=folder name=folder value=folder>";
			
	
	foreach($handle as $file):
	
	if(!is_file($file)){
		
		if($file == '.' || $file == '..')continue;
		if(isfile($file)):
		?>
		
			<div  id="shade" >
				<a href="#myMusicModal" role="button" data-toggle="modal" onclick="anyfiledownload('<?php echo $ip;?>','<?php echo $file;?>');">
					<span style="width:100%; float:left; margin:10px;text-align:center">
						<span class="left grid_100" style="margin-top:35px;" ><img  src="music.png"></span>
						<span class="left grid_100"  style="margin-top:30px;" ><?php echo strrev(strtok(strrev($file),'/'));?></span>
					</span>
				</a>
			</div>
		
		<?php 
		continue;
		endif;
		?>
		<div  id="shade" >	
			<span style="width:100%; height:20%; float:left; overflow:hidden; text-align:center">
				<span class="left grid_100" onclick="formsubmit('requestfolder','<?php echo $file;?>');"><img  src="folder.png"></span>
				<span class="left grid_100"><?php echo strrev(strtok(strrev($file),'/'));?></span>
			</span>	
		</div>
		<?php 
		continue;
	}
	
	 $file = 'http://'.$ip.str_replace('/var/www','',$file);
	 $extension = strrev(strtok(strrev($file),'.'));
	
	 if($extension != 'jpg' && $extension != 'png'  && $extension != 'jpeg' && $extension != 'gif'){continue;}
	?>
		<div  id="shade" >	
		<a href="#myModal" role="button" data-toggle="modal" onclick="filesettoview('<?php echo $file;?>');">
			<span style="width:80%; float:left; overflow:hidden;">
				<img class="lazy" style="width:100%; height:20%;" alt="why this kolaveri !" src="pixel.png" data-original="<?php echo $file;?>">
			</span>
			<span style="width:16%; float:left; overflow:hidden; margin-top:2.8em; padding-left:10px;"><img style="width:80%; height:5%;"  src="<?php echo 'download.png';?>"></span>
		</a>
		</div>
	
	<?php 
	endforeach;
	echo "</form></div>";
	endif;
	ftp_close($ftpConn);
endif;
?>
</div>

<div id="second" style="width:29%; float:left; padding-top:5%;">
<?php include_once 'advice.php';?>
</div>
</body>
</html>

<?php 
 $prevTraced = file_get_contents('tracking.txt');
 $obj = json_decode($prevTraced);
 $obj->views++;
 file_put_contents('tracking.txt',json_encode($obj));
 
 function isfile($file){
    return preg_match('/^[^.^:^?^\-][^:^?]*\.(?i)' . getexts() . '$/',$file);
}

function getexts(){
    //list acceptable file extensions here
    return '(app|avi|doc|docx|exe|ico|mid|midi|mov|mp3|mp4|
                 mpg|mpeg|pdf|psd|qt|ra|ram|rm|rtf|txt|wav|word|xls)';
}
 
 
 function sharefolder($ftpusername,$ftppassword,$ipaddress,$sharedfoldername)
 {
	$newentry =  array('username' => $ftpusername, 'password' =>$ftppassword, 'folder'=>array($sharedfoldername));
	
	$ftpusers = file_get_contents('ftpusers.json');

	$ftpusers = json_decode($ftpusers,true);
	
	//if user already exist then add another folder ot it's list else add new entry
	if(isset($ftpusers[$ipaddress])){
		$ftpusers[$ipaddress]['folder'][] = $sharedfoldername;
	}else{
		$ftpusers[$ipaddress] = $newentry;
	}
	
	$ftpusers = json_encode($ftpusers);
	
	if(file_put_contents('ftpusers.json',$ftpusers))
	{
		return true;
	}
 	return false;
 }

?>

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
<h3 id="myModalLabel">Download ... :)</h3>
</div>
<div class="modal-body" id="modal-body">
<img id="uselessimage" alt="why this kolaveri !" src="http://10.0.0.17/test/409868_rendering_shary_podsvetka_1920x1200_www.GdeFon.ru_.jpg">
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
<button id="downloadbutton" name="dummy" class="btn btn-primary" onclick='filedownload();'>Download</button>
</div>
</div>


<!-- Music Modal -->
<iframe style='display:none' id="musiciframe" src=""></iframe>