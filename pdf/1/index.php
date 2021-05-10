<!DOCTYPE html>
<html>
<head>
<title>PHP Signature Pad Example</title>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
 
<script type="text/javascript" src="./asset/jquery.signature.min.js"></script>
<link rel="stylesheet" type="text/css" href="./asset/jquery.signature.css">
 
<style>
.kbw-signature { width: 400px; height: 200px;}
#signature canvas{
width: 100% !important;
height: auto;
}
.container{
margin-left: 420px;
 
}
</style>
 
</head>
<body>
 
<div class="container">
 
 
 
<h1>E-signature with PHP and Ajax </h1>
 
<div class="col-md-12" style="margin-top: 100px;">
 
<label class="" for="">E-Signature:</label>
<br/>
<div id="signature" ></div>
<br/>
<button id="clear">Clear Signature</button>
<textarea id="sigpad" name="signature_image" style="display: none"></textarea>
</div>
 
<br/>
<button class="btn btn-success" id="Submit">Submit</button>
 
<span id="res" style="color: green;"></span>
</div>
 
 
<script type="text/javascript">
var signature = $('#signature').signature({syncField: '#sigpad', syncFormat: 'PNG'});
$('#clear').click(function(e) {
e.preventDefault();
signature.signature('clear');
$("#sigpad").val('');
});
</script>
 
<script type="text/javascript">
$("#Submit").click(function(){
 
//url = "http://192.168.1.147:8080/sign/signature.php";
url = "http://localhost/sign/signature.php";
sigpad= $("#sigpad").val();
$('#res').html('loading....');
$.ajax({
type : 'POST',
url : url,
data : {signature_image: sigpad},
success: function(result){
$('#res').html('Signature Uploaded successfully');
// location.reload();
 
},
}) ;
 
});
</script>
 
</body>
</html>
