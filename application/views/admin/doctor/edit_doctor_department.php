<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1>Edit Doctor Department</h1>
            <small>Edit Doctor Department</small>
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
                        <h4>Edit Doctor Department</h4>
                    </div>
                </div>
                
                <div class="panel-body">
                        <div class="portlet-body form">
                        <?php 
                            $attributes = array('class' => 'form-horizontal','method'=>'post','role'=>'form');
                            echo form_open_multipart('admin/Department_controller/update_doctor_department', $attributes);    

							if(is_array($depart_info) && count($depart_info)>0){
								$department_id = $depart_info[0]['department_id'];
								$department_name = $depart_info[0]['department_name'];
							}		
                         ?>
                            <div class="form-body">
							<input type="hidden" name="department_id" value="<?php echo $department_id; ?>">
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><span class="text-danger">*</span>Department Name :</label>
                                    <div class="col-md-5">
                                        <input type="text" name="department_name" class="form-control" value="<?php echo $department_name;?>" placeholder="Department Name" required> 
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-offset-3 col-sm-6">
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
                                        <a href="<?php echo base_url();?>admin/Department_controller/edit_doctor_department/<?php echo html_escape($value->department_id);?>" onclick="return confirm('Are you want to delelte?');" class="btn btn-xs btn-danger">
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


