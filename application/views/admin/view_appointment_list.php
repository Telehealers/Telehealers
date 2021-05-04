
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('appointment_list');?></h1>
            <small><?php echo display('appointment_list');?></small>
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
                    $mag = $this->session->flashdata('message');
                    if($mag !=''){
                        echo "<div class='alert alert-success msg'>".html_escape($mag)."</div><br>";
                    }
                ?>
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('appointment_list');?></h4>
                        </div>
                    </div>
                
                    <div class="panel-body">
                        <div class="table-responsive">
                        <table width="100%" class="table table-striped table-bordered table-hover dt-responsive" id="appointment">
                            <thead>
                                <tr>
                                    <th class="all"><?php echo display('doctor_name'); ?></th>
									<th class="all"><?php echo display('patient_name'); ?></th>
                                    <th class="all"><?php echo display('patient_id'); ?></th>
                                    <th class="all"><?php echo display('phone_number'); ?></th>
                                    <th class="none"><?php echo display('patient_cc'); ?></th>
                                    <th class="none"><?php echo display('appointment_id'); ?></th>
                                    <th class="none"><?php echo display('venue'); ?></th>
                                    <th class="all"><?php echo display('sequence'); ?></th>
                                    <th class="all"><?php echo display('date'); ?></th>
                                    <th class="all"><?php echo display('sms'); ?></th>
                                    <th class="all">Payment Status</th>
                                    <th class="desktop"><?php echo display('action'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                foreach (@$appointmaent_info as $value) {
                                     $result = $this->db->select('appointment_id')
                                     ->from('prescription')
                                     ->where('appointment_id',$value->appointment_id)
                                     ->get()
                                     ->num_rows();

                                      $Payment = $this->db->select('*')
                                     ->from('payment_table')
                                     ->where('appointment_id',$value->appointment_id)
                                     ->get()
                                     ->row();
                               

                                     @$sequence_time = $value->sequence-1; 
                                     $time = ($sequence_time * $value->per_patient_time);
                                     $serial_time =date('h:i A', strtotime($value->start_time)+$time*60);

									$SQL = 'select doctor_name from doctor_tbl where doctor_id != "'.$value->doctor_id.'"';
		
									$query = $this->db->query($SQL);

									$result2 = $query->result_array();
									$doctor_name = '-';
									if(is_array($result2) && count($result2)>0){
										$doctor_name = $result2[0]['doctor_name'];
									}
                                    ?>

                                <tr <?php echo ($result>0)?'style="background-color: rgb(19, 203, 21)"':''?> >

                                    <td><?php echo html_escape($doctor_name);?></td>
									<td><?php echo html_escape($value->patient_name);?></td>
                                    <td><?php echo html_escape($value->patient_id);?></td>
                                    <td><?php echo html_escape($value->patient_phone);?></td>
                                    <td><?php echo html_escape($value->problem);?></td>
                                    <td><?php echo html_escape($value->appointment_id);?></td>
                                    <td><?php echo html_escape($value->venue_name);?></td>
                                    <td><?php echo html_escape(@$value->sequence) ;?></td>
                                    <td><?php echo html_escape($value->date);?></td>
                                    <td>
                                        <?php echo '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="send sms" onclick="sms_send('."'".html_escape($value->appointment_id)."'".')"><i class="fa fa-envelope-o" aria-hidden="true"></i> SMS</a>';?>
                                    </td>

                                    <td>
									<?php 
									$schedul_id = $value->schedul_id;
									$SQL1 = "select * from schedul_setup_tbl where schedul_id = '".$schedul_id."'";
									$query1 = $this->db->query($SQL1);
									$result1 = $query1->result_array();
									if(is_array($result1) && count($result1)>0){
										$fees = $result1[0]['fees'];
									}
			
									?>
                                        <?php if($Payment!=NULL){?>
                                            <a class="btn btn-sm btn-primary"> Paid</a>
                                        <?php } else{ ?>
											<?php if($fees==1){echo 'Free';}else{?>
                                            <a class="btn btn-sm btn-danger" target="_blank" href="<?php echo base_url();?>admin/payment_method/Payment/pay_with_doctor/<?php echo html_escape($value->appointment_id);?>"> Not Paid</a>
											<?php }}?>
                                    </td>

                                    <td class="text-center" width="100">

                                        <?php if(empty($result) AND $this->session->userdata('user_type')==1) { ?>
                                            <a class="btn btn-xs btn-primary" data-toggle="tooltip" title="Create Prescription!"   href="<?php echo base_url();?>admin/Prescription_controller/create_prescription/<?php echo html_escape($value->appointment_id); ?>" ><i class="fa fa-user-md"></i></a>
                                        <?php } else { ?>
                                            <a class="btn btn-xs btn-primary" data-toggle="tooltip" title="View Prescription!"  target="_blank" href="<?php echo base_url();?>admin/Prescription_controller/my_prescription/<?php echo html_escape($value->appointment_id); ?>"><i class="fa fa-eye"></i></a>   
                                        <?php } ?> 
                                        <a class="btn btn-xs btn-success" data-toggle="tooltip" title="View Appointment" target="_blank" href="<?php echo base_url();?>admin/Basic_controller/my_appointment/<?php echo html_escape($value->appointment_id); ?>"><i class="fa fa-print"></i></a>
                                        <a class="btn btn-xs btn-info" data-toggle="tooltip" title="View History" target="_blank" href="<?php echo base_url();?>History_controller/patient_history/<?php echo html_escape($value->patient_id); ?>"><i class="fa fa-history" aria-hidden="true"></i></a>
                                        <a class="btn btn-xs btn-danger" data-toggle="tooltip" title="Delet" href="<?php echo base_url();?>admin/Appointment_controller/delete_appointment/<?php echo html_escape($value->appointment_id); ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                       
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



<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"><?php echo display('sms');?></h3>
            </div>

            <div class="modal-body form">

               <?php 
                    $attributes = array( 'class' => 'form-horizontal','id'=>'form','method'=>'post');
                    echo form_open_multipart('#', $attributes);
                ?>
                    <input type="hidden" value="" name="appointment_id"/> 
                    <input type="hidden" value="" name="doctor_name"/> 
                    <input type="hidden" value="" name="patient_id"/> 
                    <input type="hidden" value="" name="appointment_date"/> 
                    <input type="hidden" value="" name="sequence"/> 
                    <input type="hidden" value="" name="per_patient_time"/> 
                    <input type="hidden" value="" name="start_time"/> 
                    <input type="hidden" value="<?php echo $gateway_list->gateway_id?>" name="sms_gateway_id" >

                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo display('phone_number');?></label>
                            <div class="col-md-9">
                                <input name="to" id="to" placeholder="<?php echo display('phone_number');?>" class="form-control" required="1" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo display('patient_name');?></label>
                            <div class="col-md-9">
                                <input name="name" placeholder="<?php echo display('patient_name');?>" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
            
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo display('sms_gateway');?></label>
                            <div class="col-md-9">
                                <input type="text" disabled name="gateway" value="<?php echo html_escape($gateway_list->provider_name)?>" class="form-control">
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="control-label col-md-3"><?php echo display('sms_template');?></label>
                            <div class="col-md-9">
                                <select class="form-control" name="teamplate_id" id="tmp" onchange="getTeamplate()" required >
                                    <option value="">--Select Teamplate--</option>
                                    <?php 
                                    foreach ($teamplate as $t_list) {
                                       echo '<option value="'.html_escape($t_list->teamplate_id).'">'.html_escape($t_list->teamplate_name).'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group view_tmp">
                          
                        </div>
                        <input type="hidden" id="base_url" value="<?php echo base_url()?>">
                        
                    </div>

                <?php echo form_close()?>

            </div>

            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary"><?php echo display('send');?></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo display('reset');?></button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script src="<?php echo base_url()?>assets/admin_script.js" type="text/javascript"></script>