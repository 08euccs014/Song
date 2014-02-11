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

<!DOCTYPE html>
<html lang="en" ng-app>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/bootstrap3/assets/ico/favicon.png">

    <title>Agrawal's Localend (<?php echo $_SERVER['SERVER_ADDR']; ?>)</title>

    <!-- Bootstrap core CSS -->
    <link href="/bootstrap3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="justified-nav.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container"  data-ng-controller="simplecontroller">

      <div class="masthead">
        <ul class="nav nav-justified">
          <li class="active"><a href="#">Localhost Utility</a></li>
          <li><a href="http://<?php echo $serverUrl.'/myissue.php'; ?>">My Issue</a></li>
            <li><a href="http://<?php echo $serverUrl.'/editor.php'; ?>">My Editor</a></li>
          <li><a href="#">empty</a></li>
          <li><a href="#">empty</a></li>
        </ul>
      </div>
    
<!--     <h1 class="text-center">Localhost Utility</h1> 
	<div class="text-right"><a href="http://<?php //echo $serverUrl.'/editor.php'; ?>">My Editor</a></div> -->
      
	<br />
	<br />
	<br />
  
	<!-- Searching Box -->			
      
    <div class="col-md-6 col-md-offset-3">
	    <input id="searchbox" type="text" class="form-control" style="height:46px;" data-ng-model="searchtext">
    </div>

	<br />&nbsp;<br /><br /><hr />
	
	
      <!-- Example row of columns -->
	<div class="row" data-ng-repeat="folder in folders | filter:searchtext ">
		<div class="col-lg-3">
		  <h3><a target="_blank" href="{{ folder.frontEndLink }}">{{ folder.name}}</a></h3>
		  <a target="_blank" href="{{ folder.backEndLink }}">administrator</a>
		</div>
		<div class="col-lg-5">
			<textarea class="{{ folder.name }} form-control" rows="3">{{ folder.data }}</textarea>
		</div>
		<div class="col-lg-4" style="padding:25px;">
			<button id="{{ folder.name }}" class="btn btn-primary" >Save &raquo;</button>
			<a class="btn btn-danger" href="#">Delete</a>
			<a class="btn btn-warning" href="#">unlock</a>
		</div>
		<br /><br />
		<br /><br /><hr />
	</div>

      <!-- Site footer -->
      <div class="footer">
        <p>&copy; Mohit Agrawal 2013</p>
      </div>
      <div id="log"></div>
    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
<?php

$handle = scandir(dirname(__FILE__));
$folder = array(); 

foreach($handle as $file){

	if(is_dir($file)){
		if(stristr($file,'payplans') || stristr($file,'xius')){
			$folder[] = array(
								 'name'=>$file
								,'frontEndLink' => "http://{$serverUrl}/{$file}"
								,'backEndLink'	=> "http://{$serverUrl}/{$file}/administrator/index.php"
								,'unlockLink'	=> "http://{$serverUrl}/index.php?unlock=1&file={$file}"
								,'deleteLink'	=> "http://{$serverUrl}/index.php?delete=1&file={$file}"
								,'data'			=>	file_get_contents(dirname(__FILE__)."/".$file."/README.txt",'r')	
						); 		
		}
	}
}

//$recentLinks 	= file_get_contents('my.cache','r');
//$recentLinks 	= explode("\n",$recentLinks);
//$recentLinks 	= array_reverse($recentLinks, true);

//for($i = 0 ; $i < 10 ; $i++){
	//echo "<h3><a href=".$recentLinks[$i].">".$recentLinks[$i]."</a><h3>";
//}

?>

	<script src="/bootstrap3/assets/js/jquery.js" type="text/javascript"></script>
    <script src="angular/angular.js" type="text/javascript"></script>
	<script>
	function simplecontroller($scope)
	{
		$scope.folders = <?php echo json_encode($folder);?>
	}

	$(document).ready(function(){

		$("#searchbox").focus();

		$( "body" ).click(function( event ) {
			var target = $(event.target);
			if(target.is("a")) {
				$.ajax({
					  url: "save.php",
					  type: "POST",
					  data: {	
						  		savedata 	: target.attr('href')+"\n",
						 		saveToFile 	: 'my.cache',
							 	saveAppend 	: true
						 	},
					  dataType: "html"
				});
			}
			
		});

		
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
  </body>
</html>


