<footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="footer_content">
                        <div class="logo_menu">
                            <span><a href="<?php echo base_url();?>"><img src="<?php echo (!empty(html_escape($info->footer_picture->picture))?html_escape($info->footer_picture->picture):null); ?>" alt="#"/></a></span>
                            <ul>
                                <li><a href="<?php echo base_url();?>appointment">Appointment</a></li>
								<li><a href="<?php echo base_url();?>#about">About Us</a></li>
                                <li><a href="<?php echo base_url();?>#home">Doctors</a></li>
                                <li><a href="<?php echo base_url();?>#testimonials">Testimonials</a></li>
                                <li><a href="<?php echo base_url();?>blogs">Blog</a></li>
                                <li><a href="<?php echo base_url();?>#faq">FAQs</a></li>
                                <li><a href="<?php echo base_url();?>contact">Contact Us</a></li>
								<li><a href="<?php echo base_url();?>Doctorlist">Doctors</a></li>
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