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
<script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/e836e1578317f3389cedf8f6a/0bf682a738edbb1cd96720c12.js");</script>
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/608c0bf662662a09efc3afa9/1f4hgtf3e';
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

        
        <section id="faq" class="faq-section">
            <div class="container">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="faq-title text-center pb-3">
                                    <h2>Doctor Approve</h2>
                                </div>
                            </div>
							<?php if($approve==0){ ?>
                            <div class="col-md-12">
							    <!--<p>What is Lorem Ipsum?
Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>-->

						<?php echo $content; ?>

                            </div>
							<div class="col-md-12">
                                    <input type="checkbox" name="accept_terms" id="accept_terms" checked disabled>Accept Terms                                
								<p>&nbsp;</p>	
								<a style="" class="link_btn" href="<?php echo base_url();?>Doctorlogin/approverequest">Submit</a>
							</div>
							<?php } ?>
							<?php if($approve==1){ ?>
							<p class="text_green">Thanks for Joining us. We welcome you in the Telehealers`s Community!</p>
							<br>
							<p>&nbsp;&nbsp;</p>
							<p class="text_new">Your Account will be activated soon.</p>
							<?php } ?>
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


function preventBack() { 
window.history.forward(); 
}  
setTimeout("preventBack()", 0);  
window.onunload = function () { null };  


</script>	
</body>
</html>