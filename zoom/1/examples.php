<?php
require 'ZoomAPIWrapper.php';

$apiKey = 'lEO0H7SrRVC638Ni5GMgHQ';
$apiSecret = 'n7l1zRFtsEkR4FftVOGLiQTFGNYNlnVl';

// Get key and secret from the command line if they have been provided there
if (isset($argv[1])) $apiKey = $argv[1];
if (isset($argv[2])) $apiSecret = $argv[2];

$zoom = new ZoomAPIWrapper( $apiKey, $apiSecret );

// It is up to you to use the right method, path and specify the request parameters
// to match the {placeholders} in the path.
// You can find all the details of method, path, placholders and body content in the Zoom
// API reference docs here: https://marketplace.zoom.us/docs/api-reference/zoom-api

// First a simple GET request
$response = $zoom->doRequest('GET','/users',array('status'=>'active'));

if ($response === false) {
    // There was an error before the request was event sent to the api
    echo "Errors:".implode("\n",$zoom->requestErrors());
} else {
    printf("Response code: %d\n",$zoom->responseCode());
    print_r($response);
}

// A simple POST request
$user = '
    {
      "action": "create",
      "user_info": {
        "email": "raghuveer@ecomsolver.com",
        "type": 1,
        "first_name": "Terry",
        "last_name": "Jones"
      }
    }
';
// This request has no query parameters, and no path parameters
// N.B. Creating users requires a paid Zoom account
$response = $zoom->doRequest('POST','/users',array(),array(),$user);
print_r($response);

// A GET request with path parameters
// This request has path parameters, but mo query parameters (or body content)
// N.B. Cloud recordings requires a paid Zoom account
$response = $zoom->doRequest('GET','/accounts/{accountId}/recordings',array(),array('accountId'=>'me'));
print_r($response);


// A PATCH request
// This time let's pass the post data as a PHP data structure, not JSON
$userUpdateDetails = array(
  "first_name"  => "Fred",
  "last_name"   => "Bloggs",
);
$userToUpdate = 'fred@bloggs.com';
$response = $zoom->doRequest('PATCH','/users/{userId}',array(),array('userId'=>$userToUpdate),$userUpdateDetails);
// On success the response from Zoom in this case is empty.
// We can test for success by checking the response code
if ($zoom->responseCode()==204) {
    echo "User updated\n";
} else {
    print_r($response);
}
