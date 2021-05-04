<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1>Add Doctor Department</h1>
            <small>Add Doctor Department</small>
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

                <div class="panel-heading ">
                    <div class="panel-title" >
                        <h4>Add Doctor Department</h4>
                    </div>
                </div>
                
                <div class="panel-body">
                        <div class="portlet-body form">
                        <?php 
                            $attributes = array('class' => 'form-horizontal','method'=>'post','role'=>'form');
                            echo form_open_multipart('admin/Department_controller/save_doctor_department', $attributes);                
                         ?>
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><span class="text-danger">*</span>Department Name :</label>
                                    <div class="col-md-5">
                                        <input type="text" name="department_name" class="form-control" placeholder="Department Name" required> 
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="reset" class="btn btn-danger"><?php echo display('reset');?></button>
                                    <button type="submit" class="btn btn-success"><?php echo display('submit');?></button>
                                </div>
                            </div>
                        <?php echo form_close();?>
                    </div>
                </div>
            </div>
        </div>

            <div class="col-md-12">
                <?php
                    $msg = $this->session->flashdata('message');
                    $error = $this->session->flashdata('exception');
                    if($msg){
                        echo htmlspecialchars_decode($msg);
                    }
                    if($error){
                        echo htmlspecialchars_decode($error);
                    }
                ?>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                            <thead>
                                <tr class="center">
                                    <th class="all">Department Name</th>
                                    <th class="all"><?php echo display('action');?> </th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php 
                                    foreach ($mdc_info as $value) {
                                ?>
                                <tr>
                                    <td><?php echo html_escape($value->department_name);?></td>
                                    <td class="text-right">
                                        <a href="<?php echo base_url();?>admin/Department_controller/edit_doctor_department/<?php echo html_escape($value->department_id);?>" class="btn btn-xs btn-danger">
                                        <i class="fa fa-edit"></i> </a>
										<a href="<?php echo base_url();?>admin/Department_controller/delete_doctor_department/<?php echo html_escape($value->department_id);?>" onclick="return confirm('Are you want to delelte?');" class="btn btn-xs btn-danger">
                                        <i class="fa fa-trash"></i> </a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>            
    </section>
</div>


