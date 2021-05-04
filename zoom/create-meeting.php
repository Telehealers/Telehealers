<?php
require_once 'config.php';
  
function create_meeting() {
    $client = new GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
  
    $db = new DB();
    $arr_token = $db->get_access_token();
    $accessToken = 'eyJhbGciOiJIUzUxMiIsInYiOiIyLjAiLCJraWQiOiI0NzFlYmEzMy04YmM3LTQzMmMtODcwYi05YWRiMWVjOGUyNTMifQ.eyJ2ZXIiOjcsImF1aWQiOiJmYzBkMjgxMGVhMDc2YWYwYTViMTdmYzU1Mjg5YjRiZCIsImNvZGUiOiJHTGE4a2NhS2J3X0hydGZQZ0c5UWxLT01naU1xRUFUMVEiLCJpc3MiOiJ6bTpjaWQ6eEZXbVdJS2tSd0NHMENEYkwzMkY1dyIsImdubyI6MCwidHlwZSI6MCwidGlkIjozLCJhdWQiOiJodHRwczovL29hdXRoLnpvb20udXMiLCJ1aWQiOiJIcnRmUGdHOVFsS09NZ2lNcUVBVDFRIiwibmJmIjoxNjE5MjcyMDM5LCJleHAiOjE2MTkyNzU2MzksImlhdCI6MTYxOTI3MjAzOSwiYWlkIjoiZWhPZGxiOC1TRGlGR3RTZ1E5RnhtQSIsImp0aSI6ImQ4YzU3MTlmLTIxMjAtNDdiOC05MDU3LTZkY2JhNTI2YmY3YyJ9.T2zkUNdjWAKYHiAZCOzoB3gm74JTJa0SiS7nWBw42VAa1q6i4_TUjkY5Q0gghxHAlP1OrSwjFtWATJElePny5w';
  
    try {
        $response = $client->request('POST', '/v2/users/me/meetings', [
            "headers" => [
                "Authorization" => "Bearer $accessToken"
            ],
            'json' => [
                "topic" => "Let's learn Laravel",
                "type" => 2,
                "start_time" => "2021-03-05T20:30:00",
                "duration" => "30", // 30 mins
                "password" => "123456"
            ],
        ]);
  
        $data = json_decode($response->getBody());
        echo "Join URL: ". $data->join_url;
        echo "<br>";
        echo "Meeting Password: ". $data->password;
  
    } catch(Exception $e) {
        if( 401 == $e->getCode() ) {
            $refresh_token = 'eyJhbGciOiJIUzUxMiIsInYiOiIyLjAiLCJraWQiOiI2NmE1NzAwZi02YzI0LTQ4ODctODFiOS04NTVhMjhiNDQ2ZDEifQ.eyJ2ZXIiOjcsImF1aWQiOiJmYzBkMjgxMGVhMDc2YWYwYTViMTdmYzU1Mjg5YjRiZCIsImNvZGUiOiJwejRFNTVPTVNVX0hydGZQZ0c5UWxLT01naU1xRUFUMVEiLCJpc3MiOiJ6bTpjaWQ6eEZXbVdJS2tSd0NHMENEYkwzMkY1dyIsImdubyI6MCwidHlwZSI6MSwidGlkIjowLCJhdWQiOiJodHRwczovL29hdXRoLnpvb20udXMiLCJ1aWQiOiJIcnRmUGdHOVFsS09NZ2lNcUVBVDFRIiwibmJmIjoxNjE5MjY3NTEyLCJleHAiOjIwOTIzMDc1MTIsImlhdCI6MTYxOTI2NzUxMiwiYWlkIjoiZWhPZGxiOC1TRGlGR3RTZ1E5RnhtQSIsImp0aSI6ImFkYWU2ZjY3LTkyYzQtNDQ0NS1hNjg0LWI2NWNhYTI1MmViMCJ9.Ns_t6NCdP0gWmMhdDLVEs_cuWOiEoMohmgNt2IjQbU1RORsP-34WJNQ7bwwY920xJxOfMjZ-iROnOcIPTFiDHQ';
  
            $client = new GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
            $response = $client->request('POST', '/oauth/token', [
                "headers" => [
                    "Authorization" => "Basic ". base64_encode(CLIENT_ID.':'.CLIENT_SECRET)
                ],
                'form_params' => [
                    "grant_type" => "refresh_token",
                    "refresh_token" => $refresh_token
                ],
            ]);
            $db->update_access_token($response->getBody());
  
            create_meeting();
        } else {
            echo $e->getMessage();
        }
    }
}
  
create_meeting();