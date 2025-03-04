<?php
/**
 * iCombd SMS Gateway
 * @author Titan Systems
 */

define("ICOMBD_GATEWAY", [
	"username" => "my_uname", // Your twilio Account SID
	"password" => "my_pass", // Your twilio authentication token
	"sender" => "My Zender" // Sender Name
]);

function gatewaySend($phone, $message, &$system)
{
	/**
	 * Implement sending here
	 * @return bool:true
	 * @return bool:false
	 */

	$send = $system->guzzle->post("http://api.icombd.com/api/v1/campaigns/sendsms/plain", [
		"form_params" => [
			"username" => ICOMBD_GATEWAY["username"],
			"password" => ICOMBD_GATEWAY["password"],
        	"sender" => ICOMBD_GATEWAY["sender"],
        	"text" => $message,
        	"to" => $phone
        ],
        "allow_redirects" => true,
        "http_errors" => false
	]);

	if($send->getStatusCode() == 200):
		return true;
	else:
		return false;
	endif;
}