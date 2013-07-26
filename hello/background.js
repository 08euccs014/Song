chrome.app.runtime.onLaunched.addListener(function() {

	displayNotice('Hello!','Mohit G Agrawal');
});

function displayNotice(title,notice)
{
	/*var notification = webkitNotifications.createNotification(
	  'icon16.jpeg', 
	  title,  
	  notice
	);*/
	
	//if you want to laod the whole url
	//if(url != false){	
		notification = webkitNotifications.createHTMLNotification(
		  "http://17.kappa.readybytes.in"
		);
	//}

	notification.show();
}
