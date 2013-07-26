<div class="discuss-content">
		<div class="discussions">[[POSITION::1]]</div>
		<div class="comments">[[POSITION::2]]</div>
</div>


<script type="text/javascript" src="media/js/jquery.js"></script>
<script type="text/javascript">
	$(document).ready (function(){
		$(".rbsl-Discus-title").click(function(){
			$('.rbsl-bottom-a').addClass('span3');
			var currentId1 = $(this).attr('dataId');
			$('.comman').hide('slow');
			$(currentId1).show('slow');
			$('.rbsl-bottom-b').addClass('span9');
			
		});
	});
</script>
<!--</body>-->
<!--</html>-->
