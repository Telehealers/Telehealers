<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('edit_post');?></h1>
            <small><?php echo display('edit_post');?></small>
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
                        <h4><?php echo display('edit_post');?></h4>
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
                            echo form_open_multipart('admin/Blog_controller/save_edit_post', $attributes);                
                         ?>
                        
                            <div class="form-body">


                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('title');?> : </label>
                                    <div class="col-md-7">
                                        <input type="text" name="title" class="form-control" value="<?php echo html_escape($post_info->title); ?>" placeholder="Title" required> 
                                        <span class="error-msg"><?php echo form_error('title'); ?> </span>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('details');?> : </label>
                                        <div class="col-md-7">
                                            <textarea name="details" id="" 
                                            class="form-control" rows="6" required> <?php echo htmlspecialchars_decode($post_info->details); ?></textarea>
                                        </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('picture');?> : </label>
                                    <div class="col-md-7">
                                    <img src="<?php echo html_escape($post_info->picture);?>" width="250px;">
                                        <input type="file" name="picture">    
                                         <span>[ jpg,png,jpeg,gif and max size is 1MB]</span>   
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?php echo html_escape($post_info->id); ?>">
                                <input type="hidden" name="pic" value="<?php echo html_escape($post_info->picture); ?>">
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



