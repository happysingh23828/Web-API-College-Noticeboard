<?php


$url = "https://fcm.googleapis.com/fcm/send";
$token = "ftt0TmphZjs:APA91bHl19uzjstjYGChQRE9F9J7wW4BaAxRylpo3WEOIifRcuKOvT1Tq71-CKXc_SFCR3CwtWuydP5aGurd7zjbcJZvEhAjJ9SbqjFRSr71tQiEUGGMcmpoUmXjmc9TKoNs_9Ef7JRe";
$serverKey = 'AAAA_LaAQW0:APA91bFWJPy8noTWnrfm8ePgRaOuq3p1xUuCJtIk3wfGqAUjKutCiOyUeDpww19OVlqD_3hTfqOhEIEXaF9jMtsdB0BsmDi2P7IoLGiFwBseQrtn9tjIBiOaRRMFNpbCzDGuk9mgLfpd';
$title = "Title";
$body = "Body of the message";
$notification = array('title' =>$title , 'text' => $body, 'sound' => 'default', 'badge' => '1');
$arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
$json = json_encode($arrayToSend);
$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Authorization: key='. $serverKey;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST,

"POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
//Send the request
$response = curl_exec($ch);
//Close request
if ($response === FALSE) {
die('FCM Send Error: ' . curl_error($ch));
}
curl_close($ch);