<!-- we need to add here all css and functionality -->
<script type="text/javascript">

function createComments(discussion_id)
{
	//need to add loading image
	$("#commenttmpl").hide();
	var content = $('#commentcontent').val();
	var postdata = {discussion_id:discussion_id,content:content,isAjax:true};
	var url 	 = "index.php?option=comment&view=add";
	var res 	 = ajaxCall(url,postdata,'POST');

	res.done(function(msg){

		var msg = parseInt(msg);
		if(msg){
			var htmlData = "<div>"+content+"</div>";
			$('#commentcontainer').append(htmlData);
			$("#commenttmpl").show();
		}

	});

	
}

</script>

<div><?php echo $this->discussion->content;?></div>

<div id="commentcontainer">
<?php 
foreach ($this->comments as $record):
?>
							<div class="comman" id="discuss-topic1">
								<form action="" method="get">
									<textarea>
									<?php echo $record->content; ?>
									</textarea>
								</form>
							</div>
<?php 
endforeach;
?>
</div>
<div id="commenttmpl">
<input  id=commentcontent type=textarea value='comment me . . .!'>
<button id=comment onclick="createComments(<?php echo $this->discussion->id;?>);">comment</button>
</div>