<div class="whatsapp_button">
	<span><a target="_blank" href="https://api.whatsapp.com/send?phone=9071123400&text=Hi"><img src="<?php echo base_url();?>web_assets2/images/whatsapp.png" alt="#"></a></span>
	<!--<div class="number_call">
		<p>+91 123123123</p>
	</div>-->
</div>

	
<footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="footer_content">
                        <div class="logo_menu">
                            <span><a href="<?php echo base_url();?>"><img src="<?php echo (!empty(html_escape($info->footer_picture->picture))?html_escape($info->footer_picture->picture):null); ?>" alt="Telehealers"/></a></span>
                            <ul>
                                <li><a href="<?php echo base_url();?>appointment">Appointment</a></li>
								<li><a href="<?php echo base_url();?>#about">About Us</a></li>
                                <li><a href="<?php echo base_url();?>#home">Doctors</a></li>
                                <li><a href="<?php echo base_url();?>#testimonials">Testimonials</a></li>
                                <li><a href="<?php echo base_url();?>blogs">Blog</a></li>
                                <li><a href="<?php echo base_url();?>#faq">FAQs</a></li>
                                <li><a href="<?php echo base_url();?>contact">Contact Us</a></li>
								<li><a href="<?php echo base_url();?>Doctorlist">Doctors</a></li>								<li><a href="<?php echo base_url();?>login">Login</a></li>
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
    </footer><script></script>