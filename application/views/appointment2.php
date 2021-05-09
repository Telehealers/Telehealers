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

    
	
	
    

   <section class="multi_step_form appointment_page" style="min-height:400px; background-color:#FFF;">
		<?php 
			$mag = $this->session->flashdata('exception');
			if($mag !=''){

			echo $mag;
		}
			$patient_id = $this->session->flashdata('patient_id');
			$attributes = array('id' => 'msform', 'name'=>'app_form', 'onsubmit'=>'return validateForm()');
			
			//echo form_open('Appointment/appointment', $attributes);  
			echo form_open('Appointment/confirmation', $attributes);  

					
		?>
                        
                            <div class="heading">
                                <h2>Book an Appointment</h2>
                                <!--<p>In order to use this service, you have to complete this verification process</p>-->
                            </div>
							<div id="message_id" class=""></div>
							<fieldset id="book_popup_1">
								<!--<h3>Select Your Consultancy</h3>-->
								<!--<p>We will send you a SMS. Input the code to verify.</p>-->
								<div class="mb-5 more_btns">
									<ul>
									<?php 
									$i=0;
									if(is_array($service) && count($service)>0){
										foreach($service as $val){
											$i++;
											?>
											<li>
												<button type="button" class="btn_choose_sent bg_btn_chose_1">
													<input type="radio" name="service" value="<?php echo $val->title?>" <?php if($i==1){?>checked="checked" <?php } ?> /><?php echo $val->title?>
												</button>
											</li>
											<?php
										}
									}
									?>
									</ul><br>
									<?php if(is_array($language_arr) && count($language_arr)>0){
										foreach($language_arr as $val){
										?>
									<input type="checkbox" name="lang_set" id="lang_set" value="<?php echo $val;?>">&nbsp;<?php echo $val;?> &nbsp;&nbsp;&nbsp;&nbsp;
									<?php }} ?>
								</div>
								<button onClick="addService()" id="add_service" type="button" class="next action-button">Continue</button>  
							</fieldset>
                            
							<fieldset id="book_popup_3" class="mt-5">
                                <h3>Appointment Type</h3>
                                
                                <div class="mb-5 more_btns">
									<ul>
										<!--<li>
											<button type="button" class="btn_choose_sent bg_btn_chose_1">
												<input type="radio" name="app_val" value="1" checked />Immediately 
											</button>
										</li>-->
										<li>
											<button type="button" class="btn_choose_sent bg_btn_chose_1">
												<input checked type="radio" name="app_val" value="2" />Schedule Appointment
											</button>
										</li>
									</ul>
								</div>
                                <button type="button" class="action-button previous_button">Back</button>
								<button id="app_type" onClick="setDoctor()" type="button" class="next action-button">Continue</button>  
								<div id="app_type_btn" style="display:none;"><button id="app_type_btn2" type="button" class="next action-button">Continue</button> </div>
							</fieldset>
							
							
							<fieldset id="book_popup_6" class="mt-5">
                                <!--<h3>Book an Appointment</h3>-->
                                <!--<p>We will send you a SMS. Input the code to verify.</p>-->
								
								<input type="hidden" name="service1" id="service1" value="" >
								<input type="hidden" name="service2" id="service2" value="" >
								<input type="hidden" name="service3" id="service3" value="" >
								<input type="hidden" name="service4" id="service4" value="" >
								<input type="hidden" name="service5" id="service5" value="" >
								<input type="hidden" name="app_type_val" id="app_type_val" value="" >
								<input type="hidden" name="doc_idd" id="doc_idd" value="" >
								<input type="hidden" name="slot_idd" id="slot_idd" value="" >
								<input type="hidden" name="sh_idd" id="sh_idd" value="" >
                                <div class="form">
								<div class="input-group" id="">
                                        <select style="padding:10px;" onchange="" class="form-control" required name="appointment_for" id="appointment_for" required>
											<option value="">--Appointment For--</option>
											<option>Self</option>
											<option>Father</option>
											<option>Mother</option>
											<option>Brother</option>
											<option>Sister</option>
											<option>Other</option>
										</select>
									</div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                        <div class="input-group">
											<input type="text" required name="p_name" id="p_name" placeholder="name">
										</div>
                                        </div>
                                        <div class="col-md-6">
                                             <div class="input-group">
												<input type="email" required name="p_email" id="p_email" placeholder="email">
												<div id="email_msg" style="width:100%;"></div>
											</div>
                                        </div>
										<div class="col-md-6">
                                        <div class="input-group">
											<!--<select class="form-control" style="padding:10px;" name="p_age" required="required" id="p_age">
													<option value="">Age</option>
													<?php for($i=1;$i<=130;$i++){?>
													<option><?php echo $i; ?> Year</option>
													<?php } ?>
												</select>-->
											<input placeholder="Age" type="number" min="1" max="130" name="p_age" id="p_age" required="required">	
										</div>
                                        </div>
                                        <div class="col-md-6">
                                             <div class="input-group">
												<select class="form-control" style="padding:10px;" required="required" name="p_gender" id="p_gender">
												    <option value="">Gender</option>
													<option>Male</option>
													<option>Female</option>
													<option>Other</option>
												</select>
											</div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
											<input type="tel" required name="p_phone" id="p_phone" placeholder="phone">
											</div>
                                        </div>
                                        <div class="col-md-6" id="appDate">
                                            <div class="input-group">
                                        <input onClick="resetVenue()" type="date" required name="p_date" class="datepicker3" id="p_date" placeholder="date">
                                    </div>
                                        </div>
                                    </div>
                                    
                                    <div class="input-group" id="loadsche">
                                        <select style="padding:10px;" onchange="loadSchedul()" class="form-control" required name="venue_id" id="venue_id" required>
											<option value="">--Select Mode--</option>
											<?php foreach ($venue as $value) {
												echo '<option value="'.html_escape($value->venue_id).'">'.html_escape($value->venue_name).'</option>';
											} ?>
										</select>
										<div class="schedul1" style="width:100%; float:left; clear:both; margin-top:20px;"></div>
                                    </div>
                                    <div class="input-group">
                                        <textarea maxlength="200" type="message" name="problem" id="problem" placeholder="Tell us your symptom or health problem..." required="required"></textarea>
                                    </div>
                                    <div class="input-group">
                                        <input type="checkbox" class="term_con_btn" name="term_condition" value="1" disabled checked="checked" id="term_condition">&nbsp;&nbsp;<a href="<?php echo base_url();?>terms" target="_blank" style="text-decoration:underline;">I agree to the Tele medicine Terms & Conditions</a>
                                    </div> 
                                </div>
                            <input type="hidden" name="existing_user" id="existing_user" value="">
							<button type="button" class="action-button previous_button">Back</button>
							<button type="submit" id="bb_app" onClick="return setSlot()" class="action-button"><?php echo display('appointment');?></button>  
							
						</fieldset>
                        <?php echo form_close();?>
                    </section>

    
					<section id="home1" class="home_slider mb-5">
        <div class="container">
            <div id="home_main_slider" class="owl-carousel owl-theme">
			<?php 
                  foreach ($slider as  $value) {
                ?>
                <div class="item">
                    <div class="product-item">
                        <div class="carousel-thumb">
						
                            <div class="row">
                                <div class="col-lg-12 order_2">
                                    <div class="slider_img" style="text-align:center;">
                                        <img src="<?php echo (!empty($value->picture)?$value->picture:null); ?>" alt="Better mental health begins with" style="display:inline-block; width:65%;" />
                                        <br>
                                    </div>
                                     <!--<div class="slider_content" style="text-align:center; padding-top:0px;"><?php echo $value->details; ?></div>-->
                                </div>
                            </div>
					    </div>
                    </div>
                </div>
			 <?php } ?>	
		    </div>
        </div>
    </section>
	

    

    

    
	
	
	
    <?php $this->load->view('footer.php')?>
	
	
	<div id="patient_type" style="display:none;">
	<fieldset id="book_popup_4" class="book_popup_4 mt-5">
                                <h3>Covid Consultancy</h3>
                               
                                <div class="quwstions">
                                    <div class="form">
                                        <div class="question_answer">
                                            <div class="input-group">
                                                <label for="question">1:- List the symptoms present in last 14 days</label>
                                                <ul>
                                                    <li><input type="checkbox" name="symptoms" value="Fever" />Fever</li>
                                                    <li><input type="checkbox" name="symptoms" value="Cough" />Cough</li>
                                                    <li><input type="checkbox" name="symptoms" value="Running nose" />Running nose</li>
                                                    <li><input type="checkbox" name="symptoms" value="Throat pain" />Throat pain</li>
													<li><input type="checkbox" name="symptoms" value="Breathlessness" />Breathlessness</li>
													<li><input type="checkbox" name="symptoms" value="Chest Pain" />Chest Pain</li>
													<li><input type="checkbox" name="symptoms" value="Loss of small-taste" />Loss of small/taste</li>
													<li><input type="checkbox" name="symptoms"  value="Diarrhoea" />Diarrhoea</li>
													<li><input type="checkbox" name="symptoms" value="Abdominal Pain" />Abdominal Pain</li>
													<li><input type="checkbox" name="symptoms" value="Bleeding Tendency"  />Bleeding Tendency</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form">
                                        <div class="question_answer">
                                            <div class="input-group">
                                                <label for="question">2:- Comorbidity Present</label>
                                                <ul>
                                                    <li><input type="checkbox" name="comorbidity" value="Chronic lung" />Chronic lung</li>
                                                    <li><input type="checkbox" name="comorbidity" value="Heart disease"/>Heart disease</li>
                                                    <li><input type="checkbox" name="comorbidity" value="Liver disease"/>Liver disease</li>
                                                    <li><input type="checkbox" name="comorbidity" value="Kidney disease"/>Kidney disease</li>
													<li><input type="checkbox" name="comorbidity" value="Neurological disease"/>Neurological disease</li>
													<li><input type="checkbox" name="comorbidity" value="Blood discover"/>Blood discover</li>
													<li><input type="checkbox" name="comorbidity" value="Immunological"/>Immunological</li>
													<li><input type="checkbox" name="comorbidity"value="Morbid obesity" />Morbid obesity</li>
													<li><input type="checkbox" name="comorbidity" value="Malignancy"/>Malignancy</li>
													<li><input type="checkbox" name="comorbidity" value="Uncontrolled HTN"/>Uncontrolled HTN</li>
													<li><input type="checkbox" name="comorbidity" value="Dm"/>Dm</li>
													<li><input type="checkbox" name="comorbidity" value="HIV"/>HIV</li>
													<li><input type="checkbox" name="comorbidity" value="On long term immunosuppressant"/>On long term immunosuppressant </li>
													<li><input type="checkbox" name="comorbidity" value="NSAIDS"/>NSAIDS</li>
													<li><input type="checkbox" name="comorbidity" value="Pregnancy" />Pregnancy</li>
													<li><input type="checkbox" name="comorbidity" value="Age>60 years" />Age>60 years</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                <button type="button" class="action-button previous_button">Back</button>
								<button type="button" onclick="setstm()" class="next action-button">Continue</button>  
							</fieldset>
							</div>
<div id="userdiv" style="display:none;">
<fieldset id="book_popup_11" class="book_popup_11">
		<h3>Patient Type</h3>
		<div class="mb-5 more_btns">
			<ul>
				<li>
					<button type="button" class="btn_choose_sent bg_btn_chose_1">
						<input type="radio" checked="checked" name="p_type" value="1" />New Patient
					</button>
				</li>
				<!--<li>
					<button type="button" class="btn_choose_sent bg_btn_chose_2">
						<input type="radio" name="p_type" value="2" />Old Patient
					</button>
				</li>-->
			</ul>
		</div>
		<button type="button" class="action-button previous_button">Back</button>
		<button type="button" id="add_patient2" onClick="setform()" class="next action-button">Continue</button> 
	</fieldset>
</div>			
<div id="doctor_type" style="display:none;">
<fieldset id="book_popup_5" class="mt-5 doctor_section">
<h3>Select Doctor</h3><br>
<div class="doctors_list">
	
</div>
<button type="button" class="action-button previous_button">Back</button>
<button type="button" onClick="addDoctor()" class="next action-button">Continue</button>  
</fieldset>
</div>

<div id="service_type_main" style="display:none;">
	<fieldset id="book_popup_2">
		<h3>Select your Service</h3>
		<!--<p>We will send you a SMS. Input the code to verify.</p>-->
		<div class="mb-5 more_btns">
		<ul id="service_type">
			
		</ul>
		</div>
		<button type="button" class="action-button previous_button">Back</button>
		<button id="add_servicetype" type="button" class="next action-button">Continue</button>  
	</fieldset>
</div>
<input type="hidden" id="base_url" value="<?php echo base_url()?>">
	<script src="<?php echo base_url();?>web_assets2/js/jquery.js"></script>
    <script src="<?php echo base_url();?>web_assets2/js/bootstrap.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.2/js/intlTelInput.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js'></script>
    
    <script src="<?php echo base_url();?>web_assets2/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url();?>web_assets2/js/main.js"></script>
    <script src="<?php echo base_url();?>web_assets2/js/all.min.js"></script>
	<script src="<?php echo base_url()?>assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>web_assets2/js/custom.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>web_assets2/js/home_footer.js"></script>
	
	
    
    <script src="<?php echo base_url();?>web_assets2/appointment/js/script.js"></script>
	
<script>
$(document).ready(function(){
	
	$('#p_name').keypress(function (e) {
		var charLength = $(this).val().length;
		var regex = new RegExp("^[a-zA-Z ]+$");
		var strigChar = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if (regex.test(strigChar)) {
			if(charLength < 21){
			return true;
			}
		}  
		return false;
	});
	$('#p_phone').keypress(function (e) {
		var charLength = $(this).val().length;
		if(charLength < 10){
			return true;
		}else{
			return false;	
		} 
	});
	
	

	$("#p_phone").keypress (function (event) {
        if ((event.which < 32) || (event.which > 126)) return true; 
        return jQuery.isNumeric ($(this).val () + String.fromCharCode (event.which));
    });
	
	$('#contact_us').click(function(){
		var full_name    = $('#full_name').val();
		var email_id     = $('#email_id').val();
		var subject      = $('#subject').val();
		var message      = $('#message').val();
		var captchdas    = '<?php echo $hello; ?>';
		var captcha_code = $('#captcha_code').val();
		var base_url = $('#base_url').val();
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
				url:base_url+'index.php/Welcome/contactEmail',
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
	
	
    $(document).on("click","#add_service", function(){		
		var services =	$('input[name="service"]:checked').val();
		var base_url = $('#base_url').val();
	//	$('.multi_step_form .book_popup_11').remove();
		if(services==""){
			alert("Please select service first");
			return false;
		}
		if(services=="Covid Consultancy"){
		//	var getHtml = $('#userdiv').html();
		//	$(getHtml).insertAfter('#book_popup_2');
		}else{
		//	$('.multi_step_form .book_popup_11').remove();
		}
		$.ajax({
			url:base_url+'index.php/Welcome/getservicetype',
			method: 'post',
			data: {services:services},
			type: 'POST',
			success: function(response){
				//alert(response);
				$('#service_type').html(response);
			}
		});
		$('#service1').val(services);	
	});
	
	
	$(document).on("click","#add_servicetype", function(){	
		var servicestype =	$('input[name="servicetype"]:checked').val();
		var base_url = $('#base_url').val();
		var lang_set_val =	$('#service3').val();
		
		$('#service2').val(servicestype);
		//alert('servicestype--'+servicestype)
		if(servicestype==""){
			alert("Please select service type first");
			return false;
		}
		/* $.ajax({
			url:'http://telehealers.in/index.php/Welcome/getservicetypedoctor',
			method: 'post',
			data: {servicestype:servicestype},
			type: 'POST',
			success: function(response){
				alert(response);
				$('#service_type').html(response);
			}
		}); */
		$.ajax({
			url:base_url+'index.php/Welcome/getdoctorforappointment',
			method: 'post',
			data: {servicestype:servicestype,lang_set_val:lang_set_val},
			type: 'POST',
			success: function(response){
				//alert(response);
				$('#book_popup_5 .doctors_list').html(response);
								
			}
		});
	});
	
	
	$(document).on("click","#app_type", function(){
	    	
	});
	
    $(document).on("click",".add_patient2", function(){   
	    $('.multi_step_form .book_popup_4').remove();
		var p_type =	$('input[name="p_type"]:checked').val();
		//alert(p_type);
		if(p_type == 1){
			var getHtml = $('#patient_type').html();
			$(getHtml).insertAfter('#book_popup_11');
		}	
		if(p_type == 2){
			$('.multi_step_form .book_popup_4').remove();
		}	
	});
	$(document).on("change","#p_email_old",function(){
		var email = $(this).val();
		base_url = $('#base_url').val();
		$.ajax({
			url:base_url+'index.php/Welcome/getPatientDetails',
			method: 'post',
			data: {email:email},
			type: 'POST',
			success: function(response){
				//alert(response);
				if(response!=""){
				    if(response==1){
				        $('#email_msg').html('<span style="color:red;float:left;">This email ID already Used!</span><span style="color:green;float:right;cursor:pointer;font-size:10px;" onclick="setfields()">To change in existing details like age, name, sex, click here</span>');
				        $('#bb_app').hide();
				        
				    }else if(response==2){
				        $('#email_msg').html('<span style="color:red;float:left;">This email ID already Used!</span><span style="color:green;float:right;cursor:pointer;font-size:10px;" onclick="setfields()">To change in existing details like age, name, sex, click here</span>');
				        $('#bb_app').hide();
				        
				    }else{
				        $('#bb_app').show();
    					var p_data = response.split(',');
    					var p_name = p_data[0];
    					var p_phone = p_data[1];
    					var p_sex = p_data[2];
    					var p_age = p_data[3];
    					$('#p_name').val(p_name);
    					$('#p_name').attr("disabled", true);
    					$('#p_phone').val(p_phone);
    					$('#p_phone').attr("disabled", true);
    					$('#p_gender').val(p_sex);
    					$('#p_gender').attr("disabled", true);
    					$('#p_age').val(p_age);
    					$('#p_age').attr("disabled", true);
    					$('#email_msg').html('<span style="color:red;float:left;">Existing Patient</span><span style="color:green;float:right;cursor:pointer;font-size:10px;" onclick="setfields()">To change in existing details like age, name, sex, click here</span>');
    					$('#p_date').focus();
    					$('#existing_user').val(1);
				    }
				}else{
				    $('#bb_app').show();
					//$('#p_name').val('');
					$('#p_phone').val('');
					$('#p_gender').val('');
					$('#p_age').val('');
					$('#p_name').attr("disabled", false);
					$('#p_phone').attr("disabled", false);
					$('#p_gender').attr("disabled", false);
					$('#p_age').attr("disabled", false);
					$('#email_msg').html('<span style="color:green;float:left;">New Patient</span>');
					$('#existing_user').val(0);
				}
				//$('#book_popup_5 .doctors_list').html(response);
								
			}
		});
	});
	$( ".datepicker3" ).datepicker({ minDate: 0});
});

$( document ).ajaxComplete(function() {
	//verificationForm();
	var current_fs, next_fs, previous_fs; //fieldsets
        var left, opacity, scale; //fieldset properties which we will animate
        var animating; //flag to prevent quick multi-click glitches


	
	/*$(".add_patient2").click(function () {	
		var p_type =	$('input[name="p_type"]:checked').val();
		//alert(p_type);
		if(p_type == 1){
			var getHtml = $('#patient_type').html();
			$(getHtml).insertAfter('#book_popup_11');
		}	
		if(p_type == 2){
			$('.multi_step_form .book_popup_4').remove();
		}	
	});
	*/
	
		
	
	
	
		$(document).on("click",".next1", function(){
            if (animating) return false;
            animating = true;

            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            //activate next step on progressbar using the index of next_fs
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function (now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale current_fs down to 80%
                    scale = 1 - (1 - now) * 0.2;
                    //2. bring next_fs from the right(50%)
                    left = (now * 50) + "%";
                    //3. increase opacity of next_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({
                        'transform': 'scale(' + scale + ')',
                        'position': 'absolute'
                    });
                    next_fs.css({
                        'left': left,
                        'opacity': opacity
                    });
                },
                duration: 600,
                complete: function () {
                    current_fs.hide();
                    animating = false;
                },
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });
        });
		
		$(document).on("click",".previous_button", function(){
			$('#message_id').html('');
		});	
		$(document).on("click",".previous_button1", function(){
            if (animating) return false;
            animating = true;
			
			

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //de-activate current step on progressbar
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();
            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function (now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale previous_fs from 80% to 100%
                    scale = 0.8 + (1 - now) * 0.2;
                    //2. take current_fs to the right(50%) - from 0%
                    left = ((1 - now) * 50) + "%";
                    //3. increase opacity of previous_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({
                        'left': left
                    });
                    previous_fs.css({
                        'transform': 'scale(' + scale + ')',
                        'opacity': opacity
                    });
                },
                duration: 600,
                complete: function () {
                    current_fs.hide();
                    animating = false;
                },
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });
        });
		
		$(".submit").click(function () {
            return false;
        })
		
});
function setform(){
	//alert('hello...');
	var p_type =	$('input[name="p_type"]:checked').val();
	$('.multi_step_form .book_popup_4').remove();
	//alert(p_type);
	if(p_type == 1){
		var getHtml = $('#patient_type').html();
		$(getHtml).insertAfter('#book_popup_11');
		//$('#add_patient2').addClass('next');
		//$('#add_patient2').trigger('click');
	}	
	if(p_type == 2){
		$('.multi_step_form .book_popup_4').remove();
	}	
}
function setDoctor(){
	//$('#app_type').addClass('next');
	base_url = $('#base_url').val();
	$('.multi_step_form #book_popup_5').remove();
	var p_type =	$('input[name="app_val"]:checked').val();
	$('#app_type_val').val(p_type);
	//alert(p_type);
	if(p_type == 2){
		var getHtml = $('#doctor_type').html();
		$(getHtml).insertAfter('#book_popup_3');
		//$('#app_type').addClass('next');
		//$('#app_type').trigger('click');
		//$('#app_type_btn #app_type_btn2').trigger('click');
		$('#appDate').show();
		$('#loadsche').show();
	}	
	if(p_type == 1){
		$('.multi_step_form #book_popup_5').remove();
		$('#appDate').hide();
		$('#loadsche').hide();
		let today = new Date().toISOString().substr(0, 10);
		document.querySelector("#p_date").value = today;
		$('#venue_id').val(3);
		var servicestype =	$('input[name="servicetype"]:checked').val();
		var lang_set_val =	$('#service3').val();
		$.ajax({
			url: base_url+'index.php/Welcome/getservicetypedoctorforimmde',
			method: 'post',
			data: {servicestype:servicestype,lang_set_val:lang_set_val},
			type: 'POST',
			success: function(response){
				//alert(response);
				if(response==0){
					$('#bb_app').hide();
					$('#message_id').html('<span style="color:red;">No doctor available at this time please make a Schedule Appointment.</span>');
					
				}else{
					//$('#message_id').html(response);
					$('#bb_app').show();
					$('#message_id').html('');
					var str = response.split(',');
					var d_id = str[0];
					var s_id = str[1];
					var sh_id = str[2];
					$('#doc_idd').val(d_id);
					$('#slot_idd').val(s_id);
					$('#sh_idd').val(sh_id);
				}
				//$('#service_type').html(response);
			}
		});
	}
}
function setstm(){
	//var symptoms =	$('input[name="symptoms"]:checked').val();
	//var energy = symptoms.join(',');
	
	const selectedValues = $('input[name="symptoms"]:checked').map( function () { 
        return $(this).val(); 
    })
    .get()
    .join(', ');
	//alert(selectedValues);
	$('#service3').val(selectedValues);
	const selectedValues2 = $('input[name="comorbidity"]:checked').map( function () { 
        return $(this).val(); 
    })
    .get()
    .join(', ');
	//alert(selectedValues);
	$('#service4').val(selectedValues2);
}
function addDoctor(){
	var doctor_id =	$('input[name="doctor_id"]:checked').val();
	$('#service5').val(doctor_id);
}
function resetVenue(){
	$('#venue_id').val('');
	$('.schedul1').html('');
	$('#ui-datepicker-div').hide();
	var r = $('#p_date').val();
	
	//alert(r);
}
function addService(){
	var services =	$('input[name="service"]:checked').val();
	
	const selectedValues = $('input[name="lang_set"]:checked').map( function () { 
        return $(this).val(); 
    })
    .get()
    .join(', ');
	//alert(selectedValues);
	$('#service3').val(selectedValues);
	
	
	if(services=="Consultation for COVID-19"){
		$('.multi_step_form #book_popup_2').remove();
		setTimeout(function(){ 
			$('#add_servicetype').trigger('click');
		}, 1000);
	}else{
		var getHtml = $('#service_type_main').html();
		$(getHtml).insertAfter('#book_popup_1');
		$('#book_popup_2').removeAttr("style");
	}
}
function setSlot(){
	var time_slot = $('#serial_no').val();
	if(typeof time_slot === 'undefined'){
		$('#bb_app').attr("disabled", true);
		$('#bb_app').addClass("btn_disable");
		$('#message_id').addClass('alert alert-danger');
		$('#message_id').html('Kindly fill the information Correctly!');
	}else{
		$('#bb_app').attr("disabled", false);
		if(time_slot==""){
			$('#bb_app').attr("disabled", true);
			$('#bb_app').addClass("btn_disable");
			$('#msg_c').html('<div class="col-md-12"><div class="alert alert-danger">Please select appointment time slot</div></div>');
			return false;
		}	
	}
	
	
}
function setfields(){
	$('#p_name').attr("disabled", false);
	$('#p_phone').attr("disabled", false);
	$('#p_gender').attr("disabled", false);
	$('#p_age').attr("disabled", false);
}

function preventBack() { 
window.history.forward(); 
}  
setTimeout("preventBack()", 0);  
window.onunload = function () { null };  


</script>	
</body>
</html>