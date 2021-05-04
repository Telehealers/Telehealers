<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('edit_slider');?></h1>
            <small><?php echo display('edit_slider');?></small>
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
            <div class="panel panel-default panel-form">

                 <div class="panel-heading">
                    <div class="panel-title">
                        <h4><?php echo display('edit_slider');?></h4>
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
                            $attributes = array('class' => 'form-horizontal','role'=>'form');
                            echo form_open_multipart('admin/Web_setup_controller/save_edit_slider', $attributes);                
                         ?>
                        
                        <div class="form-body">
                            <input type="hidden" name="id" value="<?php echo html_escape(@$info->id);?>">
                                <div class="form-group">
                                   <label class="col-md-3 control-label"><?php echo display('heading');?></label>
                                   <div class="col-md-5">										<textarea name="head_line"  class="form-control"><?php echo html_escape(@$info->heading);?></textarea>	
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> <?php echo display('details');?></label>
                                    <div class="col-md-5">                                        <textarea name="details"  class="form-control"><?php echo html_escape(@$info->details);?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                   <label class="col-md-3 control-label">Sequence</label>
                                   <div class="col-md-5">
                                        <input type="number" name="sequence" value="<?php echo html_escape(@$info->sequence);?>"  class="form-control"> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('picture');?></label>
                                    <div class="col-md-5">
                                    <img src="<?php echo html_escape(@$info->picture);?>" width="250">
                                        
                                        <input type="file" name="picture">       
                                        <input type="hidden" name="pic" value="<?php echo html_escape(@$info->picture);?>">       										Size: 585*314(pixel)
                                    </div>
                                </div>
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
    </div> <!-- /#page-wrapper -->            
    </section>
</div>



