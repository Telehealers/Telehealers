<?php

$servername = getenv('DB_HOSTNAME');
$username=getenv('DB_USERNAME');
$password=getenv('DB_PASSWORD')
$dbname = getenv('DB_NAME');

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM token where id = '1'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
		$refersh_token = $row["refersh_token"];
  }
}	
if($refersh_token!=""){
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://zoom.us/oauth/token?grant_type=refresh_token&refresh_token=$refersh_token",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Basic eEZXbVdJS2tSd0NHMENEYkwzMkY1dzp4em5nUzJxWXBrN0p1NVg3ZTYyOEladHNVeXBSdXFQRw==',
            'Cookie: _zm_chtaid=506; _zm_csp_script_nonce=piuKUloUQ4yCwB8ZvcNMNg; _zm_ctaid=5PJ5jmefQNiwQayJdwbxbQ.1619266828319.ace13ac7c1031b5f27292be520838dc3; _zm_currency=INR; _zm_mtk_guid=50444b9bba36405abe7fee2e16146f25; _zm_o2nd=8888069cf2a2b3c35a933fb57143c7a8; _zm_page_auth=aw1_c_9w8EEFt3R--IbkaoOTBU3Q; _zm_ssid=aw1_c_zmoIn-WzSgidkPkyFqWCyw; cred=BCE25CA8E949E3745D6FE85316CA935F'
          ),
        ));
        
        $response = curl_exec($curl);
        $response = json_decode($response);

    
    $access_token_new = $response->access_token;
    $refresh_token_new = $response->refresh_token;
    
    if($access_token_new!=""){
        $sql2 = "update token set access_token = '$access_token_new', refersh_token = '$refresh_token_new' where id = '1'";
        $conn->query($sql2);    
    }
   


    $conn->close();

    echo "<pre>";print_r($response);

    curl_close($curl);
}