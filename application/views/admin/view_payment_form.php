

<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('Setup_Payment_Method');?></h1>
            <small><?php echo display('Setup_Payment_Method');?></small>
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
                <div  class="panel panel-default panel-form">
                    
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Setup Razorpay Payment Getway</h4>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="portlet-body form">
                             <?php 
                                $msg = $this->session->flashdata('message');
                                  if($msg !=''){
                                      echo htmlspecialchars_decode($msg);
                                  }
                                  
                                $attributes = array('class' => 'form-horizontal','role'=>'form');
                                echo form_open_multipart('admin/payment_method/Payment/save_setup', $attributes);                
                             ?>
                            
                            <div class="form-body">

                                    <div class="form-group">
                                        <label class="col-md-3 control-label"><span class="text-danger">*</span>API KEY:</label>
                                        <div class="col-md-6">
                                            <input type="text" name="api_key" value="<?php echo html_escape(@$info->paypal_email);?>" class="form-control"  required  > 
                                        </div>
                                    </div>																		<div class="form-group">                                        <label class="col-md-3 control-label"><span class="text-danger">*</span>SECRET KEY: </label>                                        <div class="col-md-6">                                            <input type="text" name="secret_key" value="<?php echo html_escape(@$info->secret_key);?>" class="form-control"  required  >                                         </div>                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label"><span class="text-danger">*</span> <?php echo display('amount');?> </label>
                                        <div class="col-md-6">
                                            <input type="text"  name="amount" value="<?php echo html_escape(@$info->amount);?>" class="form-control" required > 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        
                                        <label class="col-md-3 control-label"> <span class="text-danger">*</span> <?php echo display('status');?> </label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="status" required="">
                                                <option value="0" <?php echo (@$info->status==0?'selected':'')?>>Demo</option>
                                                <option value="1" <?php echo (@$info->status==1?'selected':'')?>>Active</option>
                                            </select>
                                        </div>
                                    </div>


                                <div class="form-group row">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="reset" class="btn btn-danger"><?php echo display('reset'); ?></button>
                                        <button type="submit" class="btn btn-success"><?php echo display('submit'); ?></button>
                                    </div>
                                </div>
                        </div>
                        <?php echo form_close();?>
                    </div>
                </div>  
             </div>
            </div>
        </div>
    </section>
</div>

