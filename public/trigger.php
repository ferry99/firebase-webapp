<?php

	function getRegToken(){ // Getting registered token name
		$url = 'https://push-notification-12490.firebaseio.com/users.json?print=pretty';//Google URL

		// prepare the bundle
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, $url );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		$result = curl_exec($ch );
		// Execute post
		if ($result === FALSE) {
		    die('Curl failed: ' . curl_error($ch));
		}else{
			print_r($result);
			return $result;
		}
		// Close connection
		curl_close($ch); 
	}  


	function sendToRegToken($regIds){ //Send Messsage To All Token
		$curl = curl_init();
		//print_r($regIds);
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://android.googleapis.com/gcm/send",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $regIds,
			CURLOPT_HTTPHEADER => array(
			"authorization: key=AAAAAU7VCc0:APA91bH-vh4B1mffSIMZtHxyEkIn6cBE930JfXj-9snYkAcIcKgRLNGMgk6zGQQkIBf8sPJyLiF_rMgemLV2996yxcZr2vtPDApMI8lmsuxecL8konpKzZnoJ7m4ux09fTF2RsrXSZv8",
			"content-type: application/json"
			  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			  echo "cURL Error #:" . $err;
			} else {
			  echo $response;
			}
	}


	$regTokenJson = getRegToken();	
	$regTokenJson = json_decode($regTokenJson);
	// print_r(json_decode($regTokenJson));
	$arrRegId['registration_ids'] = array();
	foreach ($regTokenJson as $key => $value){
		array_push($arrRegId['registration_ids'], $key);
	}
	$regTokenJson = json_encode($arrRegId);
	sendToRegToken($regTokenJson);

?>