<?php
/* $abc = '16:45';
echo $abc;
echo "<br>";
$date = '19:24:15 06/13/2013'; 
echo date('h:i A', strtotime($abc)); */

//$rand = rand(1000,9999);
 $rand = 2121;
$phone = '9799871957';
$path = "http://japi.instaalerts.zone/httpapi/QueryStringReceiver?ver=1.0&key=pjjXNjf8In8sb8BdmFYVgw==&encrypt=0&dest=9799871957&send=LOADIT&text=OTP%20IS%20-%20".$rand;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $path);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_exec($ch); 
 
/*
http://japi.instaalerts.zone/httpapi/QueryStringReceiver?ver=1.0&key=pjjXNjf8In8sb8BdmFYVgw==&encrypt=0&dest9799871957&send=LOADIT&text=OTP IS - {4321}
*/


		
?>
<!-- 
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
 -->
