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

   <section class="multi_step_form appointment_page">
	<img src="<?php echo base_url();?>web_assets2/images/404.png" />
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
	
	
</body>
</html>