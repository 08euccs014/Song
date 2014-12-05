<?php


//initiate a soap client using server wsdl file
$soapClient  = new SoapClient('http://localhost/soap/soap_server.php?wsdl');

//call for the available known function with arguments
$response = $soapClient->__soapCall('getHello', array('mohit'));

//simple output
var_dump($response);