
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1>Doctor List</h1>
            <small>Doctor List</small>
           <ol class="breadcrumb">
                <li><a target="_blank" href="<?php echo base_url();?>"><i class="pe-7s-home"></i> <?php echo display('site_view')?></a></li>
                <li class="active"><a href="<?php echo base_url();?>admin/Dashboard"><?php echo display('deashbord');?></a></li>
            </ol>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php 
        echo @$msg = $this->session->flashdata('message'); 
    ?>
    <div class="row">
        <!--  table area -->
        <div class="col-sm-12">
            <div  class="panel panel-default">
                <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Doctor List</h4>
                        </div>
                    </div>
                <div class="panel-body">
				<!--<table width="100%" class="table table table-striped table-bordered table-hover" id="dataTables">-->
                    <table width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><?php echo display('picture');?></th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th>Degrees</th>
                                <th>Specialist</th>
                                <th>Doctor Experiance</th>
                               
                                <th>Sex</th>
                                
                                <th>Phone</th>
                               
                                <th><?php echo display('action');?></th> 
                            </tr>
                        </thead>
                        <tbody>
                           <?php
                                foreach ($doc_list as $value) {
                            ?>
                            <tr class="odd gradeX">
                                
                                <td>
                                    <div class="profile-userpic">
                                            <?php 
                                               if($value['picture']){
                                                    echo '<img width=50" src="'.html_escape($value['picture']).'" class="img-responsive">';
                                               }else{
                                                    echo '<img width=50" src="'.base_url().'assets/images/user.png">';
                                               }
                                            ?>
                                    </div>
                                </td>

                                <td><?php echo html_escape($value['doctor_name']);?></td>
                                <td><?php echo html_escape($value['department_name']);?></td>
                                <td><?php echo html_escape($value['designation']);?></td>
                                <td><?php echo html_escape($value['degrees']);?></td>
                                <td><?php echo html_escape($value['specialist']);?></td>
                                <td><?php echo html_escape($value['doctor_exp']);?></td>
                                <td><?php echo html_escape($value['sex']);?></td>
                                <td><?php echo html_escape($value['doctor_phone']);?></td>
                                
                                <td class="">
								<a  class="btn btn-xs btn-danger" href="<?php echo base_url();?>admin/Doctor_controller/edit_profile/<?php echo html_escape($value['doctor_id']) ;?>">
                                    <i class="fa fa-edit"></i> </a>
									<a  class="btn btn-xs btn-danger" href="<?php echo base_url();?>admin/Doctor_controller/delete_doctor/<?php echo html_escape($value['log_id']) ;?>" onclick="return confirm('Are you want to delete?');">
                                    <i class="fa fa-trash"></i> </a>
                                </td> 
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>       
</div>	
    </section>
</div>

<?php
    $printTitle = "Patient List";
    $this->session->set_flashdata(array('pTitle' => $printTitle));    
?>  



