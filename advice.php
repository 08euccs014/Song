<?php 

if(isset($_POST['commenting']))
{
	$comment = $_POST['comment'];
	addcomment($comment);
	
	exit();
}

?>
<html>
<head>
	<script type="text/javascript" src="jquery.js"></script>
	<link type="text/css" rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="bootstrap/jquery.lazyload.js"></script>
	<script type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript">

	$(document).ready(function(){

		$("#comment").keypress(function(event){
			if(event.which == 13){
				var comment = $(this).val();
				$.ajax({
					  url	: "#",
					  type	: "POST",
					  data	: {commenting	 : true,
						  	 	comment	 : comment
							   },
					  dataType: "html"
				});

				var newcomment = $('#tmpl').html();
				$('#comment-container').append(newcomment);
				$(this).attr('id','');
			}
				
		});

		function addcomment(){
			var comment = $('#comment').val();
			$.ajax({
				  url	: "#",
				  type	: "POST",
				  data	: {commenting	 : true,
					  	 	comment	 : comment
						   },
				  dataType: "html"
			});
		}
	});
	</script>
</head>


<?php

function showcomments()
{
	$html = null;
	$content = file_get_contents('advice.json');
	if(empty($content)){
		$html =  "<div style='width:80%; margin:4%; float:left; '><h1>No one commented !</h1></div>";
		return $html;
	}
	$contents = json_decode($content,true);
	
	foreach ($contents as $content){
		$html = $html."
		 <div class='comment-group'>
		  	<input class='comment-input'  type='textarea' value='".$content."'>
	    </div>";
	}
	
	return $html;
}
 
function addcomment($content)
 {
	$prevcontent = file_get_contents('advice.json');

	$prevcontent = json_decode($prevcontent,true);
	
	//if user already exist then add another folder ot it's list else add new entry

	$prevcontent[] = $content;
	
	$contents = json_encode($prevcontent);
	
	file_put_contents('advice.json',$contents);
 }
 
 
 ?>
 
 <body>
 <div><h1><img src="smile.png">&nbsp;Demands + Suggestions</h1></div>
 <div id="comment-container">
 <?php 
 echo showcomments();
 ?>
 <div id="tmpl">
 <div class='comment-group'>
	<input class='comment-input'  id=comment type='textarea' value='' placeholder="please suggest me !">
 </div>
 </div>

</div>
</body>
</html>
