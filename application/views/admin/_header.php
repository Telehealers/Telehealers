<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo (html_escape(@$title))?@$title:'Admin panel'?></title>
        
        <?php 
            //query for logo 
            $result = $this->db->select('*')->from('web_pages_tbl')->where('name','fabicon')->where('status',1)->get()->row();
        ?>
        <!-- favicon -->
        <link rel="icon" href="<?php echo (!empty(html_escape($result->picture))?html_escape($result->picture):null); ?>" sizes="16x16"> 
       
        <!-- jquery-ui css -->
        <link href="<?php echo base_url()?>assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap -->
        <link href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

        <link href="<?php echo base_url()?>assets/plugins/lobipanel/lobipanel.min.css" rel="stylesheet" type="text/css"/>
        <!-- Font Awesome -->
        <link href="<?php echo base_url()?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- Pe-icon -->
        <link href="<?php echo base_url()?>assets/plugins/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>

        <!-- Themify icons -->
        <link href="<?php echo base_url()?>assets/themify-icons/themify-icons.css" rel="stylesheet" type="text/css"/>
      
        <!-- DataTables CSS -->
        <link href="<?php echo base_url();?>assets/plugins/datatables/dataTables.min.css" rel="stylesheet" type="text/css"/>
        <!-- datepiker -->
        <link href="<?php echo base_url()?>assets/plugins/ui-datetimepicker/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css"/>
       <!-- summernote css -->
        <link href="<?php echo base_url()?>assets/plugins/summernote/summernote.css" rel="stylesheet" type="text/css"/>
        <!-- Toastr css -->
        <link href="<?php echo base_url()?>assets/plugins/toastr/toastr.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style -->
        <link href="<?php echo base_url()?>assets/dist/css/styleBD.min.css" rel="stylesheet" type="text/css"/>
        <!-- custom style -->
        <link href="<?php echo base_url()?>assets/dist/css/custom_style.css" rel="stylesheet" type="text/css"/>
        <!-- jQuery -->
        <script src="<?php echo base_url()?>assets/plugins/jQuery/jquery.min.js" type="text/javascript"></script>
		
		<script src="https://cdn.tiny.cloud/1/7n1dopf3t9jsskfy0mruu2z6qdpf40orejhimntreylf4wuf/tinymce/5/tinymce.min.js" referrerpolicy="origin">

    </head>

<?php 
//query for logo 
$result = $this->db->select('*')->from('web_pages_tbl')->where('name','logo')->where('status',1)->get()->row();
?>


    <body class="hold-transition sidebar-mini">

        <input type="hidden" id="base_url" value="<?php echo base_url()?>">
        <input type="hidden" id="segment1" value="<?php echo $this->uri->segment(1); ?>">
        <input type="hidden" id="segment2" value="<?php echo $this->uri->segment(2); ?>">
        <input type="hidden" id="segment3" value="<?php echo $this->uri->segment(3); ?>">
    
       
        
        <div class="se-pre-con"></div>
        <!-- Site wrapper -->
        <div class="wrapper">
            <header class="main-header"> 
                <a href="<?php echo base_url();?>admin/Dashboard" class="logo">
                    <span class="logo-mini">
                        <img src="<?php echo html_escape($result->picture);?>" alt="">
                    </span>
                    <span class="logo-lg">
                        <img src="<?php echo html_escape($result->picture);?>" alt="">
                    </span>
                </a>

                

                <!-- Header Navbar -->
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
                                    <li>
                                        <a href="<?php echo base_url();?>admin/Users_controller/update_profile"><i class="pe-7s-users"></i> <?php echo display('profile');?></a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url();?>admin/Setting_controller/password_change"><i class="pe-7s-key"></i><?php echo display('change_password');?></a>
                                    </li>
                                    
                                </ul>
                            </li>
                        </ul>
                    <?php }  ?>    
                    </div>
                </nav>
            </header>
			<ul>
				<li>
					<a href="<?php echo base_url();?>logout"><i class="fa fa-sign-out fa-fw"></i> <?php echo display('logout');?></a>
				</li>
			<ul>