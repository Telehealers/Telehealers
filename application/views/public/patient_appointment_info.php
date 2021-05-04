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
										<!--<li><a href="#appointment">Appointment</a></li>-->
										<li><a href="<?php echo base_url();?>#about">About Us</a></li>
										<li><a href="<?php echo base_url();?>#doctors">Doctors</a></li>
										<li><a href="<?php echo base_url();?>Appointment">Appointment</a></li>
										<li><a href="<?php echo base_url();?>#testimonials">Testimonials</a></li>
										<li><a href="<?php echo base_url();?>blogs">Blog</a></li>
										<li><a href="<?php echo base_url();?>#faq">FAQs</a></li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

   
	
    

    

    <section id="theraphists" class="meat_our_team">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    
                    
                    
                    
                    
                    <?php
      if($this->session->userdata('appointment_id')){
          $appointment_id = $this->session->userdata('appointment_id');
	    }else{
	        $appointment_id = $this->uri->segment(4);
	    }

     
      if(!empty($print)){

          $start = $print->start_time;
          $end =  $print->end_time;

          $pp_time = $print->per_patient_time;
          $sq = $print->sequence;
          @$m_time = $sq - 1;

          $time = ($m_time * $pp_time);
          $patient_time = date('H:i A', strtotime("+$time minutes", strtotime($start)));
          $patient_time = date('H:i A', strtotime($start));
          $end_time = date('H:i A', strtotime($end));

          $Payment = $this->db->select('*')
                                     ->from('payment_table')
                                     ->where('appointment_id',$appointment_id)
                                     ->get()
                                     ->row();


                               if($print->picture){
                                $pimg = $print->picture;
                               }else{
                                $pimg = base_url('assets/images/male.png');
                               }

     ?>
    
  
        

 <div id="div1">

      <div class="container" >
          <div class="row top-bar">
              <div class="left-text pull-left">
                  <p><b><?php echo display('date')?> : <?php echo html_escape(@$print->get_date_time);?></p>
              </div>  
          </div>
      </div>
		

	
    

		
				<div class="container" >
					<div class="row ccc" >
						<div class="sec-title colored text-center">
							<p class="h2"><?php echo display('appointment_information_page')?></p>
						</div>



						<div class="information">
							<div class="information-details"  >
								<ul>
									<li><?php echo display('appointment_id')?>: <span class="pull-right"> <?php echo html_escape($print->appointment_id) ;?></span></li>
									<li><?php echo display('name')?> : <span class="pull-right"><?php echo html_escape(@$print->patient_name) ;?></span></li>
									<li><?php echo display('patient_id')?> : <span class="pull-right"><?php echo html_escape(@$print->patient_id) ;?></span></li>
									<li><?php echo display('Sequence')?> : <span class="pull-right"><?php echo html_escape(@$print->sequence) ;?></span></li>
									<li><?php echo display('date')?> : <span class="pull-right"><?php echo date('d M, Y' , strtotime(@$print->date)) ;?> </span></li>
									<li><?php echo display('doctor')?> : <span class="pull-right"><?php echo html_escape(@$print->doctor_name) ;?></span></li>
									<!--<li><?php echo display('department')?> : <span class="pull-right"> <?php echo html_escape(@$print->department_name);?></span></li>-->
								</ul>
							</div>
						</div>

            <div class="mape pimg">
                <img src="<?php echo html_escape($pimg); ?>" class=" img-responsive">
            </div>

						
					</div>
				</div>
		

			<div class="container inners top_gap">
				<!--<div class="row ccc">
					<div class="address_footer" >
						 <b> <?php echo display('address')?> : </b><span class="address_footer_text"> <?php echo html_escape(@$print->venue_address);?></span>
						 <b> <?php echo display('phone_number')?> :</b> <span class="address_footer_text"> <?php echo html_escape(@$print->venue_contact);?></span>
					</div>
                </div>--> 
        
        <?php
         if(empty($Payment)){
	$ap_id = $print->appointment_id;
	$p_id = $print->patient_id;
	$SQL = "select schedul_id from appointment_tbl where appointment_id = '".$ap_id."' and patient_id = '".$p_id."'";
		
		$query = $this->db->query($SQL);

		$result = $query->result_array();				
		$schedul_id='';
		$fees='';
		$doc_id='';
		if(is_array($result) && count($result)>0){
			$schedul_id = $result[0]['schedul_id'];
		}
		
		if($schedul_id>0){
			$SQL2 = "select doctor_id,fees from schedul_setup_tbl where schedul_id = '".$schedul_id."'";
			$query2 = $this->db->query($SQL2);
			$result2 = $query2->result_array();
			if(is_array($result2) && count($result2)>0){
				$doc_id = $result2[0]['doctor_id'];
				$fees = $result2[0]['fees'];
			}
		}
		if($fees==1){
			?>
           <div class="paypal-div">
                Free Service
                
          </div>
        <?php
		}
		if($fees==2){
			?>
           <div class="paypal-div">
                Paid Service
                <a target="_blank" href="<?php echo base_url();?>admin/payment_method/Payment/pay_with_doctor/<?php echo html_escape($print->appointment_id);?>">
                Make Payment</a>
          </div>
        <?php
		}
           }?>

			</div> 

			

		</div>

		<?php 
			}else{
		?>
		    <div class="container">
            <div class="alert alert-block alert-danger fade in">
                 <strong><?php echo display('Please_Click_to_back_home')?></strong>
                <a href="<?php echo base_url();?>" class="btn btn-large btn-primary"><?php echo display('back_home')?></a>
            </div>
        </div>
		<?php } ?>
                    
                    
                    
                    
                    
                    
                    
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
	
	
</body>
</html>