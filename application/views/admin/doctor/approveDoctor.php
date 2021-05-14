<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1>Doctor Approve Content</h1>
            <small>Doctor Approve Content</small>
            <ol class="breadcrumb">
                <li><a target="_blank" href="<?php echo base_url();?>"><i class="pe-7s-home"></i> <?php echo display('site_view')?></a></li>
                <li class="active"><a href="<?php echo base_url();?>admin/Dashboard"><?php echo display('deashbord');?></a></li>
            </ol>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <!--  form area -->
        <div class="col-sm-12">
            <div class="panel panel-bd">
                <div class="panel-heading ">
                    <div class="panel-title" >
                        <h4>Doctor Approve Content</h4>
                    </div>
               </div>

                <div class="panel-body">
                    <div class="portlet-body form">

                        <?php 
                            $mag = $this->session->flashdata('message');
                            if($mag !=''){
                                echo htmlspecialchars_decode($mag);
                            }
                            $attributes = array('class' => 'form-horizontal','name'=>'d_info','role'=>'form');
                            echo form_open_multipart('admin/Doctor_controller/approveDoctorSave', $attributes);                
                        ?>
                            <div class="form-body">
							
								
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Content</label>
                                    <div class="col-md-7">
                                        <textarea name="content" id="summernote" class=" form-control" rows="4"><?php echo html_escape(@$content); ?>
                                         </textarea>

                                        <span class="text-danger"><?php echo form_error('about_me'); ?> </span>
                                    </div>
                                </div>
								

                            </div>

                            <div class="form-group row">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-success"><?php echo display('submit')?></button>
                                </div>
                            </div>
                            
                        <?php echo form_close();?>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>            
    </section>
</div>

