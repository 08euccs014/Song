function ajaxCall(url,variable,method)
{
	var request = $.ajax({
		  					url		: url,
							type	: method,
							data	: variable,
							dataType: "html"
	});
	
	return request;
}

function submit()
{
	$('#discussionFrom').submit();
}

function createTicket()
{
	var title 			= $('#title').val();
	var description 	= $('#description').val();
	var level 			= $('#level').val();
	var type 			= $('#type').val();
	var deadline_date 	= $('#deadline_date').val();
	var release_date 	= $('#release_date').val();
	var milestone 		= $('#milestone').val();
	
	var postdata = {title:title,description:description,level:level,type:type,deadline_date:deadline_date,release_date:release_date,milestone:milestone,isAjax:true};
	var url 	 = "index.php?option=ticket&view=add";
	var res 	 = ajaxCall(url,postdata,'POST');

	res.done(function(msg){

		var msg = parseInt(msg);
		if(msg){
			//either page refresh here or need to create a row by youself
			location.reload();
		}

	});
}

function updateTicket(name,value,id)
{	
	var postdata = {name:name,value:value,id:id,isAjax:true};
	var url 	 = "index.php?option=ticket&view=update";
	var res 	 = ajaxCall(url,postdata,'POST');


}

function deleteTicket(ticketid)
{
	var postdata = {ticketid:ticketid,isAjax:true};
	var url 	 = "index.php?option=ticket&view=delete";
	var res 	 = ajaxCall(url,postdata,'POST');
	
	res.done(function(msg){

		var msg = parseInt(msg);
		if(msg){
			//either page refresh here or just hide that tr row for a sec
			location.reload();
		}

	});
}

$(document).ready(function(){
	$(".change").change(function () {
		var id= $(this).attr("id");
		var name= $(this).attr("name");
		var value= $(this).attr("value");
		updateTicket(name,value,id);
	});
});
