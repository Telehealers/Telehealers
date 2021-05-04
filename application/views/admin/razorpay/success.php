<?php
   // date_default_timezone_set(@$info->timezone->details);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="icon" href="<?php echo (!empty(html_escape($info->fabicon->picture))?html_escape($info->fabicon->picture):null); ?>" sizes="16x16">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        
        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>web_assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- flaticon -->
        <link href="<?php echo base_url(); ?>web_assets/public_css/css/flaticon.css" rel="stylesheet">
         <link href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
         <!-- style -->
         
          <link rel="stylesheet" href="<?php echo base_url();?>web_assets2/css/main.css">
	<link href="<?php echo base_url()?>assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
	
	<link rel="stylesheet" href="<?php echo base_url();?>web_assets2/appointment/css/main.css">
    <link rel="stylesheet" href="<?php echo base_url();?>web_assets2/appointment/css/style.css">
	<link rel="" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js">
	
        <link href="<?php echo base_url(); ?>assets/public_css/style2.css" rel="stylesheet">
        <!-- print preview js -->
        <script src="<?php echo base_url(); ?>web_assets/js/print_preview.js"></script>
        <!-- style -->
        <link href="<?php echo base_url(); ?>web_assets/css/inline.css" rel="stylesheet">
		
	<title><?php echo $data['meta_info'][0]['page_title']; ?></title>
	<meta name="keywords" content="<?php echo $data['meta_info'][0]['meta_keywords']; ?>">
	<meta name="description" content="<?php $data['meta_info'][0]['meta_description']; ?>">
	

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
        <h2>Your payment was successful!</h2>                 
    </div>
</div><!-- /.row -->

<div class="row" style="text-align:center;">  
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
	&nbsp;
	</div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"  style="min-height:400px;">                        
            <table class="table table-bordered table-hover table-striped print-table order-table" style="font-size:11px;">
                <tbody>   
<?php if(isset($data['alreaty']) && $data['alreaty']==1){?>
<tr>
	<td colspan="2" style="text-align:center; font-size:24px;"><b>You already paid for this appointment.</b></td>              
</tr>
<?php }else{ ?>
                    <tr>
                        <td class="text-left">Razorpay Order ID</td>
                        <td class="text-left"><?php echo $data['razorpay_order_id'];?></td>               
                    </tr>
					<tr>
                        <td class="text-left">Razorpay Payment ID</td>
                        <td class="text-left"><?php echo $data['razorpay_payment_id'];?></td>               
                    </tr>
					<tr>
                        <td class="text-left">status</td>
                        <td class="text-left"><?php echo $data['status'];?></td>               
                    </tr>
					<tr>
                        <td class="text-left">Payment Date</td>
                        <td class="text-left"><?php echo $data['payment_date'];?></td>               
                    </tr>
					<tr>
                        <td class="text-left">Appointment ID</td>
                        <td class="text-left"><?php echo $data['appointment_id'];?></td>               
                    </tr>
<tr>
                        <td class="text-left">Patient ID</td>
                        <td class="text-left"><?php echo $data['patient_id'];?></td>               
                    </tr>
<tr>
<tr>
                        <td class="text-left">Patient Name</td>
                        <td class="text-left"><?php echo $data['patient_name'];?></td>               
                    </tr>
<tr>
<tr>
                        <td class="text-left">Patient Email</td>
                        <td class="text-left"><?php echo $data['patient_email'];?></td>               
                    </tr>
<tr>
<tr>
                        <td class="text-left">Patient Phone</td>
                        <td class="text-left"><?php echo $data['patient_phone'];?></td>               
                    </tr>
<tr>
                        <td class="text-left">Venue Name</td>
                        <td class="text-left"><?php echo $data['venue_name'];?></td>               
                    </tr>
					<tr>
                        <td class="text-left">Venue Contact</td>
                        <td class="text-left"><?php echo $data['venue_contact'];?></td>               
                    </tr>
					<tr>
                        <td class="text-left">Venue Address</td>
                        <td class="text-left"><?php echo $data['venue_address'];?></td>               
                    </tr>
<tr>
                        <td class="text-left">Doctor Name</td>
                        <td class="text-left"><?php echo $data['doctor_name'];?></td>               
                    </tr>
					<tr>
                        <td class="text-left">Appointment Date</td>
                        <td class="text-left"><?php echo $data['date'];?></td>               
                    </tr>
<tr>
                        <td class="text-left">Appointment Time</td>
                        <td class="text-left"><?php echo $data['sequence'];?></td>             
                    </tr>
<tr>
                        <td class="text-left">Patient CC</td>
                        <td class="text-left"><?php echo $data['problem'];?></td>              
                    </tr>

<tr>
                        <td class="text-left">Fees</td>
                        <td class="text-left"><?php echo $data['f_amount'];?> INR</td>              
                    </tr>
					<tr>
                        <td class="text-left">&nbsp;</td>
                        <td class="text-left">&nbsp;</td>              
                    </tr>
					<tr>
                        <td colspan="2" style="text-align:right"><button onclick="window.print()">Print</button>&nbsp;&nbsp;</td>              
                    </tr>
<?php } ?>					
                </tbody>                        
            </table>
        </div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
	&nbsp;
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
</html>