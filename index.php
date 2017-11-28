<?php

  //API URL of FCM
    $url = 'https://fcm.googleapis.com/fcm/send';

    /*api_key available in:
    Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key*/
    $api_key = 'AAAAAU7VCc0:APA91bH-vh4B1mffSIMZtHxyEkIn6cBE930JfXj-9snYkAcIcKgRLNGMgk6zGQQkIBf8sPJyLiF_rMgemLV2996yxcZr2vtPDApMI8lmsuxecL8konpKzZnoJ7m4ux09fTF2RsrXSZv8';
                
    $fields = array (
        'registration_ids' => array (
                '5617551821'
        ),
        'data' => array (
                "message" => 'hello'
        )
    );

    //header includes Content type and api key
    $headers = array(
        'Content-Type:application/json',
        'Authorization:key='.$api_key
    );
                
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    if ($result === FALSE) {
        die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
    echo $result;
    // return $result;

?>