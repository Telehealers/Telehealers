<header class="header">
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-8">
                        <div class="top_content">
                            <p><?php //echo (!empty(html_escape($info->phone->details))?html_escape($info->phone->details):null); ?> <a href="#"><?php echo (!empty(html_escape($info->email->details))?html_escape($info->email->details):null); ?></a></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-4">
                        <div class="top_social">
                            <ul>
                            <li>
                                    <a href="<?php echo (!empty(html_escape($info->google->details))?html_escape($info->google->details):null); ?>" target="_blank">Telehealers Covid Helpline +91-9352644967</a>
                                </li>
                                <li>
                                    <a href="<?php echo (!empty(html_escape($info->facebook->details))?html_escape($info->facebook->details):null); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                </li>
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
                                    <img src="<?php echo (!empty(html_escape($info->logo->picture))?html_escape($info->logo->picture):null); ?>" alt="Telehealers" />
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
                                            <a href="<?php echo base_url()?>#home">Home</a>
                                        </li>
										<li><a href="<?php echo base_url()?>appointment">Book Appointment</a></li>
                                        <li><a href="<?php echo base_url()?>contact">Contact Us</a></li>
										<?php if($this->session->userdata('user_type')==3){?>

										<li><a href="<?php echo base_url();?>Patient">Dashboard</a></li>
										<?php }else if($this->session->userdata('user_type')==1){?>
										<li><a href="<?php echo base_url()?>Doctorlogin/logout">Logout</a></li>
										<?php }else{ ?>
										<li><a href="<?php echo base_url()?>Userlogin">Login</a></li>
										<?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
