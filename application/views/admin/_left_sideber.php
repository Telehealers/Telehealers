
<?php
$user_type = $this->session->userdata('user_type');
if($user_type =="3" || $user_type==""){
	redirect('/');
}
if($user_type==1){
	$user_id = $this->session->userdata('doctor_id');
	if($user_id!=1){
		$sql = "select approve from doctor_tbl where doctor_id = '$user_id'";
		$res = $this->db->query($sql);
		$result = $res->result_array();
		$approve = $result[0]['approve'];
		if($approve!=2){
			redirect('Doctorlogin/approve');
		}
	}
}
?>
<nav class="navbar navbar-static-top">
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> 
                        <span class="sr-only">Toggle navigation</span>
                        <span class="pe-7s-keypad"></span>
                    </a>
                    <div class="navbar-custom-menu">
                    <?php if($this->session->userdata('user_type') == 1) { ?>
                        <ul class="nav navbar-nav">
                            <!-- settings -->
                            <li class="dropdown dropdown-user">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="pe-7s-settings"></i></a>
                                <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo base_url();?>profile"><i class="pe-7s-users"></i><?php echo display('profile');?></a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>admin/Setting_controller/password_change"><i class="pe-7s-key"></i><?php echo display('change_password');?></a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>logout"><i class="fa fa-sign-out fa-fw"></i> <?php echo display('logout');?> </a>
                                </li>
                                </ul>
                            </li>
                        </ul>
                    <?php } else { ?>  
                        <ul class="nav navbar-nav">
                            <!-- settings -->
                            <li class="dropdown dropdown-user">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="pe-7s-settings"></i></a>
                                <ul class="dropdown-menu">
                                    <!--<li>
                                        <a href="<?php echo base_url();?>admin/Users_controller/update_profile"><i class="pe-7s-users"></i> <?php echo display('profile');?></a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url();?>admin/Setting_controller/password_change"><i class="pe-7s-key"></i><?php echo display('change_password');?></a>
                                    </li>-->
                                    <li>
                                        <a href="<?php echo base_url();?>logout"><i class="fa fa-sign-out fa-fw"></i> <?php echo display('logout');?></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    <?php }  ?>    
                    </div>
                </nav>
    <script src="<?php echo base_url()?>assets/dist/adminjs/sidebar.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/dist/adminjs/sidebar.js" type="text/javascript"></script>


            <aside class="main-sidebar">
                <!-- sidebar -->
                <div class="sidebar">
				<?php
				//echo '<pre>'; print_r($this->session->all_userdata());exit;
				$user_id = $this->session->userdata('doctor_id');
				
				?>
                    <!-- Sidebar user panel -->
                    <?php if($this->session->userdata('user_type')==1) { ?>

					<?php if($this->session->userdata('doctor_id')==1){?>
                    <?php
					
                        if($this->session->userdata('doctor_picture')!=""){
                            $img=$this->session->userdata('doctor_picture');
                        }else{
                            $img= base_url().'assets/images/patient.png';
                        }
                    ?>


                    <div class="user-panel text-center">
                        <div class="image">
                            <img src="<?php echo $img;?>" class="img-circle" alt="User Image">
                        </div>
                        <div class="info 12">
                            <p><?php echo $this->session->userdata('doctor_name'); ?></p>
							
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
						</div>
						<ul style="text-align: left; margin-left: 53px;">
							<li>
								<a href="<?php echo base_url();?>profile"><i class="pe-7s-users"></i><?php echo display('profile');?></a>
							</li>
							<li>
								<a href="<?php echo base_url();?>admin/Setting_controller/password_change"><i class="pe-7s-key"></i><?php echo display('change_password');?></a>
							</li>
							<li>
								<a href="<?php echo base_url();?>logout"><i class="fa fa-sign-out fa-fw"></i> <?php echo display('logout');?></a>
							</li>
						</ul>
                    </div>

                    <!-- sidebar menu -->
                    <ul class="sidebar-menu">

                        <li class="dash">
                            <a href="<?php echo base_url();?>admin/Dashboard"><i class="fa fa-dashboard"></i> <span><?php echo display('deashbord');?></span>
                            </a>
                        </li>

                        <li class="treeview pres">
                            <a href="#">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i><span><?php echo display('prescription')?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <!--<li><a href="<?php echo base_url();?>admin/Prescription_controller/create_new_prescription"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo display('create_trade')?> </a></li>-->
                                <li class=""><a href="<?php echo base_url();?>admin/Prescription_controller/create_new_prescription"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo display('create_generic')?></a></li>
                                <li><a href="<?php echo base_url();?>admin/Prescription_controller/prescription_list"> <i class="fa fa-list" aria-hidden="true"></i> <?php echo display('prescription_list')?></a></li>
                            </ul>
                        </li>

                        <!--<li class="treeview payment">
                            <a href="#">
                                <i class="fa fa-plus"></i><span><?php echo display('payment');?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url();?>admin/payment_method/Payment"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo display('Payment_Setup');?> </a></li>
                                <li><a href="<?php echo base_url();?>admin/payment_method/Payment_manage"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo display('payment_list');?></a></li>
                            </ul>
                        </li>-->

                        <li class="treeview appointment">
                            <a href="#">
                                <i class="fa fa-codepen" aria-hidden="true"></i><span><?php echo display('appointment')?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url()?>admin/Appointment_controller"> <i class="fa fa-plus" aria-hidden="true"></i> <?php echo display('create_appointment')?></a></li>
                                <li><a href="<?php echo base_url()?>admin/Appointment_controller/appointment_list"> <i class="fa fa-list" aria-hidden="true"></i> <?php echo display('appointment_list')?></a></li>
								<li><a href="<?php echo base_url()?>admin/Appointment_controller/appointment_list_referral"> <i class="fa fa-list" aria-hidden="true"></i>Referral Appointment</a></li>
                        
                            </ul>
                        </li>

                        <li class="treeview patient">
                            <a href="#">
                                <i class="fa fa-child" aria-hidden="true"></i><span><?php echo display('patient')?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url()?>create_new_patient"> <i class="fa fa-plus" aria-hidden="true"></i> <?php echo display('add_new_patient')?></a></li>
                                <li><a href="<?php echo base_url();?>patient_list"> <i class="fa fa-list" aria-hidden="true"></i> <?php echo display('patient_list')?></a></li>
								<li><a href="<?php echo base_url();?>admin/Patient_controller/referral_patient_list"> <i class="fa fa-list" aria-hidden="true"></i> referral patient list</a></li>
                            </ul>
                        </li>
                        <li class="treeview schedule">
                            <a href="#">
                               <i class="fa fa-weixin" aria-hidden="true"></i><span><?php echo display('schedule')?> </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url();?>admin/Schedule_controller/add_schedule"> <i class="fa fa-plus" aria-hidden="true"></i> <?php echo display('add_schedule')?></a></li>
                                <li><a href="<?php echo base_url();?>admin/Schedule_controller/schedule_list"> <i class="fa fa-list" aria-hidden="true"></i> <?php echo display('schedule_list')?></a></li>
                            </ul>
                        </li>

                        <!--<li class="treeview emergency_stop">
                            <a href="#">
                               <i class="fa fa-hand-paper-o" aria-hidden="true"></i><span><?php echo display('emergency_stop')?> </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url();?>admin/Emergency_stop_controller"> <i class="fa fa-stop-circle" aria-hidden="true"></i> <?php echo display('emergency_stop_setup')?></a></li>
                                <li><a href="<?php echo base_url();?>admin/Emergency_stop_controller/emergency_stop_list"> <i class="fa fa-list" aria-hidden="true"></i> <?php echo display('emergency_stop_list')?></a></li>
                            </ul>
                        </li>-->

                        <li class="treeview venue">
                            <a href="#">
                                <i class="fa fa-paw" aria-hidden="true"></i> <span> <?php echo display('venue')?> </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url();?>admin/Venue_controller/create_new_venue"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo display('create_venue')?></a></li>
								<li><a href="<?php echo base_url();?>admin/Venue_controller/venue_list"> <i class="fa fa-list" aria-hidden="true"></i> <?php echo display('venue_list')?></a></li>
					        </ul>
                        </li>

                        <li class="treeview setup_data">
                            <a href="#">
                                <i class="fa fa-bar-chart-o fa-fw"></i><span> Medicine </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url();?>admin/Setup_controller/add_medicine" class="nav-link"> <?php echo display('add_medicine')?></a></li>
                                <li><a href="<?php echo base_url();?>admin/Setup_controller/medicine_List" class="nav-link"> <?php echo display('medicine_List')?></a></li>
                                <!--<li> <a href="<?php echo base_url();?>admin/Setup_controller/add_medicine_company" class="nav-link"> <?php echo display('add_company')?></a></li>
                                <li> <a href="<?php echo base_url();?>admin/Setup_controller/add_medicine_group" class="nav-link"></i> <?php echo display('add_group')?></a></li>-->
                                <li> <a href="<?php echo base_url();?>admin/Setup_controller/advice" class="nav-link"> <?php echo display('add_advice')?></a></li>
                                <li> <a href="<?php echo base_url();?>admin/Disease_test_controller/add_new_test" class="nav-link"> <?php echo display('add_test_name')?></a></li>
                                <li>  <a href="<?php echo base_url();?>admin/Disease_test_controller/test_list" class="nav-link"> <?php echo display('test_list')?></a></li>
                            </ul>
                        </li>

                        <li class="treeview users">
                            <a href="#">
                               <i class="fa fa-users" aria-hidden="true"></i><span> <?php echo display('users')?> </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>

                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url()?>admin/Users_controller/create_new_user"> <i class="fa fa-plus" aria-hidden="true"></i> <?php echo display('add_new_user')?></a></li>
                                <li><a href="<?php echo base_url()?>admin/Users_controller/user_list"> <i class="fa fa-list" aria-hidden="true"></i> <?php echo display('user_list')?></a></li>
                            </ul>
                        </li>
						
						<li class="treeview doctors admin">
                            <a href="#">
                               <i class="fa fa-users" aria-hidden="true"></i><span> Doctors </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>

                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url()?>admin/Doctor_controller/create_new_doctor"> <i class="fa fa-plus" aria-hidden="true"></i> Add New Doctors</a></li>
                                <li><a href="<?php echo base_url()?>admin/Doctor_controller/doctor_list"> <i class="fa fa-list" aria-hidden="true"></i> Doctors List</a></li>
								<li><a href="<?php echo base_url()?>admin/Department_controller/department_list"> <i class="fa fa-list" aria-hidden="true"></i> Doctors Departments</a></li>
								<li><a href="<?php echo base_url()?>admin/Doctor_controller/approveDoctor"> <i class="fa fa-list" aria-hidden="true"></i> Aggriment Content</a></li>
								<li><a href="<?php echo base_url()?>admin/Doctor_controller/languageDoctor"> <i class="fa fa-list" aria-hidden="true"></i> Doctor Language</a></li>
                            </ul>
                        </li>

                         <li class="treeview web_setting">
                            <a href="#">
                                <i class="fa fa-cogs" aria-hidden="true"></i><span> <?php echo display('web_setting')?> </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>

                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url();?>admin/Web_setup_controller/header_setting" class="nav-link"><?php echo display('header_setup')?></a></li>
                                <li> <a href="<?php echo base_url();?>profile"> <?php echo display('profile')?></a></li>
                                <li><a href="<?php echo base_url();?>admin/Web_setup_controller/slider_list" class="nav-link"> <?php echo display('slider')?> </a></li>
                                <li><a href="<?php echo base_url();?>admin/Web_setup_controller/website_on_off"> <?php echo display('web_site')?> </a></li>
                                
                            </ul>
                        </li>

                        <li class="treeview theraphists">
                            <a href="#">
                               <i class="fa fa-barcode" aria-hidden="true"></i><span> Theraphists</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>

                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url();?>admin/Theraphists" class="nav-link"> Add Theraphists</a></li>
                                <li><a href="<?php echo base_url();?>admin/Theraphists/theraphists_list" class="nav-link"> Theraphists list </a></li>
                            </ul>
                        </li>
						
						<li class="treeview testimonials">
                            <a href="#">
                               <i class="fa fa-barcode" aria-hidden="true"></i><span> <?php echo display('testimonials')?> </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>

                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url();?>admin/Testimonial" class="nav-link"> Add Testimonial</a></li>
                                <li><a href="<?php echo base_url();?>admin/Testimonial/testimonial_list" class="nav-link"> Testimonial list </a></li>
                            </ul>
                        </li>
						<li class="treeview faqs">
                            <a href="#">
                               <i class="fa fa-barcode" aria-hidden="true"></i><span> Faqs</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>

                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url();?>admin/Faq" class="nav-link"> Add Faq</a></li>
                                <li><a href="<?php echo base_url();?>admin/Faq/faq_list" class="nav-link"> Faq list </a></li>
                            </ul>
                        </li>
						
						<li class="treeview faqs">
                            <a href="#">
                               <i class="fa fa-barcode" aria-hidden="true"></i><span> Metadata</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>

                            <ul class="treeview-menu">
                                <!--<li><a href="<?php echo base_url();?>admin/metadata" class="nav-link"> Add Metadata</a></li>-->
                                <li><a href="<?php echo base_url();?>admin/metadata/metadata_list" class="nav-link"> Metadata list </a></li>
                            </ul>
                        </li>
						
						<li class="treeview faqs">
                            <a href="#">
                               <i class="fa fa-barcode" aria-hidden="true"></i><span> Promocode</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>

                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url();?>admin/promocode" class="nav-link"> Add Promocode</a></li>
                                <li><a href="<?php echo base_url();?>admin/promocode/promocode_list" class="nav-link"> Promocode list </a></li>
                            </ul>
                        </li>
						
						<li class="treeview faqs">
                            <a href="#">
                               <i class="fa fa-barcode" aria-hidden="true"></i><span> Services</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>

                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url();?>admin/Services" class="nav-link"> Add Service</a></li>
                                <li><a href="<?php echo base_url();?>admin/Services/service_list" class="nav-link"> Service list </a></li>
                            </ul>
                        </li>
						
						
						
						
						<li class="treeview faqs">
                            <a href="#">
                               <i class="fa fa-barcode" aria-hidden="true"></i><span> Services Type</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>

                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url();?>admin/Servicestype" class="nav-link"> Add Service Type</a></li>
                                <li><a href="<?php echo base_url();?>admin/Servicestype/servicetype_list" class="nav-link"> Service Type list </a></li>
                            </ul>
                        </li>

						<li class="treeview commitements">
                            <a href="#">
                               <i class="fa fa-barcode" aria-hidden="true"></i><span> commitements</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>

                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url();?>admin/Commitements" class="nav-link"> Add Commitements</a></li>
                                <li><a href="<?php echo base_url();?>admin/Commitements/commitements_list" class="nav-link"> Commitements list </a></li>
                            </ul>
                        </li>

                        <li class="treeview blog">
                            <a href="#">
                               <i class="fa fa-barcode" aria-hidden="true"></i><span> <?php echo display('blog')?> </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>

                            <ul class="treeview-menu">
                              <li><a href="<?php echo base_url();?>admin/Blog_controller" class="nav-link"><?php echo display('add_new_post')?></a></li>
                                <li><a href="<?php echo base_url();?>admin/Blog_controller/post_list" class="nav-link"> <?php echo display('post_list')?> </a></li>
                            </ul>
                        </li>
						
						<li class="treeview resource">
                            <a href="#">
                               <i class="fa fa-barcode" aria-hidden="true"></i><span> Resource </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>

                            <ul class="treeview-menu">
                              <li><a href="<?php echo base_url();?>admin/Resource_controller" class="nav-link">Add New Resource</a></li>
                                <li><a href="<?php echo base_url();?>admin/Resource_controller/resource_list" class="nav-link">Resource List</a></li>
                            </ul>
                        </li>
						
						<li class="treeview symptoms">
                            <a href="#">
                               <i class="fa fa-barcode" aria-hidden="true"></i><span> Symptoms </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>

                            <ul class="treeview-menu">
                              <li><a href="<?php echo base_url();?>admin/Symptoms_controller" class="nav-link">Add New Symptoms</a></li>
                                <li><a href="<?php echo base_url();?>admin/Symptoms_controller/symptoms_list" class="nav-link">Symptoms List</a></li>
                            </ul>
                        </li>
						
						<li class="treeview symptoms">
                            <a href="#">
                               <i class="fa fa-barcode" aria-hidden="true"></i><span> Precautions </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>

                            <ul class="treeview-menu">
                              <li><a href="<?php echo base_url();?>admin/Precautions_controller" class="nav-link">Add New Precautions</a></li>
                                <li><a href="<?php echo base_url();?>admin/Precautions_controller/precautions_list" class="nav-link">Precautions List</a></li>
                            </ul>
                        </li>

                        <!--<li class="treeview sms_setup">
                            <a href="#">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i> <?php echo display('sms_setup')?> </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>

                            <ul class="treeview-menu">
                              <li><a href="<?php echo base_url();?>admin/Sms_setup_controller/sms_gateway" class="nav-link"> <i class="fa fa-sun-o" aria-hidden="true"></i> <?php echo display('gateway')?></a></li>
                            <li><a href="<?php echo base_url();?>admin/Sms_setup_controller/sms_template" class="nav-link"> <i class="fa fa-sun-o" aria-hidden="true"></i> <?php echo display('sms_template')?> </a></li>
                            <li><a href="<?php echo base_url();?>admin/Sms_setup_controller/sms_scheduler" class="nav-link"> <i class="fa fa-sun-o" aria-hidden="true"></i> <?php echo display('sms_schedule')?> </a></li>
                            <li><a href="<?php echo base_url();?>admin/Sms_setup_controller/custom_sms" class="nav-link"> <i class="fa fa-sun-o" aria-hidden="true"></i> <?php echo display('send_custom_sms')?> </a></li>
                             <li><a href="<?php echo base_url();?>admin/Sms_report_controller/custom_sms_list" class="nav-link"> <i class="fa fa-sun-o" aria-hidden="true"></i> <?php echo display('custom_sms_report')?> </a></li>
                            <li><a href="<?php echo base_url();?>admin/Sms_report_controller/auto_sms_list" class="nav-link"> <i class="fa fa-sun-o" aria-hidden="true"></i> <?php echo display('auto_sms_report')?> </a></li>
                            </ul>
                        </li>-->

                        <li class="treeview email">
                            <a href="#">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i> <?php echo display('email_setup')?> </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>

                            <ul class="treeview-menu">
                               <li><a href="<?php echo base_url();?>admin/email/Email/email_schedule_setup" class="nav-link"> <i class="fa fa-sun-o" aria-hidden="true"></i> <?php echo display('email_schedule_setup')?>  </a></li>
                            <li><a href="<?php echo base_url();?>admin/email/Email/email_list" class="nav-link"> <i class="fa fa-sun-o" aria-hidden="true"></i> <?php echo display('email_list')?> </a></li>
                            <li><a href="<?php echo base_url();?>admin/email/Email/custom_email" class="nav-link"> <i class="fa fa-sun-o" aria-hidden="true"></i> <?php echo display('send_custom_email')?> </a></li>
                            <li><a href="<?php echo base_url();?>admin/email/Email/email_template_setup" class="nav-link"> <i class="fa fa-sun-o" aria-hidden="true"></i> <?php echo display('email_template')?> </a></li>
                            <li><a href="<?php echo base_url();?>admin/email/Email/template_list" class="nav-link"> <i class="fa fa-sun-o" aria-hidden="true"></i> <?php echo display('email_template_list')?>  </a></li>
                            <li><a href="<?php echo base_url();?>admin/email/Email/email_config_setup" class="nav-link"> <i class="fa fa-sun-o" aria-hidden="true"></i> <?php echo display('email_configaretion')?></a></li>
                            </ul>
                        </li>

                       <!-- <li class="treeview print_pattern">
                            <a href="#">
                                <i class="fa fa-print" aria-hidden="true"></i> <?php echo display('print_pattern')?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>

                            <ul class="treeview-menu">
                               <li><a href="<?php echo base_url();?>admin/print_pattern/Print_pattern_controller/view_setup" class="nav-link"> <i class="fa fa-sun-o" aria-hidden="true"></i> <?php echo display('setup_pattern')?> </a></li>
                            <li><a href="<?php echo base_url();?>admin/print_pattern/Print_pattern_controller/view_setup_list" class="nav-link"> <i class="fa fa-sun-o" aria-hidden="true"></i> <?php echo display('pattern_list')?></a></li>
                            </ul>
                        </li>-->

                    <!--<li class="Language">
                        <a href="<?php echo base_url();?>Language"><i class="fa fa-language" aria-hidden="true"></i> <?php echo display('language_setting')?> </a>
                    </li>-->
					
					<li class="Language">
                        <a href="<?php echo base_url();?>admin/Actionlog_controller"><i class="fa fa-language" aria-hidden="true"></i> User Action Log </a>
                    </li>

                   </ul>
					<?php }else{
						//echo 'image--'.$this->session->userdata('doctor_picture');die();
						if($this->session->userdata('doctor_picture') !=""){
                            $img=$this->session->userdata('doctor_picture');
                        }else{
                            $img= base_url().'assets/images/user.png';
                        }
						?>
					
				<div class="user-panel text-center">
                    <div class="image">
                        <img src="<?php echo $img;?>" class="img-circle" alt="User Image">
                    </div>
                    <div class="info 13">
                        <p><?php echo $this->session->userdata('doctor_name'); ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
					</div>
					<ul style="text-align: left; margin-left: 53px;">
							<li>
								<a href="<?php echo base_url();?>profile"><i class="pe-7s-users"></i><?php echo display('profile');?></a>
							</li>
							<li>
								<a href="<?php echo base_url();?>admin/Setting_controller/password_change"><i class="pe-7s-key"></i><?php echo display('change_password');?></a>
							</li>
							<li>
								<a href="<?php echo base_url();?>logout"><i class="fa fa-sign-out fa-fw"></i> <?php echo display('logout');?></a>
							</li>
						</ul>
                </div>


                <ul class="sidebar-menu">

                    <li class="active">
                        <a href="<?php echo base_url();?>admin/Dashboard"><i class="ti-home"></i> <span><?php echo display('deashbord');?></span>
                        </a>
                    </li>

                    <?php if($this->session->userdata('user_type') == 1) { ?>
					<li class="treeview pres">
                            <a href="#">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i><span><?php echo display('prescription')?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url();?>admin/Prescription_controller/create_new_prescription"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo display('create_generic')?> </a></li>
                                <li><a href="<?php echo base_url();?>admin/Prescription_controller/prescription_list"> <i class="fa fa-list" aria-hidden="true"></i> <?php echo display('prescription_list')?></a></li>
                            </ul>
                        </li>
					<?php } ?>	
                    <li class="treeview appointment">
                        <a href="#"><i class="fa fa-phone-square" aria-hidden="true"></i> <?php echo display('appointment')?>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                         <ul class="treeview-menu">
                            <li><a href="<?php echo base_url()?>admin/Appointment_controller"> <i class="fa fa-plus" aria-hidden="true"></i> <?php echo display('create_appointment')?></a></li>
                            <li><a href="<?php echo base_url()?>admin/Appointment_controller/appointment_list"> <i class="fa fa-list" aria-hidden="true"></i> <?php echo display('appointment_list')?></a></li>
							<li><a href="<?php echo base_url()?>admin/Appointment_controller/appointment_list_referral"> <i class="fa fa-list" aria-hidden="true"></i>Referral Appointment</a></li>
                        </ul>
                    </li>

                    <li class="treeview patient">
                        <a href="#"><i class="fa fa-child" aria-hidden="true"></i> <?php echo display('patient')?>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url()?>create_new_patient"> <i class="fa fa-plus" aria-hidden="true"></i> </i> <?php echo display('add_new_patient')?></a></li>
                            <li><a href="<?php echo base_url();?>patient_list"> <i class="fa fa-list" aria-hidden="true"></i> </i> <?php echo display('patient_list')?></a></li>
							<li><a href="<?php echo base_url();?>admin/Patient_controller/referral_patient_list"> <i class="fa fa-list" aria-hidden="true"></i> referral patient list</a></li>
                        </ul>
                    </li>

					<li class="treeview schedule">
                            <a href="#">
                               <i class="fa fa-weixin" aria-hidden="true"></i><span><?php echo display('schedule')?> </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url();?>admin/Schedule_controller/add_schedule"> <i class="fa fa-plus" aria-hidden="true"></i> <?php echo display('add_schedule')?></a></li>
                                <li><a href="<?php echo base_url();?>admin/Schedule_controller/schedule_list"> <i class="fa fa-list" aria-hidden="true"></i> <?php echo display('schedule_list')?></a></li>
                            </ul>
                        </li>

                     <!--<li class="treeview emergency_stop">
                        <a href="#"><i class="fa fa-paw" aria-hidden="true"></i> <?php echo display('emergency_stop')?>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                         <ul class="treeview-menu">
                            <li><a href="<?php echo base_url();?>admin/Emergency_stop_controller"> <i class="fa fa-stop-circle" aria-hidden="true"></i> <?php echo display('emergency_stop_setup')?></a></li>
                            <li><a href="<?php echo base_url();?>admin/Emergency_stop_controller/emergency_stop_list"> <i class="fa fa-list" aria-hidden="true"></i><?php echo display('emergency_stop_list')?></a></li>
                        </ul>
                    </li>-->

                     <li class="treeview setup_data">
                        <a href="#">
                           <i class="fa fa-bar-chart-o fa-fw"></i> Medicine
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                        </a>
                     <ul class="treeview-menu">
                        <li><a href="<?php echo base_url();?>admin/Setup_controller/add_medicine" class="nav-link"> <?php echo display('add_medicine')?></a></li>
                        <li><a href="<?php echo base_url();?>admin/Setup_controller/medicine_List" class="nav-link"> <?php echo display('medicine_List')?></a></li>
                        <!--<li> <a href="<?php echo base_url();?>admin/Setup_controller/add_medicine_company" class="nav-link"> <?php echo display('add_company')?></a></li>
                        <li> <a href="<?php echo base_url();?>admin/Setup_controller/add_medicine_group" class="nav-link"></i> <?php echo display('add_group')?></a></li>-->
                        <li> <a href="<?php echo base_url();?>admin/Setup_controller/advice" class="nav-link"> <?php echo display('add_advice')?></a></li>
                        <li> <a href="<?php echo base_url();?>admin/Disease_test_controller/add_new_test" class="nav-link"> <?php echo display('add_test_name')?></a></li>
                        <li>  <a href="<?php echo base_url();?>admin/Disease_test_controller/test_list" class="nav-link"> <?php echo display('test_list')?></a></li>
                        </ul>
                    </li>
					
					<!--<li class="treeview sms_setup">
                            <a href="#">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i> <?php echo display('sms_setup')?> </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>

                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url();?>admin/Sms_setup_controller/sms_template" class="nav-link"> <i class="fa fa-sun-o" aria-hidden="true"></i> <?php echo display('sms_template')?> </a></li>
                        <li><a href="<?php echo base_url();?>admin/Sms_setup_controller/sms_scheduler" class="nav-link"> <i class="fa fa-sun-o" aria-hidden="true"></i> <?php echo display('sms_schedule')?> </a></li>
                        <li><a href="<?php echo base_url();?>admin/Sms_setup_controller/custom_sms" class="nav-link"> <i class="fa fa-sun-o" aria-hidden="true"></i> <?php echo display('send_custom_sms')?> </a></li>
                        <li><a href="<?php echo base_url();?>admin/Sms_report_controller/custom_sms_list" class="nav-link"> <i class="fa fa-sun-o" aria-hidden="true"></i> <?php echo display('custom_sms_report')?> </a></li>
                        <li><a href="<?php echo base_url();?>admin/Sms_report_controller/auto_sms_list" class="nav-link"> <i class="fa fa-sun-o" aria-hidden="true"></i> <?php echo display('auto_sms_report')?> </a></li>
                        </ul>
                    </li>-->

                </ul>
					<?php }?>
                 <?php } else { ?>
					
					<?php 
					//echo "here--".$this->session->userdata('user_picture');die();
					if($this->session->userdata('user_picture')!=""){
                            $img=$this->session->userdata('user_picture');
                        }else{
                            $img= base_url().'assets/images/user.png';
                        }
					?>		
							
                <div class="user-panel text-center">
                    <div class="image">
                        <img src="<?php echo $img;?>" class="img-circle" alt="User Image">
                    </div>
                    <div class="info 14">
                        <p><?php echo $this->session->userdata('user_name'); ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
					</div>
					<ul style="text-align: left; margin-left: 53px;">
							<!--<li>
								<a href="<?php echo base_url();?>profile"><i class="pe-7s-users"></i><?php echo display('profile');?></a>
							</li>
							<li>
								<a href="<?php echo base_url();?>admin/Setting_controller/password_change"><i class="pe-7s-key"></i><?php echo display('change_password');?></a>
							</li>-->
							<li>
								<a href="<?php echo base_url();?>logout"><i class="fa fa-sign-out fa-fw"></i> <?php echo display('logout');?></a>
							</li>
						</ul>
                </div>


                <ul class="sidebar-menu">

                    <li class="active">
                        <a href="<?php echo base_url();?>admin/Dashboard"><i class="ti-home"></i> <span><?php echo display('deashbord');?></span>
                        </a>
                    </li>

                    

					<li class="treeview pres" style="display:none;">
                            <a href="#">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i><span><?php echo display('prescription')?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <!--<li><a href="<?php echo base_url();?>admin/Prescription_controller/create_new_prescription"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo display('create_trade')?> </a></li>-->
                                <li class=""><a href="<?php echo base_url();?>admin/Generic_controller/create_new_generic"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo display('create_generic')?></a></li>
                                <li><a href="<?php echo base_url();?>admin/Prescription_controller/prescription_list"> <i class="fa fa-list" aria-hidden="true"></i> <?php echo display('prescription_list')?></a></li>
                            </ul>
                        </li>
						
                    <li class="treeview appointment">
                        <a href="#"><i class="fa fa-phone-square" aria-hidden="true"></i> <?php echo display('appointment')?>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                         <ul class="treeview-menu">
                            <li><a href="<?php echo base_url()?>admin/Appointment_controller"> <i class="fa fa-plus" aria-hidden="true"></i> <?php echo display('create_appointment')?></a></li>
                            <li><a href="<?php echo base_url()?>admin/Appointment_controller/appointment_list"> <i class="fa fa-list" aria-hidden="true"></i> <?php echo display('appointment_list')?></a></li>
                        </ul>
                    </li>

                    <li class="treeview patient">
                        <a href="#"><i class="fa fa-child" aria-hidden="true"></i> <?php echo display('patient')?>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url()?>create_new_patient"> <i class="fa fa-plus" aria-hidden="true"></i> </i> <?php echo display('add_new_patient')?></a></li>
                            <li><a href="<?php echo base_url();?>patient_list"> <i class="fa fa-list" aria-hidden="true"></i> </i> <?php echo display('patient_list')?></a></li>
                        </ul>
                    </li>

					<li class="treeview schedule">
                            <a href="#">
                               <i class="fa fa-weixin" aria-hidden="true"></i><span><?php echo display('schedule')?> </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url();?>admin/Schedule_controller/add_schedule"> <i class="fa fa-plus" aria-hidden="true"></i> <?php echo display('add_schedule')?></a></li>
                                <li><a href="<?php echo base_url();?>admin/Schedule_controller/schedule_list"> <i class="fa fa-list" aria-hidden="true"></i> <?php echo display('schedule_list')?></a></li>
                            </ul>
                        </li>

                     <!--<li class="treeview emergency_stop">
                        <a href="#"><i class="fa fa-paw" aria-hidden="true"></i> <?php echo display('emergency_stop')?>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                         <ul class="treeview-menu">
                            <li><a href="<?php echo base_url();?>admin/Emergency_stop_controller"> <i class="fa fa-stop-circle" aria-hidden="true"></i> <?php echo display('emergency_stop_setup')?></a></li>
                            <li><a href="<?php echo base_url();?>admin/Emergency_stop_controller/emergency_stop_list"> <i class="fa fa-list" aria-hidden="true"></i><?php echo display('emergency_stop_list')?></a></li>
                        </ul>
                    </li>-->

                     <li class="treeview setup_data">
                        <a href="#">
                           <i class="fa fa-bar-chart-o fa-fw"></i> Medicine
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                        </a>
                     <ul class="treeview-menu">
                        <li><a href="<?php echo base_url();?>admin/Setup_controller/add_medicine" class="nav-link"> <?php echo display('add_medicine')?></a></li>
                        <li><a href="<?php echo base_url();?>admin/Setup_controller/medicine_List" class="nav-link"> <?php echo display('medicine_List')?></a></li>
                       <!-- <li> <a href="<?php echo base_url();?>admin/Setup_controller/add_medicine_company" class="nav-link"> <?php echo display('add_company')?></a></li>
                        <li> <a href="<?php echo base_url();?>admin/Setup_controller/add_medicine_group" class="nav-link"></i> <?php echo display('add_group')?></a></li>-->
                        <li> <a href="<?php echo base_url();?>admin/Setup_controller/advice" class="nav-link"> <?php echo display('add_advice')?></a></li>
                        <li> <a href="<?php echo base_url();?>admin/Disease_test_controller/add_new_test" class="nav-link"> <?php echo display('add_test_name')?></a></li>
                        <li>  <a href="<?php echo base_url();?>admin/Disease_test_controller/test_list" class="nav-link"> <?php echo display('test_list')?></a></li>
                        </ul>
                    </li>


                     <!--<li class="treeview sms_setup">
                            <a href="#">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i> <?php echo display('sms_setup')?> </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>

                            <ul class="treeview-menu">
                            <li><a href="<?php echo base_url();?>admin/Sms_setup_controller/sms_template" class="nav-link"> <i class="fa fa-sun-o" aria-hidden="true"></i> <?php echo display('sms_template')?> </a></li>
                            <li><a href="<?php echo base_url();?>admin/Sms_setup_controller/sms_scheduler" class="nav-link"> <i class="fa fa-sun-o" aria-hidden="true"></i> <?php echo display('sms_schedule')?> </a></li>
                            <li><a href="<?php echo base_url();?>admin/Sms_setup_controller/custom_sms" class="nav-link"> <i class="fa fa-sun-o" aria-hidden="true"></i> <?php echo display('send_custom_sms')?> </a></li>
                             <li><a href="<?php echo base_url();?>admin/Sms_report_controller/custom_sms_list" class="nav-link"> <i class="fa fa-sun-o" aria-hidden="true"></i> <?php echo display('custom_sms_report')?> </a></li>
                            <li><a href="<?php echo base_url();?>admin/Sms_report_controller/auto_sms_list" class="nav-link"> <i class="fa fa-sun-o" aria-hidden="true"></i> <?php echo display('auto_sms_report')?> </a></li>
                            </ul>
                        </li>-->
                    
                    
                </ul>
                <?php }  ?>

                </div> <!-- /.sidebar -->
            </aside>