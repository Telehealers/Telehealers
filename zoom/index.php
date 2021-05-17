<?php
require_once 'config.php';

//echo "Basic ". base64_encode('xFWmWIKkRwCG0CDbL32F5w:xzngS2qYpk7Ju5X7e628IZtsUypRuqPG');
//die();
  
$url = "https://zoom.us/oauth/authorize?response_type=code&client_id=".CLIENT_ID."&redirect_uri=".REDIRECT_URI;
?>
  
<a href="<?php echo $url; ?>">Login with Zoom</a>

<?php
//die();
if(isset($_GET['code']) && $_GET['code']!=""){
	try {
		$client = new GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
	  
		$response = $client->request('POST', '/oauth/token', [
			"headers" => [
				"Authorization" => "Basic ". base64_encode(CLIENT_ID.':'.CLIENT_SECRET)
			],
			'form_params' => [
				"grant_type" => "authorization_code",
				"code" => $_GET['code'],
				"redirect_uri" => REDIRECT_URI
			],
		]);
	  
		$token = json_decode($response->getBody()->getContents(), true);
		$a = json_encode($token);
		echo "<pre>";print_r($a);die();
		
	} catch(Exception $e) {
		echo $e->getMessage();
	}
}
?>