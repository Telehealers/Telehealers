

<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('sms_template_setup');?></h1>
            <small><?php echo display('sms_template_setup');?></small>
            <ol class="breadcrumb">
                <li><a target="_blank" href="<?php echo base_url();?>"><i class="pe-7s-home"></i> <?php echo display('site_view')?></a></li>
                <li class="active"><a href="<?php echo base_url();?>admin/Dashboard"><?php echo display('deashbord');?></a></li>
            </ol>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php
            $msg = $this->session->flashdata('message');
            if($msg){
                echo htmlspecialchars_decode($msg);
            } 
        ?>


    <div class="row">
        <div class="col-md-12 ">
            <div  class="panel panel-default panel-form">
                
                <div class="panel-heading ">
                    <div class="panel-title" >
                        <h4><?php echo display('sms_template_setup');?></h4>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="portlet-body form">
                    
                    <?php 
                        $attributes = array('class' => 'form-horizontal','id' => 'MyForm','role'=>'form');
                        echo form_open_multipart('admin/Sms_setup_controller/save_sms_template', $attributes);  
                    ?>
                        
                    <div class="form-body">
                       <input type="hidden" name="id" id="id" value=""/>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><span class="text-danger">*</span><?php echo display('template_name');?> : </label>
                                <div class="col-md-5">
                                    <input type="text" id="template_name" class="form-control" value="" required="1" name="teamplate_name" placeholder="<?php echo display('template_name');?>">
                                </div>
                            </div> 

                            <div class="form-group">
                                <label class="col-md-3 control-label"><span class="text-danger">*</span><?php echo display('sms_template');?> : </label>
                                <div class="col-md-5">
                                     <textarea name="teamplate" id="teamplate" value="" class="form-control" required="1" rows="6" required=""></textarea>
                                </div>
                            </div> 
                        </div>

                           <div class="form-group row">
                                <div class="col-sm-offset-3 col-sm-6">
                                    
                                    <button type="reset" class="btn btn-danger"><?php echo display('reset');?></button>
                                    <button type="submit" class="btn btn-success sav_btn"><?php echo display('submit');?></button>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>  
         </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="breadcrumbs ng-scope">
                <h2> <?php echo display('sms_template_list');?></h2>
            </div>
        </div>
    </div>
    <div class="row">
            <div class="col-md-12">
                
                <div class="panel panel-default">
                    <div class="panel-body">
                         <div class="table-responsive">
                        <table width="100%" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr class="center">
                                    <th class="all"> <?php echo display('set_default');?> </th>
                                    <th class="all"><?php echo display('template_name');?></th>
                                    <th class="all"><?php echo display('sms_template');?> </th>
                                    <th class="all"><?php echo display('action');?> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($teamplate as $value) {?>
                                <tr>
                                    <td> 
                                        <a class="btn btn-info" href="<?php echo base_url(); ?>admin/Sms_setup_controller/set_default_template/<?php echo html_escape($value->teamplate_id) . '/' . html_escape($value->default_status); ?>"><span class="glyphicon glyphicon-<?php echo $value->default_status==1?'ok':'remove';?>"></span></a>
                                    </td>
                                    <td id="t_<?php echo html_escape($value->teamplate_id);?>"><?php echo html_escape($value->teamplate_name);?></td>
                                    <td id="td_<?php echo html_escape($value->teamplate_id);?>"><?php echo htmlspecialchars_decode($value->teamplate);?></td>
                                    <td class="text-right" width="100">
                                        <a onclick="js_value(<?php echo $value->teamplate_id;?>)" class="btn btn-xs btn-warning">
                                        <i class="fa fa-edit"></i> </a>
                                        <a  class="btn btn-xs btn-danger" href="<?php echo base_url();?>admin/Sms_setup_controller/delete_teamplate/<?php echo html_escape($value->teamplate_id) ;?>" onclick="return confirm('Are you want to delelte?');">
                                        <i class="fa fa-trash"></i> </a>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
        </div>

    </section>
</div>




