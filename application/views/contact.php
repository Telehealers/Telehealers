<?php
    date_default_timezone_set(@$info->timezone->details);
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?php echo (!empty(html_escape($info->fabicon->picture))?html_escape($info->fabicon->picture):null); ?>" type="image">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>web_assets2/css/main.css">
	<link href="<?php echo base_url()?>assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
	
	<link rel="stylesheet" href="<?php echo base_url();?>web_assets2/appointment/css/main.css">
    <link rel="stylesheet" href="<?php echo base_url();?>web_assets2/appointment/css/style.css">
	<link rel="" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js">
	
    <title><?php echo $meta_info[0]['page_title']; ?></title>
	<meta name="keywords" content="<?php echo $meta_info[0]['meta_keywords']; ?>">
	<meta name="description" content="<?php echo $meta_info[0]['meta_description']; ?>">
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Y9P95E4VWH"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-Y9P95E4VWH');
</script>
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/608b89375eb20e09cf37f9d4/1f4gh00vt';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>

</head>
<?php
function GeraHash($qtd){
//Under the string $Caracteres you write all the characters you want to be used to randomly generate the code.
$Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789';
$QuantidadeCaracteres = strlen($Caracteres);
$QuantidadeCaracteres--;
$Hash=NULL;
for($x=1;$x<=$qtd;$x++){
    $Posicao = rand(0,$QuantidadeCaracteres);
    $Hash .= substr($Caracteres,$Posicao,1);
}
return $Hash;
}
//Here you specify how many characters the returning string must have
$hello = GeraHash(5);
?>
<style>
    .owl-carousel .owl-item img{width:65%;}
    
</style>
<body>

    <?php $this->load->view('header.php')?>

	<section id="contact" class="contact_us_home">
        <div class="banner mb-5">
            <img src="<?php echo base_url();?>web_assets2/images/contact_banner.jpg" alt="contact" width="100%">
        </div>
        <div class="container">
            <div class="row"> 
			<!-- <div class="col-md-3"> -->
                    <!--<div class="contact_detail">
                        <span>Office</span>
                        <ul>
                            <li><i class="fas fa-envelope"></i> <?php echo $info->email->details; ?></li>
                       </ul>
						<div class="top_social">
                            <ul>
                                <li>
                                    <a href="<?php echo (!empty(html_escape($info->linkedin->details))?html_escape($info->linkedin->details):null); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                </li>
                                <li>
                                    <a href="<?php echo (!empty(html_escape($info->twitter->details))?html_escape($info->twitter->details):null); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="<?php echo (!empty(html_escape($info->google->details))?html_escape($info->google->details):null); ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>-->
                <!-- </div> -->
                <div class="col-md-6">
                    <div class="contact_form">
                        <!--<h5>get in touch</h5>-->
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control" id="full_name" name="fname" placeholder="Full name..." required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" id="email_id" name="email" placeholder="E-mail address..." required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject..." required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" id="message" name="message" rows="6" placeholder="Your message..." required></textarea>
                            </div>
							
							<div class="form-group">
								<div id=""><span style="background: #0c8bef none repeat scroll 0 0;color: #fff;padding: 4px 20px;font-family:serif,sans-serif;font-style: italic;"><?php echo $hello; ?></span></div>
								<div id="captchdas" style="visibility: hidden;"><?php echo $hello; ?></div>
                                <input type="text" class="form-control" id="captcha_code" name="captcha_code" placeholder="Captcha..." required>
                            </div>
	
                            <div class="submit_box_btn">
                                <input id="contact_us" type="button" value="submit">
                            </div>
							
							<div id="q_succ_msg" class="mt-3 alert alert-success" style="display:none"></div>
							<div id="q_show_error" class="mt-3 alert alert-danger" style="display:none"></div>
			  <br>
                        </form>
                    </div>
                </div>
				<div class="col-md-6">

                
            
<?php
$servername = 'localhost';
$username = 'telehea2_telehealers';
$password = '#&$H3enA1Shd(*3!()';
$dbname = 'telehea2_telehealers';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM wp_blog_posts where post_type = 'post' and post_status = 'publish'";
$result = $conn->query($sql);


?>
            <div id="home_publication_slider" class="owl-carousel owl-theme">
			<?php 
			//foreach ($post as $key => $val) { 
			if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	  $post_id = $row["ID"];

$sql2 = "SELECT * FROM wp_blog_postmeta where post_id = '$post_id' and meta_key = '_wp_attached_file'";
$result2 = $conn->query($sql2);
$image_url = '2021/04/blog_ba.jpg';
if ($result2->num_rows > 0) {
  // output data of each row
  while($row2 = $result->fetch_assoc()) {
    $image_url = $row2["meta_value"];
  }
}
			?>
                <div class="item">
                    <div class="product-item">
                        <div class="carousel-thumb">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="user_img">
                                        <img src="https://telehealers.in/blogs/wp-content/uploads/<?php echo $image_url; ?>" alt="#" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="reviews_contents">
                                        <h5><?php echo $row["post_title"];?></h5>
                                        <p><?php echo $row["post_excerpt"]; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			<?php 
			//}
}
} 
			?>
            </div>
                </div>
            </div>
        </div>
    </section>
	
    <?php $this->load->view('footer.php')?>
	
	
<input type="hidden" id="baseUrl" value="<?php echo base_url();?>" />
	

<input type="hidden" id="base_url" value="<?php echo base_url()?>">
	<script src="<?php echo base_url();?>web_assets2/js/jquery.js"></script>
    <script src="<?php echo base_url();?>web_assets2/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>web_assets2/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url();?>web_assets2/js/main.js"></script>
    <script src="<?php echo base_url();?>web_assets2/js/all.min.js"></script>
	<script src="<?php echo base_url()?>assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>web_assets2/js/custom.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>web_assets2/js/home_footer.js"></script>
	<script src="<?php echo base_url();?>web_assets2/appointment/js/script.js"></script>
	
<script>
$(document).ready(function(){
    $('.appoimentbtn').show();
	$('#contact_us').click(function(){
		var full_name    = $('#full_name').val();
		var email_id     = $('#email_id').val();
		var subject      = $('#subject').val();
		var message      = $('#message').val();
		var captchdas    = '<?php echo $hello; ?>';
		var captcha_code = $('#captcha_code').val();
		var baseUrl = $('#baseUrl').val();
		var msg = '';
		
		if(full_name==""){
			msg += 'Please enter full name.<br>';
		}
		if(email_id==""){
			msg += 'Please enter email ID.<br>';
		}else{
			var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if(email_id.match(mailformat))
            {}else{
                msg += 'You have entered an Invalid Email ID.<br>';
            }  
		}
		if(subject==""){
			msg += 'Please enter subject.<br>';
		}
		if(message==""){
			msg += 'Please enter your message.<br>';
		}
		if(captcha_code==""){
			msg += 'Please enter captcha code.<br>';
		}
		else{
			if(captchdas != captcha_code){
				msg += 'Please enter a valid captcha code.<br>';
			}
		}
		if(msg!=""){
            $('#q_succ_msg').hide();
            $('#q_show_error').show();
            $('#q_succ_msg').html('');
            $('#q_show_error').html(msg);
        }else{
			$('#q_show_error').hide();
			$('#q_succ_msg').show();
			$('#q_succ_msg').html('Please wait...');
			$.ajax({
				url:baseUrl+'index.php/Welcome/contactEmail',
				method: 'post',
				data: {full_name:full_name, email_id:email_id, subject:subject, message:message},
				type: 'POST',
				success: function(response){
					//$('#q_succ_msg').html('Your details has been submited successfully.');
					$('#full_name').val('');
					$('#email_id').val('');
					$('#subject').val('');
					$('#message').val('');
					$('#captcha_code').val('');
					$('#q_succ_msg').html(response);
				}
			});
        }
		
	});
	
	
	
});




</script>	
</body>
</html>