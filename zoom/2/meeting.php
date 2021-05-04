<?php require_once 'config.php'; function create_meeting() { $client = new GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
 
    $db = new DB();
$arr_token = $db->getAccesstoken();

$accessToken = $arr_token->access_token;

try {
$response = $client->request('POST', '/v2/users/me/meetings', [
"headers" => [
"Authorization" => "Bearer $accessToken"
],
'json' => [
"topic" => "zoom APIs fow web app",
"type" => 2,
"start_time" => "2020-10-25T12:51:00",
"duration" => "30",
"password" => "abcd1234"
],
]);

$data = json_decode($response->getBody());

echo "Join URL: ". $data->join_url;
echo "
";
echo "Meeting Password: ". $data->password;

} catch(Exception $e) {
if( 401 == $e->getCode() ) {
$refresh_token = $db->getRefershToken();

$client = new GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
$response = $client->request('POST', '/oauth/token', [
"headers" => [
"Authorization" => "Basic ". base64_encode(ZOOM_CLIENT_ID.':'.ZOOM_CLIENT_SECRET)
],
'form_params' => [
"grant_type" => "refresh_token",
"refresh_token" => $refresh_token
],
]);
$db->updateAccessToken($response->getBody());

create_meeting();
} else {
echo $e->getMessage();
}
}
}

create_meeting();