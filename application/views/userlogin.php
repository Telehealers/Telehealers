<?php
    date_default_timezone_set(@$info->timezone->details);
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>web_assets2/css/main.css">
	<link href="<?php echo base_url()?>assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
	
	<link rel="stylesheet" href="<?php echo base_url();?>web_assets2/appointment/css/main.css">
    <link rel="stylesheet" href="<?php echo base_url();?>web_assets2/appointment/css/style.css">
	<link rel="" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js">
	
	 <link rel="icon" href="<?php echo (!empty(html_escape($info->fabicon->picture))?html_escape($info->fabicon->picture):null); ?>" type="image">
        <!-- Bootstrap -->
        <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- Pe-icon-7-stroke -->
        <link href="<?php echo base_url();?>assets/plugins/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
        <!-- style css -->
        <link href="<?php echo base_url();?>assets/dist/css/styleBD.css" rel="stylesheet" type="text/css"/>
        <!-- jQuery -->
        <script src="<?php echo base_url()?>assets/plugins/jQuery/jquery.min.js" type="text/javascript"></script>
	
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

        <!-- Content Wrapper -->
        <div class="login-wrapper" style="background:#FFF;">
     
            <div class="container-center">
                <div class="panel panel-bd">

                <?php 
                    $exception = $this->session->flashdata('exception');
                    if(!empty($exception)){
                             echo '<div class="alert alert-danger">
                            <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>WOPS!</strong> '.html_escape($exception).'
                          </div>';
                    }
                ?>

                    <div class="panel-heading">
                        <div class="view-header">
                            <div class="header-icon">
                                <i class="pe-7s-unlock"></i>
                            </div>
                            <div class="header-title">
                                <h3>Login</h3>
                                <small><strong><?php echo display('login_title');?></strong></small>
                            </div>
                        </div>
                    </div>
                   
                    <?php 
                        $result = $this->db->select('*')->from('web_pages_tbl')->where('name','footer_logo')->where('status',1)->get()->row();
                    ?>

                    <div class="panel-body">
                        <?php
                            $attributes = array('role'=>'form');
                            echo form_open_multipart('authentication', $attributes); 
                        ?>

                                <div class="form-group">
								    <div id="meserr" style="color:red;"></div>
                                    <input class="form-control" id="phone" placeholder="Mobile Number" name="phone" type="text" required pattern="[1-9]{1}[0-9]{9}" />
                                     <span class="text-danger"></span>
                                </div>
								<div class="form-group" id="otp_field" style="display:none;">
								    <div id="meserr" style="color:red;"></div>
                                    <input class="form-control" id="otp" placeholder="Enter Otp" name="otp" type="text" required pattern="[1-9]{1}[0-9]{9}" />
                                     <span class="text-danger"></span>
                                </div>
								<div id="otpmess" style="color:green;"></div>
                                <button type="button" id="sendOtp" class="btn btn-lg btn-success btn-block">Send OTP</button>
								<button type="button" id="login" style="display:none;" class="btn btn-lg btn-success btn-block">Login</button>
                                <input type="hidden" id="base_url" value="<?php echo base_url()?>">
                        </form>
                    </div>
					<span style="text-align:center;width: 100%;float: left;margin-top: 20px;"><a href="<?php echo base_url();?>">Go to site</a></span>
                </div>
            </div>
        </div>

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
$(document).ready (function () {
	$("#phone").keypress (function (event) {
		var charLength = $(this).val().length;
		if(charLength < 11){
			if ((event.which < 32) || (event.which > 126)){
				return true; 	
			} 
			return jQuery.isNumeric ($(this).val () + String.fromCharCode (event.which));
		}else{
			return false;
		}
	});
	$("#otp").keypress (function (event) {
		var charLength = $(this).val().length;
		if(charLength < 4){
			if ((event.which < 32) || (event.which > 126)){
				return true; 	
			} 
			return jQuery.isNumeric ($(this).val () + String.fromCharCode (event.which));
		}else{
			return false;
		}
	});
	$('#sendOtp').click(function(){
		var base_url = $('#base_url').val();
		var phone = $('#phone').val();
		if(phone==""){
			$('#meserr').html('Please enter mobile number first');
		}else{
			$('#meserr').html('');
			$.ajax({
				url:base_url+'index.php/Patient/checkUser',
				method: 'post',
				data: {phone:phone},
				type: 'POST',
				success: function(response){
					if(response==0){
						$('#meserr').html('Incorrect Mobile number');		
					}else{
						$('#otp_field').css('display','block');
						$('#otpmess').html('Otp sent on your mobile number...');
						$('#sendOtp').hide();
						$('#login').show();
					}
					//$('#q_succ_msg').html('Your details has been submited successfully.');
					//$('#q_succ_msg').html(response);
				}
			});
		}
	});
	$('#login').click(function (){
		var base_url = $('#base_url').val();
		var phone = $('#phone').val();
		var otp = $('#otp').val();
		var msg = '';
		if(phone==""){
			msg += 'Please enter mobile number<br>';
		}
		if(otp==""){
			msg += 'Please enter Otp<br>';
		}
		if(msg!=""){
			$('#meserr').html(msg);	
		}else{
			$('#meserr').html('');
			$.ajax({
				url:base_url+'index.php/Patient/userLogin',
				method: 'post',
				data: {phone:phone,otp:otp},
				type: 'POST',
				success: function(response){
					if(response==0){
						$('#meserr').html('Incorrect Mobile number');		
					}else if(response==1){
						$('#meserr').html('You enter wrong Otp');		
					}else{
						window.location.href = 'Patient';
					}
					//$('#q_succ_msg').html('Your details has been submited successfully.');
					//$('#q_succ_msg').html(response);
				}
			});			
		}
	});
});
</script>

</body>
</html>
