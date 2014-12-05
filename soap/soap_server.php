<?php 

//a hello world function
function getHello($message)
{
	return "How are you $message !";
}

//initiate a soap server
$server = new SoapServer("http://localhost/soap/soap.wsdl");

//register an funtion to soap service
$server->addFunction('getHello');

//now, let soap server to handle the request and response sequences
$server->handle();