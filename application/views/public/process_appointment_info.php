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
	
	<link href="<?php echo base_url(); ?>assets/public_css/style2.css" rel="stylesheet">
	<script src="<?php echo base_url(); ?>web_assets/js/print_preview.js"></script>
       
        <link href="<?php echo base_url(); ?>web_assets/css/inline.css" rel="stylesheet">
	
    <title><?php echo (!empty(html_escape($info->website_title->details))?html_escape($info->website_title->details):null); ?></title>
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

   
	
    

    

    <section id="theraphists" class="meat_our_team appointment_shw">
        <div class="container app_text">
            <div class="row">
                <div class="col-md-12">
                    
               <?php 
			   //echo "<pre>";print_r($patient_info);
			   //echo "<pre>";print_r($appointmentData);
			   //echo "<pre>";print_r($info);
			   //die();
			   ?>     
                    
              
 <div id="div1">

	<div class="container" >
		<div class="row ccc" >
			<div class="sec-title colored text-center">
				<p class="h2">Appointment Details:</p>
			</div>


	<div class="row inners">
	
		<!--<div class="col-md-6">
			<div class="information-details"  >
				<ul>
					<li>patient Id : <span class="pull-right"> <?php echo $patient_info['patient_id'];?></span></li>
					<li>Patient Name : <span class="pull-right"> <?php echo $patient_info['patient_name'];?></span></li>
					<li>Patient Email ID: <span class="pull-right small_text"> <?php echo $patient_info['patient_email'];?></span></li>
					<li>Patient Phone : <span class="pull-right"> <?php echo $patient_info['patient_phone'];?></span></li>
					<li>Gender : <span class="pull-right"> <?php echo $patient_info['sex'];?></span></li>
					<li>Age : <span class="pull-right"> <?php echo $patient_info['age'];?></span></li>
					<li>Complaint : <span class="pull-right"> <?php echo $appointmentData['problem'];?></span></li>
				</ul>
			</div>
		</div>
		<div class="col-md-6">
			<div class="information-details">
				<ul>
					<li>Appointment ID : <span class="pull-right"> <?php echo $appointmentData['appointment_id'];?></span></li>
					<li>Doctor Name : <span class="pull-right"> <?php echo $appointmentData['doctor_name'];?></span></li>
					<li>Date: <span class="pull-right"> <?php echo $appointmentData['date'];?></span></li>
					<li>Time : <span class="pull-right"> <?php echo $appointmentData['sequence'];?></span></li>
					<li>Mode : <span class="pull-right"> <?php echo $appointmentData['venue_name'];?></span></li>
					<li>Service Type : <span class="pull-right"> <?php echo $appointmentData['servicetype'];?></span></li>
				</ul>
			</div>
		</div>-->
		
		<?php
		$app_time = date('h:i A', strtotime($appointmentData['sequence']));
		$app_date = date('jS F Y',strtotime($appointmentData['date']));
		?>
		
		<div class="col-md-12">
		
<p>&nbsp;</p>
<p>Dear <strong><?php echo $patient_info['patient_name'];?>,</strong></p>
<p>We have received your request of appointment with  <strong><?php echo $appointmentData['doctor_name'];?></strong> on <strong><?php echo $app_date;?> at <?php echo $app_time;?></strong>. Please try to be available 15 minutes early and keep your IMPORTANT-DOCUMENTS with you related to your Previous or ongoing medications. </p>
<p>&nbsp;</p>
<p><strong>Meeting Details:</strong></p>
<p>Patient ID - <?php echo $patient_info['patient_id'];?></p>
<p>Appointment ID - <?php echo $appointmentData['appointment_id'];?></p>
<p><strong>Other details:-</strong> </p>
<p>Phone - <?php echo $patient_info['patient_phone'];?></p>
<p>Age - <?php echo $patient_info['age'];?></p>
<p>Gender - <?php echo $patient_info['sex'];?></p>
<p>&nbsp;</p>
If you have any questions or need to reschedule, please write us at [telehealers@gmail.com]. Otherwise, we look forward to seeing you on [<?php echo $app_date;?>-<?php echo $app_time;?>].
<p>&nbsp;</p>
Have a wonderful day!
<p>&nbsp;</p>
<p>Warm regards,</p>
<p>Telehealers.in</p>

		</div>
		
	</div>
	
	<?php 
		$fees = $appointmentData['fees'];
		if($fees=="" || $fees==0){
			$SQL3 = "select * from payment_account_setup where set_up_id = '1'";
			$query3 = $this->db->query($SQL3);
			$result3 = $query3->result_array();
			if(is_array($result3) && count($result3)>0){
				$fees = $result3[0]['amount'];
			}  
		}
	?>
	<?php if($appointmentData['service']=="Consultation for COVID-19"){?>
	<input type="hidden" id="coupon_code" value="Covidhelp" />
	<?php }else{?>
	<input type="hidden" id="coupon_code" value="Covidhelp" />
	<!--<div class="row">
		<div class="col-md-12">
			<div class="information-details">
				<ul> 
					<li>Appointment Price : Rs. <span id="ap_price"><?php echo $fees;?></span></li>
					<span style="display:none;" id="ap_price_price"><?php echo $fees;?></span>
				</ul>	
			</div>	
		</div>
		
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="information-details">
				<ul> 
					<li>Coupon Code :</li>
				</ul>	
			</div>	
		</div>
		<div class="col-md-4">
			<div class="information-details">
			<ul> 
			<li><input type="text" id="coupon_code" /></li>
			</ul>	
			</div>
		</div>
		<div class="col-md-4">
			<div class="information-details">
			<ul> 
			<li><span class="appoimentbtn"><a id="coupon_code_btn" class="popup_btn d-inline-block" href="javascript:void(0)">Apply</a></span></li>
			</ul>	
			</div>
		</div>
	</div>-->
	
	<?php } ?>
	
	<div class="row">
		<div class="col-md-12">
			<div class="information-details">
				<ul> 
					<li id="errorMsg"></li>
				</ul>	
			</div>
		</div>
	</div>

    

						
					</div>
				</div>
		


		</div>

		 
                    
                    
                    
                    
                    
                    
                </div>
				 
			
            </div>
        </div>
		
    </section>
	
	

    

    

    
	
	
	
        
	
	

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
                                <li><a href="<?php echo base_url();?>#contact">Contact Us</a></li>
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
$(document).ready(function() {
      window.history.pushState(null, "", window.location.href);        
      window.onpopstate = function() {
          window.history.pushState(null, "", window.location.href);
      };
  });
  
$(document).ready(function(){
	
  
	$('#coupon_code_btn').click(function(){
		var coupon_code = $('#coupon_code').val();
		var baseUrl = $('#baseUrl').val();
		if(coupon_code==""){
			//alert('Please Enter Coupon Code');
			$('#errorMsg').html('Please Enter Coupon Code');
		}else{
			$.ajax({
				url:baseUrl+'index.php/appointment/getpromocodeprice',
				method: 'post',
				data: {coupon_code:coupon_code},
				type: 'POST',
				success: function(response){
					//alert(response);
					if(response.trim()==0){
						//alert('Wrong Coupon Code');
						$('#errorMsg').html('Wrong Coupon Code');
					}else if(response.trim()==1){
						//alert('Coupon Code Limit reached');
						$('#errorMsg').html('Coupon Code Limit reached');
					}else{
						$('#errorMsg').html('');
						var er = $('#ap_price_price').html();
						var f_price = er - response;
						if(f_price==0){
							$('#setCoupon').text('Book Appointment');
						}else{
							$('#setCoupon').text('Make A Payment');
						}
						$('#ap_price').html(f_price);
						
					}
					//$('#q_succ_msg').html('Your details has been submited successfully.');
					
				}
			});
		}
	});
	$('#setCoupon').click(function(){
		var coupon_code = $('#coupon_code').val();
		$('#coupon_code_f').val(coupon_code);
		$('#msform').submit();
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