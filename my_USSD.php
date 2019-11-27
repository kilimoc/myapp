<?php
// Reads the variables sent via POST from our gateway
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];

require_once 'CompanyOperations.php';

//object;
$gatewayApp=new CompanyOperations();
if ($text == "") {
    // This is the first request. Note how we start the response with CON
    $response  = "CON Welcome to I-ITEMRECOVERY USSD call Checking Lost Item\n";
    $response .= "Enter Item Registration Number";
    //Let us get to Question the database about the availability of the item;


}
else{
    $serverresponse=$gatewayApp->handleUSSD($text);
    $response="END ".$serverresponse;



}
// Echo the response back to the API
header('Content-type: text/plain');
echo $response;

?>