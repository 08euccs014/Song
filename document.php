<html>
<head>
<!--	<link href='http://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'>-->
	<link type="text/css" rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
	<link type="text/css" rel="stylesheet" href="/bootstrap/responsive/css/bootstrap.min.css">
	<link type="text/css" rel="stylesheet" href="http://d30vaec067st28.cloudfront.net/templates/strapped/css/docs.css">
	<link type="text/css" rel="stylesheet" href="jppstyle.css">
	<script type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>


	<script type="text/javascript" src="/bootstrap/jquery.js"></script>
	<script type="text/javascript" src="jquery.zclip.js"></script>
	<script type="text/javascript">
		function createTitle()
		{
			$('#doc_title h1').html($("#title").val());
			$('#doc_title p').html($("#sub_title").val());
			$("#result").text($("#result").text()+$('#doc_title').html());
		}
	
		function createImage() {
	
			$('#doc_img img').attr('title',$("#img_title").val());
			$('#doc_img img').attr('src',$("#img_src").val());
			
			var alternatetext = $("#img_alt").val();
			
			if(alternatetext == '')
			{ 
				alternatetext = $("#img_caption").val();	
			}
		
			var caption = $("#img_caption").val();
			
			if(caption == '')
			{ 
				caption = $("#img_alt").val();	
			}
			
			$('#doc_img img').attr('alt',alternatetext);
						
			$('#doc_img figcaption').html(caption);
			
			$("#result").text($("#result").text()+$('#doc_img').html());
		}
		
		function update()
		{
			$("#html_document").html($("#final_document").val());	
		}

		function savefile(data)
		{
			var request = $.ajax({
			  url: "save.php",
			  type: "POST",
			  data: {saveid : 'documentation',
				 savedata : data},
			  dataType: "html"
			});

		}

		$(document).ready(function(){
			setInterval(function(){
				var data = $("#final_document").val()
				$("#html_document").html(data);	
				if(data != '')
					savefile(data);
			},1000);
		});
		
	</script>

<style type="text/css">
	#result {
		height : 200px;	
	}
	#final_document {
		height : 300px;	
	}
	.height_3 {
		height : 300px;	
	}

</style>
</head>

<div class="row-fluid">

<div class="form-inline">
<fieldset class="span6">
	<legend>Insert Title</legend>
	<div class="span12"><label class="span6">Enter document title:</label><input type="text" name="title" id="title"/></div>
	<div class="span12"><label class="span6">Enter document sub-title: </label><input type="text" name="sub_title" id="sub_title"/></div>
	<button onclick="createTitle();">Insert Title</button>
</fieldset>

<fieldset class="span6">
	<legend>Insert Image</legend>
	<div class="span12"><label class="span6">Title : </label><input type="text" name="img_title" id="img_title" /></div>
	<div class="span12"><label class="span6">Alternate text : </label><input type="text" name="img_alt" id="img_alt" /></div>
	<div class="span12"><label class="span6">Source : </label><input type="text" name="img_src" id="img_src" /></div>
	<div class="span12"><label class="span6">Caption: </label><input type="text" name="img_caption" id="img_caption" /></div>
	
	<button onclick="createImage();">Insert Image</button>
</fieldset>
</div>


<div id="doc_img" class="hide">
	<figure>
		<img title="untitled" alt="untitled" src="untitled.png">
		<figcaption class="img-caption"></figcaption>
	</figure>
</div>

<div id="doc_title" class="hide">
	<header>
	    <h1 role="title"></h1>
	    <p></p>
	</header>
</div>

<fieldset class="span12">
	<legend>Copy this html to document <button id="update_button" onclick="update();" >update</button></legend>
	<textarea id="result" class="span12"></textarea>
</fieldset>
<fieldset class="height_3 span5">
	<legend>Final Document</legend>
	<textarea id="final_document" class="span12">
		<?php echo file_get_contents("documentation/README.txt"); ?>
	</textarea>
</fieldset>
<fieldset class="height_3 span6">
	<legend>HTML Document</legend>
	<div class="span12">
		<section id="jpp-doc">
    	<div class="row" id="html_document" contenteditable>
    	</div>
    	</section>	
	</div>
</fieldset>
</div>
</html>
