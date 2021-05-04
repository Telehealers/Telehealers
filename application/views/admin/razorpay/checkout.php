<?php
   // date_default_timezone_set(@$info->timezone->details);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?php echo (!empty(html_escape($info->fabicon->picture))?html_escape($info->fabicon->picture):null); ?>" type="image">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>web_assets2/css/main.css">
	<link href="<?php echo base_url()?>assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
	
	<link rel="stylesheet" href="<?php echo base_url();?>web_assets2/appointment/css/main.css">
    <link rel="stylesheet" href="<?php echo base_url();?>web_assets2/appointment/css/style.css">
	<link rel="" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js">
	
	<link href="<?php echo base_url(); ?>assets/public_css/style2.css" rel="stylesheet">
	<script src="<?php echo base_url(); ?>web_assets/js/print_preview.js"></script>
       
        <link href="<?php echo base_url(); ?>web_assets/css/inline.css" rel="stylesheet">

	<title><?php echo $meta_info[0]['page_title']; ?></title>
	<meta name="keywords" content="<?php echo $meta_info[0]['meta_keywords']; ?>">
	<meta name="description" content="<?php echo $meta_info[0]['meta_description']; ?>">
	
	
</head>


<body>
<header class="header">
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-8">
                        <div class="top_content">
                            <!--<p>Certifiedd Therapists from AIIMS Delhi | <a href="#">Join Mental Health</a></p>-->
                            <p><?php //echo (!empty(html_escape($info->phone->details))?html_escape($info->phone->details):null); ?> <a href="#"><?php echo (!empty(html_escape($info->email->details))?html_escape($info->email->details):null); ?></a></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-4">
                        <div class="top_social">
                            <ul>
                                <li>
                                    <a href="<?php echo (!empty(html_escape($info->facebook->details))?html_escape($info->facebook->details):null); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li>
                                    <a href="<?php echo (!empty(html_escape($info->twitter->details))?html_escape($info->twitter->details):null); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="<?php echo (!empty(html_escape($info->youtube->details))?html_escape($info->youtube->details):null); ?>" target="_blank"><i class="fab fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="menubar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="navbar navbar-expand-md">
                            <div class="container-fluid">
                                <a class="navbar-brand" href="<?php echo base_url()?>">
                                    <img src="<?php echo (!empty(html_escape($info->logo->picture))?html_escape($info->logo->picture):null); ?>" alt="Logo" />
                                </a>
                                <div class="buttonmenu">
                                    <input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
                                    <label for="openSidebarMenu" class="sidebarIconToggle">
                                      <div class="spinner diagonal part-1"></div>
                                      <div class="spinner horizontal"></div>
                                      <div class="spinner diagonal part-2"></div>
                                    </label>
                                </div>
                                <div class="main_menu_custom" id="custom_menu">
                                    <ul class="navbar-nav ml-auto ">
                                        <li class="active">
                                            <a href="#home">Home</a>
                                        </li>
                                        <!--<li class="dropdown">
                                            <a href="#" class="dropdown-toggle dropdown-item" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Case Studies</a>
                                            <ul class="dropdown-content">
                                                <li>
                                                    <a href="#">Home</a>
                                                </li>
                                                <li>
                                                    <a href="#">About Us</a>
                                                </li>
                                                <li>
                                                    <a href="#">Blog</a>
                                                </li>
                                                <li>
                                                    <a href="#">Contact Us</a>
                                                </li>
                                            </ul>
                                        </li>-->
										
										<li><a href="<?php echo base_url();?>#about">About Us</a></li>
										<li><a href="<?php echo base_url();?>#doctors">Doctors</a></li>
										<li><a href="<?php echo base_url();?>Appointment">Appointment</a></li>
										<li><a href="<?php echo base_url();?>#testimonials">Testimonials</a></li>
										<li><a href="<?php echo base_url();?>blogs">Blog</a></li>
										<li><a href="<?php echo base_url();?>#faq">FAQs</a></li>
										<li><a href="<?php echo base_url();?>contact">Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
	
<div class="row" style="text-align:center;">

    <div class="col-lg-12">
        <h2>APPOINTMENT DETAILS:</h2>                 
    </div>
</div><!-- /.row -->
<?php
$itemInfo['price']=0;
$productinfo = $itemInfo['description'];
$txnid = time();
$surl = $surl;
$furl = $furl;        
$key_id = 'rzp_test_pUfIiVm0hM4yBD';
$currency_code = 'INR';            
$total = ($itemInfo['price']* 100); 
$amount = $itemInfo['price'];
$merchant_order_id = $itemInfo['product_id'];
$card_holder_name = '';
$email = '';
$phone = '';
$name = '';
$return_url = site_url().'admin/payment_method/Razorpay/callback';

?>
<div class="row" style="text-align:center;">
    <div class="col-lg-12">
        <?php if(!empty($this->session->flashdata('msg'))){ ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('msg'); ?>
            </div>        
        <?php } ?>
        <?php if(validation_errors()) { ?>
          <div class="alert alert-danger">
            <?php echo validation_errors(); ?>
          </div>
        <?php } ?>
    </div>
</div>
 <form name="razorpay-form" id="razorpay-form" action="<?php echo $return_url; ?>" method="POST">
  <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
  <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
  <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $productinfo; ?>"/>
  <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
  <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
  <input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="<?php echo $card_holder_name; ?>"/>
  <input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $total; ?>"/>
  <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?php echo $amount; ?>"/>
</form>
    <div class="row" style="text-align:center;">  
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
	&nbsp;
	</div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">                        
            <table class="table table-bordered table-hover table-striped print-table order-table" style="font-size:11px;">
                <tbody>                    
                    <tr>
                        <td class="text-left">Appointment ID</td>
                        <td class="text-left"><?php echo $info2->appointment_id;?></td>               
                    </tr>
					<tr>
                        <td class="text-left">Patient ID</td>
                        <td class="text-left"><?php echo $info2->patient_id;?></td>               
                    </tr>
					<tr>
                        <td class="text-left">Patient Name</td>
                        <td class="text-left"><?php echo $p_name;?></td>               
                    </tr>
					<tr>
                        <td class="text-left">Patient Email</td>
                        <td class="text-left"><?php echo $p_email;?></td>               
                    </tr>
					<tr>
                        <td class="text-left">Patient Phone</td>
                        <td class="text-left"><?php echo $p_phone;?></td>               
                    </tr>
					<tr>
                        <td class="text-left">Patient Age</td>
                        <td class="text-left"><?php echo $p_age;?></td>               
                    </tr>
					<tr>
                        <td class="text-left">Patient Gender</td>
                        <td class="text-left"><?php echo $p_gender;?></td>               
                    </tr>
					<tr>
                        <td class="text-left">Mode</td>
                        <td class="text-left"><?php echo $itemInfo['venue_name'];?></td>               
                    </tr>
					<!--<tr>
                        <td class="text-left">Service</td>
                        <td class="text-left"><?php echo $service1;?></td>               
                    </tr>-->
					<tr>
                        <td class="text-left">Service Mode</td>
                        <td class="text-left"><?php echo $service2;?></td>               
                    </tr>
					<!--<tr>
                        <td class="text-left">Venue Contact</td>
                        <td class="text-left"><?php echo $itemInfo['venue_contact'];?></td>               
                    </tr>
					<tr>
                        <td class="text-left">Venue Address</td>
                        <td class="text-left"><?php echo $itemInfo['venue_address'];?></td>               
                    </tr>-->
<tr>
                        <td class="text-left">Doctor Name</td>
                        <td class="text-left"><?php echo $itemInfo['doctor_name'];?></td>               
                    </tr>
					<tr>
                        <td class="text-left">Appointment Date</td>
                        <td class="text-left"><?php echo $info2->date;?></td>               
                    </tr>
<tr>
                        <td class="text-left">Appointment Time</td>
                        <td class="text-left"><?php echo $info2->sequence;?></td>               
                    </tr>
<tr>
                        <td class="text-left">Tell us your symptom or health problem</td>
                        <td class="text-left"><?php echo $info2->problem;?></td>               
                    </tr>
					<?php if($info2->service!="Consultation for COVID-19"){?>	
					<!--<tr>
                        <td class="text-left">Fees</td>
                        <td class="text-left"><?php echo $itemInfo['price'];?> INR</td>
				    </tr>-->
					<?php } ?>
                </tbody>                        
            </table>
        </div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
	&nbsp;
	</div>
    </div>

    <div class="row" style="text-align:center;display:none;" >
        <div class="col-lg-12">
            <a href="<?php print site_url();?>" name="reset_add_emp" id="re-submit-emp" class="btn btn-warning"><i class="fa fa-mail-reply"></i> Back</a>
            <input  id="submit-pay" type="submit" onclick="razorpaySubmit(this);" value="Pay Now" class="btn btn-primary" />
        </div>
    </div>

<footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="footer_content">
                        <div class="logo_menu">
                            <span><img src="<?php echo (!empty(html_escape($info->footer_picture->picture))?html_escape($info->footer_picture->picture):null); ?>" alt="#"/></span>
                             <ul>
                                <li><a href="<?php echo base_url();?>appointment">Appointment</a></li>
								<li><a href="<?php echo base_url();?>#about">About Us</a></li>
                                <li><a href="<?php echo base_url();?>#doctors">Doctors</a></li>
                                <li><a href="<?php echo base_url();?>#testimonials">Testimonials</a></li>
                                <li><a href="<?php echo base_url();?>blogs">Blog</a></li>
                                <li><a href="<?php echo base_url();?>#faq">FAQs</a></li>
                                <li><a href="<?php echo base_url();?>contact">Contact Us</a></li>
                            </ul>
                        </div>
                        <div class="footer_copyright">
                            <span class="copyright"><?php echo $info->copy_right->details; ?></span>
							<span class="f_address"><?php //echo $info->address->details; ?></span>
                            <!--<span class="like_ecom">Build with <i class="fas fa-heart"></i> by <a href="https://www.ecomsolver.com/" target="_blank">Ecomsolver</a></span>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

	</body>

<button id="rzp-button1" style="display:none;">Pay with Razorpay</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
<form name='razorpayform' action="<?php echo $return_url;?>" method="POST">
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_signature"  id="razorpay_signature" >
</form>
<script>
// Checkout details as a json
var options = <?php echo json_encode($r_data);?>;


/**
 * The entire list of Checkout fields is available at
 * https://docs.razorpay.com/docs/checkout-form#checkout-fields
 */
options.handler = function (response){
	//alert(JSON.stringify(response));
    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
    document.getElementById('razorpay_signature').value = response.razorpay_signature;
    document.razorpayform.submit();
};
// Boolean whether to show image inside a white frame. (default: true)
options.theme.image_padding = false;
options.modal = {
    ondismiss: function() {
        console.log("This code runs when the popup is closed");
    },
    // Boolean indicating whether pressing escape key 
    // should close the checkout form. (default: true)
    escape: true,
    // Boolean indicating whether clicking translucent blank
    // space outside checkout form should close the form. (default: false)
    backdropclose: false
};
var rzp = new Razorpay(options);
$(document).ready(function(){
  $("#rzp-button1").click();
   rzp.open();
    e.preventDefault();
});
</script>

</html>