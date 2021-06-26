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
                                    <li class="active"><a href="<?php echo base_url(); ?>Patient">Appointments</a></li>
                                    <li class=""><a href="<?php echo base_url(); ?>Patientprofile">Update Profile</a></li>
									<li><a href="<?php echo base_url(); ?>Patientreports">Upload Reports</a></li>
									<li><a href="<?php echo base_url(); ?>Patientprescription">Prescription</a></li>
									<li><a href="<?php echo base_url();?>Patient/logout">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
					<?php 
						echo @$msg = $this->session->flashdata('message'); 
					?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Appointment ID</th>
                                        <th scope="col">Doctor</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Meeting Link</th>
										<th scope="col">Service</th>
										
                                    </tr>
                                </thead>
                                <tbody>
								<?php 
								$doctor_arr = array();
								if(is_array($patient_appointment_info) && count($patient_appointment_info)>0){
									foreach($patient_appointment_info as $val){
									$doctor_id = $val['doctor_id'];
									$doctor_name = $val['doctor_name'];
									$doc_id = $val['doc_id'];
									$log_id = $val['log_id'];
									$department = $val['department'];
									$designation = $val['designation'];
									$degrees = $val['degrees'];
									$specialist = $val['specialist'];
									$prescription_id='';
									$app_id = $val['appointment_id'];
									$sql_pre = "select * from prescription where appointment_id = '".$app_id."'";
									$res_pre = $this->db->query($sql_pre);
									$result_pre = $res_pre->result_array();
									if(is_array($result_pre) && count($result_pre)>0){
										$prescription_id = $result_pre[0]['prescription_id'];
										$prescription_type = $result_pre[0]['prescription_type'];
									}
								?>
                                    <tr>
                                        <td><?php echo $val['appointment_id'];?></td>
                                        <td><?php echo $doctor_name;?><span><?php echo $specialist;?></span></td>
                                        <td>
										<?php
		$app_time = date('h:i A', strtotime($val['sequence']));
		$app_date = date('jS F Y',strtotime($val['date']));										
										echo $app_date;
										?></td>
                                        <td><?php echo $app_time;?></td>
                                        <td><a href="<?php echo $val['symt1'];?>"><?php echo $val['symt1'];?></a></td>
                                        <td><?php echo $val['servicetype'];?></td>
										
								    </tr>
								<?php }} ?>	
                                </tbody>
                            </table>
							<br><br>
							
                        </div>
						<br><br>
						<div id="bookippointment" style="">
						<div class="row"><div class="col-md-12 previous_heading">Previously Consulted and Referred Doctors</div></div>
							<?php
								$i=0;
								foreach($all_related_doctors_to_the_patient as $dr){
									$i++;
									$doctor_name = $dr->doctor_name;
							?>
								<div class="row">
									<div class="col-md-1"><?php echo $i; ?></div>
									<div class="col-md-5"><?php echo $doctor_name; ?></div>
								</div><br>	
							<?php
								}
							?>
						<div class="applyjobform" style="display:none;">
                                <?php 
						$mag = $this->session->flashdata('message');
						if($mag !=''){
						echo $mag."<br>";
						}
						
                            $attributes = array('class' => 'form-horizontal','id'=>'p_info','name'=>'p_info','role'=>'form');
                            echo form_open_multipart('Appointment/patientAppointment', $attributes);                
							
                        ?>
						
						<input type='hidden' name="patient_id" id="patient_id" value="<?php echo $patient_info[0]['patient_id']?>">
						<input type='hidden' name="patient_email" id="patient_email" value="<?php echo $patient_info[0]['patient_email']?>">
						<input type='hidden' name="doctor_id" id="doctor_id" value="">
                                    <h2 id="dr_name" style="font-size:20px;">Book Appointment</h2>
									<div id="errmsg" style="display:none;" class="alert alert-danger"></div>
                                    <div class="row" style="display:none;">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="email">Doctor</label>
                                                <input type="text" class="form-control1" name="d_name" id="d_name" value="" disabled>
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label for="phone-number">Date</label>
                                                <input type="date" class="form-control datepicker3" name="p_date" id="p_date" value="" required>
                                            </div>
                                        </div>
									</div>
									<div class="row">									
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <div class="schedul1" style="width:100%; float:left; clear:both; margin-top:20px;"></div>
                                            </div>
                                        </div>
                                    </div>
									<br>
									<div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label for="phone-number">Tell us your symptom or health problem</label>
                                                <textarea name="problem" id="problem" class="form-control" required></textarea>
                                            </div>
                                        </div>
									</div>
									<div class="row">				
                                        <div class="col-md-7 mb-4">
                                            <div class="sbtn">
											    <input type="button" onClick="checkValidate()" value="Book Appointment">
                                            </div>
                                        </div>
									</div>
                                <?php echo form_close();?>
						    </div>
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
    $('.appoimentbtn').show();
	
	
	var date_input=$('input[name="p_date"]');
	 $("#p_date").datepicker({
		onSelect: function(dateText) {
		  alert("Selected date: " + dateText + ", Current Selected Value= " + this.value);
		  $(this).change();
		}
	  }).on("change", function() {
		$('#errmsg').hide();
		$('#errmsg').html('');
		var date = $('#p_date').val();
		var doctor_id = $('#doctor_id').val();
		var venue_id = '3';
		//alert(date+','+venue_id+','+doctor_id);
		//2021-05-13,3,14
		loadScheduldoc(date,venue_id,doctor_id);
	  });
	
});

function preventBack() { 
window.history.forward(); 
}  
setTimeout("preventBack()", 0);  
window.onunload = function () { null };  

function setdocapp(name,id){
	//alert(name+' / '+id);
	$('#d_name').val(name);
	$('#doctor_id').val(id);
	$('#dr_name').html('Book Appointment with '+name);
	$('.applyjobform').show();
}
function checkValidate(){
	var baseUrl = $('#baseUrl').val();
	var p_date = $('#p_date').val();
	var doctor_id = $('#doctor_id').val();
	var p_email = $('#patient_email').val();
	var venue_id = '3';
	var patient_id = $('#patient_id').val();
	var serial_no = $('#serial_no').val();
	var problem = $('#problem').val();
	var schedul_id = $('input[name="schedul_id"]').val();
	//alert(p_email);
	if(p_date==""){
		$('#errmsg').show();
		$('#errmsg').html('Please select Date first.');
	}else if(problem==""){
		$('#errmsg').show();
		$('#errmsg').html('Please Enter Tell us your symptom or health problem.');
	}else{
		if(typeof serial_no === 'undefined'){
		
		}else{
			if(serial_no==""){
				$('#errmsg').show();
				$('#errmsg').html('Please select time slot.');
			}else{
				$('#errmsg').hide();
				$('#errmsg').html('');	
				if(p_email!="" || p_date!=""){
					//alert(p_email+' / '+p_date);
					//raghuveer@ecomsolver.com / 2021-05-13
					//raghuveer@ecomsolver.com / 2021-05-13
					$.ajax({
						url:baseUrl+'index.php/Welcome/checkAppointment',
						method: 'post',
						data: {p_email:p_email,p_date:p_date},
						type: 'POST',
						success: function(response2){
							//alert(response);
							if(response2==1){
								$('#errmsg').show();
								$('#errmsg').html('Sorry You already get apointment in this date.');
							}else{
								$('#errmsg').hide();
								$('#errmsg').html('');
								$('#p_info').submit();
							}
							//$('#service_type').html(response);
						}
					});
				}
			}
		}	
	}
	
}
</script>	
</body>
</html>