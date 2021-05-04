<?php
require_once 'config.php';
  
$client = new GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
  
$db = new DB();
$arr_token = $db->get_access_token();
$accessToken = $arr_token->access_token;

echo "<pre>";print_r($accessToken);die();

$response = $client->request('GET', '/v2/users/me/meetings', [
    "headers" => [
        "Authorization" => "Bearer 0ivxg2IEB6_HrtfPgG9QlKOMgiMqEAT1Q"
    ]
]);
 
$data = json_decode($response->getBody());

echo "<pre>";print_r($data);die();

if ( !empty($data) ) {
    foreach ( $data->meetings as $d ) {
        $topic = $d->topic;
        $join_url = $d->join_url;
        echo "<h3>Topic: $topic</h3>";
        echo "Join URL: $join_url";
    }
}