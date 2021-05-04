
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('patient_list');?></h1>
            <small><?php echo display('patient_list');?></small>
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
                        <h4><?php echo display('patient_list');?></h4>
                    </div>
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="patient_list">
                        <thead>
                            <tr>
                                <th><?php echo display('picture');?></th>
                                <th><?php echo display('patient_id');?></th>
                                <th><?php echo display('patient_name');?></th>
                                <th><?php echo display('phone_number');?></th>
                                <th><?php echo display('email');?></th>
								<th>Referral To</th>
                                <th><?php echo display('action');?></th> 
                            </tr>
                        </thead>
                        <tbody>
                           <?php
                                foreach ($patient_info as $value) {
							$ref_doc_id	= $value->ref_doc_id;	
							if($ref_doc_id==0){
								$doctor_name = '-';
							}else{
								$doctor_id = $ref_doc_id;
								$SQL = "select doctor_name from doctor_tbl where doctor_id = '$doctor_id'";
								$query = $this->db->query($SQL);
								$result = $query->result_array();
								if(is_array($result) && count($result)>0){
								$doctor_name = $result[0]['doctor_name'];
								}
							}
                            ?>
                            <tr class="odd gradeX">
                                <td>
                                    <div class="profile-userpic">
                                            <?php 
                                               if($value->picture){
                                                echo '<img width="50" src="'.html_escape($value->picture).'" class="img-responsive">';
                                               }else{
                                                echo '<img width="50" src="'.base_url().'assets/images/patient.png" class="img-responsive" >';
                                               }
                                            ?>
                                    </div>
                                </td>
                                <td><?php echo html_escape($value->patient_id); ?></td>
                                <td><?php echo html_escape($value->patient_name);?></td>
                                <td><?php echo html_escape($value->patient_phone);?></td>
                                <td><?php echo html_escape($value->patient_email);?></td>
                                <td><?php echo $doctor_name;?></td>
								
                                <td class="">
                                    <a target="_blank" title="Upload Document" class="btn btn-xs btn-info" href="<?php echo base_url();?>admin/Patient_controller/upload_patient_doc/<?php echo html_escape($value->patient_id);?>">                                    <i class="fa fa-edit"></i> </a>																		<a title="Update" class="btn btn-xs btn-info" href="<?php echo base_url();?>admin/Patient_controller/patient_edit/<?php echo html_escape($value->patient_id);?>">
                                    <i class="fa fa-edit"></i> </a>
                                    <a title="Delete" class="btn btn-xs btn-danger" href="<?php echo base_url();?>admin/Patient_controller/delete_patient/<?php echo html_escape($value->patient_id) ;?>" onclick="return confirm('Are you want to delete?');">
                                    <i class="fa fa-trash"></i> </a>
									<a target="_blank" title="Referral to Doctor" class="btn btn-xs btn-info" href="<?php echo base_url();?>admin/Patient_controller/referral_patient/<?php echo html_escape($value->patient_id);?>">                                    <i class="fa fa-edit"></i> </a>
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



