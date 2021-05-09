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


	
        

	<div class="patient_table">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="sidebar">
                            <div class="user_info">
							<?php
							if($patient_info[0]['picture']!=""){
								?>
								<img src="<?php echo html_escape($patient_info[0]['picture']);?>">
								<?php
							}else{
								?>
								<img src="<?php echo base_url(); ?>assets/images/male.png" alt="#">
								<?php
							}
							?>
                                
                                 <p><?php echo $patient_info[0]['patient_name'];?></p>
                            </div>
                            <div class="side_menu_list">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>Patient">Appointments</a></li>
                                    <li class="active"><a href="<?php echo base_url(); ?>Patientprofile">Update Profile</a></li>
									
									<li><a href="<?php echo base_url(); ?>Patientreports">Upload Reports</a></li>
									<li><a href="<?php echo base_url(); ?>Patientprescription">Prescription</a></li>
                                    <li><a href="<?php echo base_url();?>Patient/logout">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
					<div class="applyjobform">
                                <?php 
                         $mag = $this->session->flashdata('message');
                          if($mag !=''){
                              echo $mag."<br>";
                          }
                            $attributes = array('class' => 'form-horizontal','name'=>'p_info','role'=>'form');
                            echo form_open_multipart('Patientprofile/edit_save_patient', $attributes);                
							
                        ?>
						<input type='hidden' name="patient_id" value="<?php echo $patient_info[0]['patient_id']?>">
                                    <h2>Update Profile</h2>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 mb-4">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" name="name" value="<?php echo $patient_info[0]['patient_name']?>" id="name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 mb-4">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" name="email" id="email" value="<?php echo $patient_info[0]['patient_email']?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 mb-4">
                                            <div class="form-group">
                                                <label for="phone-number">Phone Number</label>
                                                <input type="tel" class="form-control" name="phone" id="phone" value="<?php echo $patient_info[0]['patient_phone']?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 mb-4">
                                            <div class="form-group">
                                                <label for="text">Address</label>
                                                <input type="text" class="form-control" name="address" id="address" value="<?php echo $patient_info[0]['address']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 mb-4">
                                            <div class="form-group">
                                                <label for="text">Age </label>
                                                <input type="number" min="1" max="130" class="form-control" name="age" id="age" value="<?php echo $patient_info[0]['age']?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 mb-4">
                                            <div class="form-group">
                                                <label for="services">Gender</label>
                                                <select id="gender" name="gender" class="custom-select form-control" required>
                                                <option <?php if($patient_info[0]['sex']=="Male"){?> selected="selected" <?php } ?>>Male</option>
                                                <option <?php if($patient_info[0]['sex']=="FeMale"){?> selected="selected" <?php } ?>>FeMale</option>
                                                <option <?php if($patient_info[0]['sex']=="Others"){?> selected="selected" <?php } ?>>Others</option>
                                            </select>
                                            </div>
                                        </div>
										<div class="col-md-6 col-sm-6 mb-4">
                                            <div class="form-group">
                                                <label for="services"><?php echo display('blood_group');?></label>
                                                <select class="form-control" name="blood_group">
                                            <option value=''>--<?php echo display('blood_group');?>--</option>
                                            <option value='A+' <?php echo (html_escape($patient_info[0]['blood_group'])=='A+'?'selected':'')?>>A+</option>
                                            <option value='A-' <?php echo (html_escape($patient_info[0]['blood_group'])=='A-'?'selected':'')?>>A-</option>
                                            <option value='B+' <?php echo (html_escape($patient_info[0]['blood_group'])=='B+'?'selected':'')?>>B+</option>
                                            <option value='B-' <?php echo (html_escape($patient_info[0]['blood_group'])=='B-'?'selected':'')?>>B-</option>
                                            <option value='O+' <?php echo (html_escape($patient_info[0]['blood_group'])=='O+'?'selected':'')?>>O+</option>
                                            <option value='O-' <?php echo (html_escape($patient_info[0]['blood_group'])=='O-'?'selected':'')?>>O-</option>
                                            <option value='AB+' <?php echo (html_escape($patient_info[0]['blood_group'])=='AB+'?'selected':'')?>>AB+</option>
                                            <option value='AB-' <?php echo (html_escape($patient_info[0]['blood_group'])=='AB-'?'selected':'')?>>AB-</option>
                                            <option value='Unknown' <?php echo (html_escape($patient_info[0]['blood_group'])=='Unknown'?'selected':'')?>>Unknown</option>
                                        </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 mb-4">
                                            <div class="form-group">
                                                <label for="et_pb_contact_brand_file_request_0" class="et_pb_contact_form_label"></label>
                                                <input type="file" name="picture">
												<img src="<?php echo html_escape($patient_info[0]['picture']);?>" style="width:160px;"><br>
                                            </div>
										</div>
										<input type='hidden' name="image" value="<?php echo $patient_info[0]['picture']; ?>">
										<div class="col-md-12 mb-4">
                                            <div class="sbtn">
											
                                                <input type="submit" value="Update Profile">
                                            </div>
                                        </div>
                                    </div>
                                <?php echo form_close();?>
								
                            </div>
                    </div>
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