<?php 
require_once 'vendor/autoload.php';
require_once "db.php";
 
define('ZOOM_CLIENT_ID', 'YOUR_ZOOM_CLIENT_ID');
define('ZOOM_CLIENT_SECRET', 'YOUR_ZOOM_CLIENT_SECRET');
define('ZOOM_REDIRECT_URI', 'YOUR_ZOOM_REDIRECT_URI');

&lt;/pre&gt;
&lt;p&gt;Php Code for db.php&lt;/p&gt;
&lt;pre&gt;
&lt;?php class DB { private $host = "localhost"; private $username = "root"; private $password = ""; private $database = "zoom"; public function __construct(){ if(!isset($this-&gt;db)){
 $conn = new mysqli($this-&gt;host, $this-&gt;username, $this-&gt;password, $this-&gt;database);
if($conn-&gt;connect_error){
die("Failed to connect with MySQL: " . $conn-&gt;connect_error);
}else{
$this-&gt;db = $conn;
}
}
}

public function getAccesstoken() {
$sql = $this-&gt;db-&gt;query("SELECT access_token FROM zoom_token");
$result = $sql-&gt;fetch_assoc();
return json_decode($result['access_token']);
}

public function getRefershToken() {
$result = $this-&gt;get_access_token();
return $result-&gt;refresh_token;
}

public function updateAccessToken($token) {
if($this-checkTable()) {
$this-&gt;db-&gt;query("INSERT INTO zoom_token(access_token) VALUES('$token')");
} else {
$this-&gt;db-&gt;query("UPDATE zoom_token SET access_token = '$token' WHERE id = (SELECT id FROM zoom_token)");
}
}
public function checkTable() {
$result = $this-&gt;db-&gt;query("SELECT id FROM zoom_token");
if($result-&gt;num_rows) {
return false;
}

return true;
}
}
&lt;/pre&gt;
&lt;p&gt;Php Code for index.php&lt;/p&gt;
&lt;pre&gt;
&lt;?php
require_once 'config.php';
&lt;?php $zoom_login_url = "https://zoom.us/oauth/authorize?response_type=code&amp;client_id=".ZOOM_CLIENT_ID."&amp;redirect_uri=".ZOOM_REDIRECT_URI; echo 'Login with Zoom'; ?-->

