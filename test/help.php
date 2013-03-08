<html>

<head>
	<script type="text/javascript" src="jquery.js"></script>
	<script>
	function gohome()
	{
		window.location="http://10.0.0.17/test/download.php";
	}
	
	</script>
	<link type="text/css" rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
	<link href='http://fonts.googleapis.com/css?family=Grand+Hotel' rel='stylesheet' type='text/css'>
	<style type="text/css">
		.code{
			color:white;
			background-color:black;
			font-size:0.8em;
			line-height:1em;
			float:left;
			width:96%;
			padding:1% 0 1% 2%;
		}
		.newline{
			width:100%;
			margin:1% 0 1% 0%;
			float:left; 
		}
	</style>
</head>

<body style="font-size:1.5em; font-style:verdana;">
<div style='width:92%; padding:3% 4% 3%; float:left; background-color:#4FAAA5;'>
	<div style='width:100%; float:left;'>
	<span style='float:left; cursor:pointer;'onclick='gohome();' ><img src="hangout.png"></span>
	<span style="float:left; color:white; margin-left:3%;">
		<h1 >Hangout</h1>
		<span style="color:black" data-toggle="modal" data-target="#sharefolder" id=shareme onclick="sharefolder('<?php echo $foldername; ?>');">Share me</span>
	</span>

	</div>
</div>
<div style='width:99%; float:left; padding:4% 0 0 1%; line-height:2em;'>
Sharing is not working without FTP, because for sharing, uploading, downloading files from your system server needs to access your system via FTP.
<br>If you are think <span style="font-family: 'Grand Hotel', cursive; font-size:2em;">"it will do something to my system"</span> ! definetly not.<b> &nbsp;it's secure, unless you give access to anonymous.</b>
<br>I think here everyone is loaded with FTP server, but if not, just run the following command in terminal :<br>
<p>sudo apt-get install vsftpd</p>
<p>after runing this above command you need to go for some <b>security</b></p>
<p>change this following varibles in file <i>/etc/vsftpd.conf</i><br>
<span class="code"><br>
# Allow anonymous FTP?<br>
anonymous_enable=NO<br>
<br>
# Anonymous can use only<br>
anon_root=/home/home/Pictures<br>
<br>
# Uncomment this to allow local users to log in.<br>
local_enable=YES<br>
<br>
# Uncomment this to enable any form of FTP write command.<br>
write_enable=YES
</span>
<span class="newline">
after doing that create another user to whome you want to give access and restict him to use only limited part of your system. (use system usermanager)
then restart your ftp server with</span>> 
<span class="code"><br>
Restart :: <br>
sudo /etc/init.d/vsftpd restart<br>
<br>
Start ::<br> 
sudo /etc/init.d/vsftpd start<br>
<br>
Stop ::<br> 
sudo /etc/init.d/vsftpd stop<br>
<br>
</span>
</p>

<span class="newline">Please kindly refer to this link, if someone is not sure about it <a href="https://help.ubuntu.com/10.04/serverguide/ftp-server.html">https://help.ubuntu.com/10.04/serverguide/ftp-server.html</a></span>
      

</div>
</body>
</html>