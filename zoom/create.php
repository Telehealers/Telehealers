<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://roomsvc-dot-sprpro-282209.el.r.appspot.com/videocallstart',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "usersAdd":[
      {
         "name":"ayu",
         "email":"ayushverma.jewels@gmail.com",
         "role":"host"
      },
      {
         "name":"name3",
         "email":"raghuveer@ecomsolver.com",
         "role":"co-host"
      }
   ]
}
',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJhdWQiOiJ0ZWxlaGVhbGVycyIsImJ1c2luZXNzSWQiOiI1WkZrZW40MDg1bmRVVk1yeXE4QyIsIm1vZGUiOiJkZXYiLCJhY2Nlc3NMZXZlbCI6IjAiLCJ2aWRTdWJEb21haW4iOiJodHRwczovL3N1cGVyY2FsbC1kb3QtZGV2Z29tZXJyeS5lbC5yLmFwcHNwb3QuY29tIiwiYWRtaW4iOnRydWUsImlhdCI6MTYyMDQ1MTQ5OX0.PJiy51pHst7qsYkENtUWJ6o9u-Q5qd_INfBNykTT0Y-U7drtP2sxeSLsr1Ihfc_tXQPiannLa6mHGk7C0TCDEmH1tuHaF3HfuZArqWdn7eNx1u5BY5l7tNWMh58hW2oslfMw6_jQZznUuc_cb1mBGYZwxgMsA-JPJjKYA9DZgto',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
