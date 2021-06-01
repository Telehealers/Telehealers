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
<!--Start of Tawk.to Script-->
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
<!--End of Tawk.to Script-->


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
    <? $this->load->view('homeslider.php')?>
<section id="home" class="meat_our_team">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading" style="margin-bottom:0px">
                        <h3><?php echo $info->theraphists_title->details;?></h3>
                        <p><?php echo $info->theraphists_sub_title->details;?></p>

                    </div>
                    <div style="display:none;" class="appoimentbtn"><br>
        <!--<button type="button" class="popup_btn" data-toggle="modal" data-target="#exampleModalLong">c
        book an appointment
      </button>-->
                    <a class="popup_btn d-inline-block" href="<?php echo base_url();?>appointment">Book An Appointment</a>
                    <button class="btn btn-primary btn-lg popup_btn d-inline-block" data-toggle="modal" data-target="#myModal">Login</button>
                  <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- <div class="modal-header d-block">
      <h4 class="modal-title" id="myModalLabel">Login</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div> -->
      <div class="modal-body" style="background:#f9f9f9">
      <div class="bs-example">
    <ul id="myTab" class="nav nav-pills">
        <!-- <li class="nav-item">
            <a href="#home" class="nav-link active">Home</a>
        </li> -->
        <li class="nav-item">
            <a href="#profile" class="nav-link" style="width:150px">Login</a>
        </li>
        <li class="nav-item">
            <a href="#messages" class="nav-link" style="width:150px">Registration</a>
        </li>
    </ul>
    <div class="tab-content">
        <!-- <div class="tab-pane fade show active" id="home">
            <h4 class="mt-2">Home tab content</h4>
            <p>Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui. Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth.</p>
        </div> -->
        <div class="tab-pane fade show active" id="profile">
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

                    <!-- <div class="panel-heading">
                        <div class="view-header">
                            <div class="header-icon">
                                <i class="pe-7s-unlock"></i>
                            </div>
                            <div class="header-title">
                                <h3>Login</h3>
                                <small><strong><?php echo display('login_title');?></strong></small>
                            </div>
                        </div>
                    </div> -->

                    <?php
                        $result = $this->db->select('*')->from('web_pages_tbl')->where('name','footer_logo')->where('status',1)->get()->row();
                    ?>

                    <div class="panel-body" style="padding: 50px 130px 10px 130px;background:#f9f9f9">
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
                                <button type="button" id="sendOtp" class="btn btn-lg btn-success btn-block ">Send OTP</button>
								<button type="button" id="login" style="display:none;" class="btn btn-lg btn-success btn-block">Login</button>
                                <input type="hidden" id="base_url" value="<?php echo base_url()?>">
                        </form>
                    </div>
					<span style="text-align:center;width: 100%;float: left;margin-top: 20px;"><a href="<?php echo base_url();?>">Go to site</a></span>
                </div>
            </div>
        </div>
            <!-- <h4 class="mt-2">Profile tab content</h4>
            <p>Vestibulum nec erat eu nulla rhoncus fringilla ut non neque. Vivamus nibh urna, ornare id gravida ut, mollis a magna. Aliquam porttitor condimentum nisi, eu viverra ipsum porta ut. Nam hendrerit bibendum turpis, sed molestie mi fermentum id. Aenean volutpat velit sem. Sed consequat ante in rutrum convallis. Nunc facilisis leo at faucibus adipiscing.</p> -->

        </div>
        <div class="tab-pane fade" id="messages">
        <div class="registration-wrapper" style="background:#FFF;">

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

        <!-- <div class="panel-heading">
            <div class="view-header">
                <div class="header-icon">
                    <i class="pe-7s-unlock"></i>
                </div>
                <div class="header-title">
                    <h3>Login</h3>
                    <small><strong><?php echo display('login_title');?></strong></small>
                </div>
            </div>
        </div> -->

        <?php
            $result = $this->db->select('*')->from('web_pages_tbl')->where('name','footer_logo')->where('status',1)->get()->row();
        ?>

        <div class="panel-body" style="padding: 50px 130px 10px 130px;background:#f9f9f9">
            <div class="row">
                Please register to book an appointment
            </div>    
        <hr>
            <?php
                $attributes = array('role'=>'form');
                echo form_open_multipart('authentication', $attributes);
            ?>

                    <div class="form-group">
                        <div id="meserr" style="color:red;"></div>
                        <input class="form-control" id="name" placeholder="Name" name="name" type="text" required  />
                         <span class="text-danger"></span>
                    </div>
                    <!-- new input fields added -- abinash  -->
                    <div class="form-group">
                        <div id="meserr" style="color:red;"></div>
                        <input class="form-control" id="phone1" placeholder="Mobile Number" name="phone" type="text" required  />
                         <span class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <div id="meserr" style="color:red;"></div>
                        <input class="form-control" id="email" placeholder="Email" name="meail" type="text" required  />
                         <span class="text-danger"></span>
                    </div>
                    <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <div id="meserr" style="color:red;"></div>
                        <input class="form-control" id="age" placeholder="Age" name="age" type="text" required  pattern="[1-9]{1}[0-9]{9}"/>
                         <span class="text-danger"></span>
                    </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group d-flex" style="line-height:2.5">
                        <div id="meserr" style="color:red;"></div>
                        <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="M">
  <label class="form-check-label" for="inlineRadio1">Male</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="F">
  <label class="form-check-label" for="inlineRadio2">Female</label>
</div>
                         <span class="text-danger"></span>
                    </div>
                    </div>
                    </div>
                     <div class="form-group" id="otp_field1" style="display:none;">
                     <div id="meserr1" style="color:red;"></div>
                        <input class="form-control" id="otp1" placeholder="Enter Otp" name="otp" type="text" required pattern="[1-9]{1}[0-9]{9}" />
                         <span class="text-danger"></span>
                    </div>

                    <!-- end of line -->
    <div id="otpmess1" style="color:green;"></div>
    <button type="button" id="register" class="btn btn-lg btn-success btn-block">Register</button>

    <button type="button" id="auth" class="btn btn-lg btn-success btn-block" style="display:none;">Authenticate</button>
                    <!-- <button type="button" id="sendOtp_register" class="btn btn-lg btn-success btn-block">Send OTP</button>
 -->
                    <input type="hidden" id="base_url" value="<?php echo base_url()?>">
            </form>
        </div>
<span style="text-align:center;width: 100%;float: left;margin-top: 20px;"><a href="<?php echo base_url();?>">Go to site</a></span>
    </div>
</div>
</div>
        </div>
    </div>

</div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

                    <!-- <a class="popup_btn d-inline-block" style="margin-left:10px" href="https://www.telehealers.in/Userlogin">Login</a> -->
                  </div>
                </div>

                <div id="home_faq_slider" class="owl-carousel owl-theme">
    				 <?php $i=1; foreach($theraphists as $val){?>
    				 <div class="item">
                    <div class="product-item">
                        <div class="col-lg-12">
                            <div class="team_box">
                                <div class="left_box">
                                   <?php echo $val->details; ?>

								   <p class="doc_tag">For you, by you</p>
                                </div>
                                <div class="img_box">
                                    <img src="<?php echo $val->picture; ?>" alt="<?php echo $val->title; ?>" style="width:140px;" />
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
    				<?php $i++;}?>
				</div>
            </div>
        </div>
    </section>

    <section id="about"  class="home_about_block">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="ab_box_img">
                        <img src="<?php echo (!empty(html_escape($info->about_img->picture))?html_escape($info->about_img->picture):null); ?>" alt="About telehealers">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="side_right_content">
                        <?php echo $info->working_des->details; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section id="home1" class="home_slider">
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

	<section id="testimonials" class="our_testimonail_home">
        <div id="h_r_pub" class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <p><?php echo $info->testimonials_sub_title->details;?></p>
                        <h5><?php echo $info->testimonials_title->details;?></h5>
                        <!--<span><?php echo $info->testimonials_text->details;?></span>-->
                    </div>
                    <div class="testmoli_slider">
                        <div id="home_testimonail_slider" class="owl-carousel owl-theme">
						 <?php $i=1; foreach($testimonial as $val){?>
                            <div class="item">
                                <div class="product-item">
                                    <div class="carousel-thumb">
                                        <div class="slider_content">
                                            <ul>
											<?php for($i=0; $i<=$val->star;$i++){?>
												<li class="flaticon-star"></li>
											<?php } ?>
                                            </ul>
                                            <p>"<?php echo $val->details; ?>"</p>
                                            <span>- <?php echo $val->title; ?></span>
                                            <small><?php echo $val->designation; ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<?php $i++;}?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="our_commintement">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <h4><?php echo $info->commitements_title->details;?></h4>
                        <p><?php echo $info->commitements_sub_title->details;?></p>
                    </div>
                </div>
				 <?php $i=1; foreach($commitements as $val){?>
                <div class="col-lg-3 col-md-6">
                    <div class="diff_box">
                        <img src="<?php echo $val->picture; ?>" alt="#">
                        <span><?php echo $val->title;?></span>
                        <!--<p><?php echo $val->details;?></p>-->
                    </div>
                </div>
				<?php $i++;}?>
            </div>
        </div>
    </section>



    <section id="blog"  class="home_recent_publication">
        <div class="container">
            <div class="row">
                <div class="offset-md-5 col-md-7">
                    <div class="heading">
                        <h5><?php echo $info->blog_title->details;?></h5>
                        <p><?php echo $info->blog_text->details;?></p>
                    </div>
                </div>
            </div>
<?php
$servername = getenv('DB_HOSTNAME');
$username=getenv('DB_USERNAME');
$password=getenv('DB_PASSWORD');
$dbname = getenv('DB_NAME');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM wp_blog_posts where post_type = 'post' and post_status = 'publish'";
$result = $conn->query($sql);


?>
            <div id="home_publication_slider" class="owl-carousel owl-theme">
			<?php
			//foreach ($post as $key => $val) {
			if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	  $post_id = $row["ID"];

$sql2 = "SELECT * FROM wp_blog_postmeta where post_id = '$post_id' and meta_key = '_wp_attached_file'";
$result2 = $conn->query($sql2);
$image_url = '2021/04/blog_ba.jpg';
if ($result2->num_rows > 0) {
  // output data of each row
  while($row2 = $result->fetch_assoc()) {
    $image_url = $row2["meta_value"];
  }
}
			?>
                <div class="item">
                    <div class="product-item">
                        <div class="carousel-thumb">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="user_img">
                                        <img src="https://telehealers.in/blogs/wp-content/uploads/<?php echo $image_url; ?>" alt="#" />
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="reviews_contents">
                                        <h5><?php echo $row["post_title"];?></h5>
                                        <p><?php echo $row["post_excerpt"]; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			<?php
			//}
}
}
			?>
            </div>
        </div>
    </section>


	<!-- <section id="faq" class="our_testimonail_home"> -->



        <section id="faq" class="faq-section">
            <div class="container">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="faq-title text-center pb-3">
                                    <h2>FAQs</h2>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="faq" id="accordion">


                                    <?php if(is_array($faq) && count($faq)>0){?>
                                    <?php $i=0; ?>
                                    <?php foreach($faq as $val){?>
                                    <?php $i++; ?>
                                    <div class="card">
                                        <div class="card-header" id="faqHeading-<?php echo $i;?>">
                                            <div class="mb-0">
                                                <h5 class="faq-title" data-toggle="collapse" data-target="#faqCollapse-<?php echo $i;?>" data-aria-expanded="true" data-aria-controls="faqCollapse-1">
                                                    <span class="badge">1</span><?php echo $val->title; ?>
                                                </h5>
                                            </div>
                                        </div>
                                        <div id="faqCollapse-<?php echo $i;?>" class="collapse" aria-labelledby="faqHeading-<?php echo $i;?>" data-parent="#accordion">
                                            <div class="card-body">
                                                <p><?php echo $val->details; ?>
</p>
                                            </div>
                                        </div>
                                    </div>

                                    <?php }} ?>




                                </div>
                            </div>
                        </div>

                </div>
        </section>
        <!-- <div id="h_r_pub1" class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <h5>Faqs</h5>

                    </div>
                    <div class="testmoli_slider">
                        <div id="home_faq_slider" class="owl-carousel owl-theme">
						 <?php $i=1; foreach($faq as $val){?>
                            <div class="item">
                                <div class="product-item">
                                    <div class="carousel-thumb">
                                        <div class="slider_content">
                                            <span><?php echo $val->title; ?></span><br><br>
											<p><?php echo $val->details; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<?php $i++;}?>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    <!-- </section> -->
	<!--<section id="contact" class="contact_us_home">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <h5>Contact Us</h5>
                        <p>PROVIDING MENTAL PEACE IS OUR GOAL</p>
                    </div>
                </div>

			<div class="col-md-3">

                </div>
                <div class="col-md-6">
                    <div class="contact_form">
                        <h5>get in touch</h5>
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control" id="full_name" name="fname" placeholder="Full name..." required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" id="email_id" name="email" placeholder="E-mail address..." required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject..." required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" id="message" name="message" rows="6" placeholder="Your message..." required></textarea>
                            </div>

							<div class="form-group">
								<div id=""><span style="background: #0c8bef none repeat scroll 0 0;color: #fff;padding: 4px 20px;font-family:serif,sans-serif;font-style: italic;"><?php echo $hello; ?></span></div>
								<div id="captchdas" style="visibility: hidden;"><?php echo $hello; ?></div>
                                <input type="text" class="form-control" id="captcha_code" name="captcha_code" placeholder="Captcha..." required>
                            </div>

                            <div class="submit_box_btn">
                                <input id="contact_us" type="button" value="submit">
                            </div>

							<div id="q_succ_msg" class="mt-3 alert alert-success" style="display:none"></div>
							<div id="q_show_error" class="mt-3 alert alert-danger" style="display:none"></div>
			  <br>
                        </form>
                    </div>
                </div>
				<div class="col-md-3"></div>
            </div>
        </div>
    </section>-->
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
      $("#myTab a").click(function(e){
            e.preventDefault();
            $(this).tab('show');
        });
     });
 </script>
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
    $("#phone1").keypress (function (event) {
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
    $('#auth').click(function (){
        var base_url = $('#base_url').val();
        var phone = $('#phone1').val();
        var otp = $('#otp1').val();
        var msg = '';
        if(phone==""){
            msg += 'Please enter mobile number<br>';
        }
        if(otp==""){
            msg += 'Please enter Otp<br>';
        }
        if(msg!=""){
            $('#meserr1').html(msg);
        }else{
            $('#meserr1').html('');
            $.ajax({
                url:base_url+'index.php/Patient/userLogin',
                method: 'post',
                data: {phone:phone,otp:otp},
                type: 'POST',
                success: function(response){
                    if(response==0){
                        $('#meserr1').html('Incorrect Mobile number');
                    }else if(response==1){
                        $('#meserr1').html('You enter wrong Otp');
                    }else{
                       window.location.href = 'appointment';
                    }
                    //$('#q_succ_msg').html('Your details has been submited successfully.');
                    //$('#q_succ_msg').html(response);
                }
            });
        }
    });

    $('#register').click(function(){
        var name    = $('#name').val();
        var email     = $('#email').val();
        var age      = $('#age').val();
        var phone      = $('#phone1').val();
        var baseUrl =$('#base_url').val();
        var gender = document.querySelector('input[name="inlineRadioOptions"]:checked').value;
            console.log(gender);
      
            $.ajax({
                url:baseUrl+'index.php/Welcome/registration',
                method: 'post',
                data: {name:name, email:email,age:age , phone: phone,gender:gender},
                type: 'POST',
                success: function(response){
                   if (response==0) {
                        // this user already exists , show error to user that number is already registered , please log in 
                   }
                   else if(response==1){
                    // new user has been created , 
                    $.ajax({
                        url:baseUrl+'index.php/Patient/checkUser',
                        method: 'post',
                        data: {phone:phone},
                        type: 'POST',
                        success: function(response){
                        if(response==0){
                            $('#meserr').html('Incorrect Mobile number');
                        }else{
                            $('#otpmess1').html('Otp sent on your mobile number...');
                        }
                        $('#otp_field1').css('display','block');
                        $('#auth').css('display','block');
                        $('#register').hide();
                    }})


                    
                   }

                }
            });
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
