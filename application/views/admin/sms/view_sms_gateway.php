
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('gateway');?></h1>
            <small><?php echo display('gateway');?></small>
            <ol class="breadcrumb">
                <li><a target="_blank" href="<?php echo base_url();?>"><i class="pe-7s-home"></i> <?php echo display('site_view')?></a></li>
                <li class="active"><a href="<?php echo base_url();?>admin/Dashboard"><?php echo display('deashbord');?></a></li>
            </ol>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <?php
                    $msg = $this->session->flashdata('message');
                    if($msg){
                        echo htmlspecialchars_decode($msg);
                    } 
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading ">
                    <div class="panel-title" >
                        <h4><?php echo display('gateway');?></h4>
                    </div>
                </div>

                
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr class="center">
                                    <th class="all"><?php echo display('status');?></th>
                                    <th class="all"><?php echo display('provider');?> </th>
                                    <th class="all"><?php echo display('user_name');?> </th>
                                    <th class="all"><?php echo display('password');?> </th>
                                    <th class="all"><?php echo display('sender');?> </th>
                                    <th class="all"><?php echo display('action');?> </th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php foreach ($gateway_list as $value) { ?> 
                                <?php 
                                    $attributes = array('role'=>'form');
                                    echo form_open_multipart('admin/Sms_setup_controller/save_gateway', $attributes);  
                                 ?>   
                                <tr>
                                <input type="hidden" name="id" value="<?php echo html_escape($value->gateway_id);?>">
                                    <td><input type="radio" <?php echo html_escape($value->default_status)==1?'checked="checked"':''?> class="form-control" name=""></td>
                                    <td><?php echo '<a target="_blank" href="'.html_escape($value->link).'">'.html_escape($value->provider_name).'</a>'?></td>
                                    <td><input type="text" class="form-control" value="<?php echo html_escape($value->user);?>" name="user"></td>
                                    <td><input type="text" class="form-control" value="<?php echo html_escape($value->password)?>" name="password"></td>
                                    <td><input type="text" class="form-control" value="<?php echo html_escape($value->authentication)?>" name="authentication"></td>
                                    <td class="text-right">
                                        <input type="submit" value="<?php echo display('update');?>" class="btn btn-xs btn-warning">
                                    </td>
                                </tr>
                                </form>
                                <?php } ?>
                               
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>            
    </section>
</div>





