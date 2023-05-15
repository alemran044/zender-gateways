<?php
/**
 * ICOMBD SMS Gateway
 * @author Titan Systems
 */

define("ICOMBD_GATEWAY", [
	"username" => "my_username", // Your ICOMBD Account User Name
	"password" => "my_password", // Your ICOMBD Account Password
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

	if($send->getStatusCode() == 201):
		return true;
	else:
		return false;
	endif;
}
