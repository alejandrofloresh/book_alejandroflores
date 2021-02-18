<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.imgbb.com/1/upload?key=Your_ID_APP',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('image' => 'Your_base64'),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
/*
Comparto un link con la libre de postman para hacer el llamado via post desde postman

https://www.getpostman.com/collections/7cac248392d1e773a18c

*/
