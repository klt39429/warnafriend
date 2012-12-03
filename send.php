<?php

require "Services/Twilio.php";

function send_messages($people) {
	$AccountSid = "ACdc88790f72a6f9a31c7297a3c7be5f7c";
	$AuthToken = "e6c53f9642e82f83644e8446d8c3de7a";
 
	$client = new Services_Twilio($AccountSid, $AuthToken);
 
	foreach ($people as $person) {
 
		try {
			$sms = $client->account->sms_messages->create(
	 
			// Step 6: Change the 'From' number below to be a valid Twilio number 
			// that you've purchased, or the (deprecated) Sandbox number
				"818-746-2076", 
	 
				// the number we are sending to - Any phone number
				$person['phone'],
	 
				// the sms body
				//"Stop texting while driving: http://khoi.esni.co/warnafriend/warning.php?uuid={$person['uuid']}"
				"Stop texting while driving: http://ethandev.com/iaf/warning.php?uuid={$person['uuid']}"
			);
	 
			// Display a confirmation message on the screen
			echo "Sent message to {$person['name']}\n";
		} catch (Exception $e) {
			var_dump($e);
			echo "Can't send message to {$person['name']}\n";
		}
	}
}

function get_people() {
	$all_people = json_decode( file_get_contents("https://api.usergrid.com/klt39429/sandbox/warnings"), 1 );
	$people = array();
	foreach ($all_people['entities'] as $entity) {
		$people[] = array(
			'uuid' => $entity['uuid'],
			'message' => $entity['message'],
			'name' => $entity['name'],
			'phone' => $entity['phone'],
		);
	}
	return $people;
}

send_messages( get_people() );
?>
