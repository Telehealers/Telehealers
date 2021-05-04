<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1>Edit</h1>
            <small>Edit</small>
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
            <div  class="panel panel-default panel-form">

                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>Edit</h4>
                    </div>
                </div>
                
                <div class="panel-body">
                    <div class="portlet-body form">
                        <?php 
                            $msg = $this->session->flashdata('message');
                            if($msg !=''){
                                echo htmlspecialchars_decode($msg);
                            }
                            if($this->session->flashdata('exception')!=""){
                                echo $this->session->flashdata('exception');
                            }

                            $attributes = array('class' => 'form-horizontal','role'=>'form','name'=>'s_info');
                            echo form_open_multipart('admin/promocode/save_edit_post', $attributes);                
                         ?>
                        
                            <div class="form-body">

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Promocode : </label>
                                    <div class="col-md-10">
                                        <input type="text" name="title" class="form-control" value="<?php echo html_escape($post_info->title); ?>" placeholder="Title" required> 
                                        <span class="error-msg"><?php echo form_error('title'); ?> </span>
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="col-md-2 control-label"><span class="text-danger">*</span>Limit : </label>
                                    <div class="col-md-10">
                                        <input type="number" min="1" name="p_limit" class="form-control" required="required" value="<?php echo $post_info->p_limit; ?>">
                                        <span class="error-msg"><?php echo form_error('limit'); ?> </span>
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="col-md-2 control-label"><span class="text-danger">*</span>Price : </label>
                                    <div class="col-md-10">
                                        <input type="text" name="p_price" class="form-control" value="<?php echo html_escape($post_info->price); ?>" placeholder="Price" required> 
                                        <span class="error-msg"><?php echo form_error('price'); ?> </span>
                                    </div>
                                </div>																
																								

                                

                                
                                <input type="hidden" name="id" value="<?php echo html_escape($post_info->id); ?>">
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-success"><?php echo display('update');?></button>
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



