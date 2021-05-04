<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('send_custom_sms');?></h1>
            <small><?php echo display('send_custom_sms');?></small>
                <ol class="breadcrumb">
                    <li><a target="_blank" href="<?php echo base_url();?>"><i class="pe-7s-home"></i> <?php echo display('site_view')?></a></li>
                    <li class="active"><a href="<?php echo base_url();?>admin/Dashboard"><?php echo display('deashbord');?></a></li>
                </ol>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-12 ">
             <?php
                $msg = $this->session->flashdata('message');
                if($msg){
                    echo htmlspecialchars_decode($msg);
                } 
            ?>
            <div  class="panel panel-default panel-form">

                <div class="panel-heading ">
                    <div class="panel-title" >
                        <h4><?php echo display('send_custom_sms');?></h4>
                    </div>
                </div>


                <div class="panel-body">
                    <div class="portlet-body form">
                    
                    <?php 
                        $attributes = array('class' => 'form-horizontal','id' => 'MyForm','role'=>'form');
                        echo form_open_multipart('admin/Sms_setup_controller/send_custom_sms', $attributes);  
                    ?>
                        
                    <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label"> <?php echo display('reciver');?> : </label>
                                <div class="col-md-5">
                                    <input type="number" class="form-control" required="1" name="to" placeholder="<?php echo display('reciver');?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"> <?php echo display('provider');?> : </label>
                                <div class="col-md-5">
                                    <select class="form-control" name="gateway" required="1">
                                        <?php 
                                        foreach ($gateway_list as $g_list) {
                                           echo '<option value="'.html_escape($g_list->gateway_id).'">'.html_escape($g_list->provider_name).'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>  
                            

                            <div class="form-group view_tmp">
                                <label class="col-md-3 control-label"> <?php echo display('sms_template');?> : </label>
                                <div class="col-md-5">
                                    <textarea name="teamplate" required="1" class="form-control" rows="6"></textarea>
                                </div>
                            </div> 
                        </div>

                           <div class="form-group row">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="reset" class="btn btn-danger"><?php echo display('reset');?></button>
                                    <button type="submit" class="btn btn-success sav_btn"><?php echo display('send');?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>  
         </div>
    </div>

    </section>
</div>


<script src="<?php echo base_url()?>assets/admin_script.js" type="text/javascript"></script>



