
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1>User Action Log List</h1>
            <small>User Action Log List</small>
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
                        echo htmlspecialchars_decode($mag) ;
                    }
                ?>
                
                <div  class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>User Action Log List</h4>
                        </div>
                    </div>
                    
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover tablesaw tablesaw-stack">
                                <thead>
                                    <tr>
                                        <th >#SL</th>
										<td>Type</td>
                                        <th >User</th>
                                        <th >Action</th>
                                        <th >Action description</th>
                                        <th >Action Date</th>
                                        <th ><?php echo display('action');?></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $i = 1;
                                    if(!empty($action_info)){
                                    foreach ($action_info as $value) {
										
										$log_id = $value['user_id'];
										$SQL4 = "select user_type,email from log_info where log_id = '".$log_id."'";
										$query4 = $this->db->query($SQL4);
										$result4 = $query4->result_array();
										$user_type = $result4[0]['user_type'];
										$user_email = $result4[0]['email'];
										if($user_type==1){
											$SQL1 = "select doctor_name from doctor_tbl where log_id = '".$log_id."'";
											$query1 = $this->db->query($SQL1);
											$result1 = $query1->result_array();
											if(is_array($result1) && count($result1)>0){
												$user_name = $result1[0]['doctor_name'];
												$user_type = 'Doctor';
											}
										}
										if($user_type==2){
											$SQL1 = "select full_name from users_tbl where log_id = '".$log_id."'";
											$query1 = $this->db->query($SQL1);
											$result1 = $query1->result_array();
											if(is_array($result1) && count($result1)>0){
												$user_name = $result1[0]['full_name'];
												$user_type = 'Assistant';
											}
										}
										$medicine_name='';
										if($value['action_title']=="Add medecine" || $value['action_title']=="Update medecine"){
											$sql_medi = "select * from medecine_info where medicine_id = '".$value['action_link']."' ";
											$query_medi = $this->db->query($sql_medi);
											$result_medi = $query_medi->result_array();
											if(is_array($result_medi) && count($result_medi)>0){
												$medicine_name = $result_medi[0]['medicine_name'];
											}
											
										}
										if($value['action_title']=="Add medicine company"){
											$sql_medi = "select * from medicine_company_info where company_id = '".$value['action_link']."' ";
											$query_medi = $this->db->query($sql_medi);
											$result_medi = $query_medi->result_array();
											if(is_array($result_medi) && count($result_medi)>0){
												$medicine_name = $result_medi[0]['company_name'];
											}
											
										}
										if($value['action_title']=="Add medecine group"){
											$sql_medi = "select * from medicine_group_tbl where med_group_id = '".$value['action_link']."' ";
											$query_medi = $this->db->query($sql_medi);
											$result_medi = $query_medi->result_array();
											if(is_array($result_medi) && count($result_medi)>0){
												$medicine_name = $result_medi[0]['group_name'];
											}
											
										}
										if($value['action_title']=="Add doctor advice"){
											$sql_medi = "select * from doctor_advice where advice_id = '".$value['action_link']."' ";
											$query_medi = $this->db->query($sql_medi);
											$result_medi = $query_medi->result_array();
											if(is_array($result_medi) && count($result_medi)>0){
												$medicine_name = $result_medi[0]['advice'];
											}
											
										}
										
										if($value['action_description']=="User add medician Prescriptiion"){
											$sql_medi = "select * from medicine_prescription where med_pres_id = '".$value['action_link']."' ";
											$query_medi = $this->db->query($sql_medi);
											$result_medi = $query_medi->result_array();
											if(is_array($result_medi) && count($result_medi)>0){
												$medicine_name = $result_medi[0]['appointment_id'];
											}
											
										}
										if($value['action_title']=="Add Prescriptiion"){
											$sql_medi = "select * from prescription where prescription_id = '".$value['action_link']."' ";
											$query_medi = $this->db->query($sql_medi);
											$result_medi = $query_medi->result_array();
											if(is_array($result_medi) && count($result_medi)>0){
												$medicine_name = $result_medi[0]['appointment_id'];
											}
											
										}
										if($value['action_title']=="Add Advice Prescriptiion"){
											$sql_medi = "select * from advice_prescriptiion where advice_prescription_id = '".$value['action_link']."' ";
											$query_medi = $this->db->query($sql_medi);
											$result_medi = $query_medi->result_array();
											if(is_array($result_medi) && count($result_medi)>0){
												$medicine_name = $result_medi[0]['appointment_id'];
											}
											
										}
										if($value['action_title']=="Update prescription"){
											$sql_medi = "select * from prescription where prescription_id = '".$value['action_link']."' ";
											$query_medi = $this->db->query($sql_medi);
											$result_medi = $query_medi->result_array();
											if(is_array($result_medi) && count($result_medi)>0){
												$medicine_name = $result_medi[0]['appointment_id'];
											}
										}
										if($value['action_description']=="User Add medecine prescription"){
											$sql_medi = "select * from medicine_prescription where med_pres_id = '".$value['action_link']."' ";
											$query_medi = $this->db->query($sql_medi);
											$result_medi = $query_medi->result_array();
											if(is_array($result_medi) && count($result_medi)>0){
												$medicine_name = $result_medi[0]['appointment_id'];
											}
											
										}
										if($value['action_description']=="User Add advice prescriptiion"){
											$sql_medi = "select * from advice_prescriptiion where advice_prescription_id = '".$value['action_link']."' ";
											$query_medi = $this->db->query($sql_medi);
											$result_medi = $query_medi->result_array();
											if(is_array($result_medi) && count($result_medi)>0){
												$medicine_name = $result_medi[0]['appointment_id'];
											}
										}
										if($value['action_title']=="Add Patient during add prescriptions"){
											$sql_medi = "select * from patient_tbl where patient_id = '".$value['action_link']."' ";
											$query_medi = $this->db->query($sql_medi);
											$result_medi = $query_medi->result_array();
											if(is_array($result_medi) && count($result_medi)>0){
												$medicine_name = $result_medi[0]['patient_name'];
											}
										}
										if($value['action_description']=="User add generic prescription"){
											$sql_medi = "select * from generic_tbl where generic_id = '".$value['action_link']."' ";
											$query_medi = $this->db->query($sql_medi);
											$result_medi = $query_medi->result_array();
											if(is_array($result_medi) && count($result_medi)>0){
												$medicine_name = $result_medi[0]['appointment_id'];
											}
										}
										if($value['action_description']=="User add test during add generic prescription"){
											$sql_medi = "select * from test_assign_for_patine where test_ass_id = '".$value['action_link']."' ";
											$query_medi = $this->db->query($sql_medi);
											$result_medi = $query_medi->result_array();
											if(is_array($result_medi) && count($result_medi)>0){
												$medicine_name = $result_medi[0]['appointment_id'];
											}
										}
										if($value['action_description']=="User add advice during add generic prescription"){
											$sql_medi = "select * from advice_prescriptiion where advice_prescription_id = '".$value['action_link']."' ";
											$query_medi = $this->db->query($sql_medi);
											$result_medi = $query_medi->result_array();
											if(is_array($result_medi) && count($result_medi)>0){
												$medicine_name = $result_medi[0]['appointment_id'];
											}
										}
										if($value['action_title']=="Add Schedule"){
											$sql_medi = "select * from schedul_setup_tbl where schedul_id = '".$value['action_link']."' ";
											$query_medi = $this->db->query($sql_medi);
											$result_medi = $query_medi->result_array();
											if(is_array($result_medi) && count($result_medi)>0){
												$doctor_id		  = $result_medi[0]['doctor_id'];
												$sql2 = "select * from doctor_tbl where doctor_id = '".$doctor_id."'";
												$query2 = $this->db->query($sql2);
												$result2 = $query2->result_array();
												if(is_array($result2) && count($result2)>0){
													$doctor_name = $result2[0]['doctor_name'];
												}
												$venue_id		  = $result_medi[0]['venue_id'];
												$sql2 = "select * from venue_tbl where venue_id = '".$venue_id."'";
												$query2 = $this->db->query($sql2);
												$result2 = $query2->result_array();
												if(is_array($result2) && count($result2)>0){
													$venue_name = $result2[0]['venue_name'];
													$venue_contact = $result2[0]['venue_contact'];
													$venue_address = $result2[0]['venue_address'];
												}
												$start_time		  = $result_medi[0]['start_time'];
												$end_time		  = $result_medi[0]['end_time'];
												$day			  = $result_medi[0]['day'];
												if($day==1){
													$day = 'Saturday';
												}
												if($day==2){
													$day = 'Sunday';
												}
												if($day==3){
													$day = 'Monday';
												}
												if($day==4){
													$day = 'Tuesday';
												}
												if($day==5){
													$day = 'Wednesday';
												}
												if($day==6){
													$day = 'Thusday';
												}
												if($day==7){
													$day = 'Friday';
												}
												$per_patient_time = $result_medi[0]['per_patient_time'];
												$visibility		  = $result_medi[0]['visibility'];
												$fees 			  = $result_medi[0]['fees'];
												if($fees==0){
													$fees = 'Free';
												}else{
													$fees = 'Paid';
												}
												$message = "Doctor : $doctor_name <br>";
												$message .= "Venue name : $venue_name <br>";
												$message .= "Venue contact : $venue_contact <br>";
												$message .= "Start time : $start_time <br>";
												$message .= "End time : $end_time <br>";
												$message .= "Day : $day <br>";
												$message .= "Per patient time : $per_patient_time <br>";
												$message .= "Visibility : $visibility <br>";
												$message .= "Fees : $fees <br>";
											}
											$medicine_name = "<br>".$message;
											//$medicine_name = '';
										}
										if($value['action_title']=="Add Emergency stop" || $value['action_title']=="Edit Emergency stop"){
											$sql_medi = "select * from emergency_stop_tbl where stop_id = '".$value['action_link']."' ";
											$query_medi = $this->db->query($sql_medi);
											$result_medi = $query_medi->result_array();
											if(is_array($result_medi) && count($result_medi)>0){
												$stop_date = $result_medi[0]['stop_date'];
												$schedul_date = $result_medi[0]['schedul_date'];
												$message = $result_medi[0]['message'];
												$message2 = "Stop date : $stop_date <br>";
												$message2 .= "Schedul date : $schedul_date <br>";
												$message2 .= "Message : $message <br>";
											}
											$medicine_name = "<br>".$message2;
										}
									?>
                                    <tr>
                                        <td><?php echo $i++;?></td>
										<td><?php echo $user_type;?></td>
										<td><?php echo $user_name; ?>-(<?php echo $user_email; ?>)</td>
                                        <td><?php echo html_escape($value['action_title']);?></td>
                                        <td><?php echo html_escape($value['action_description']);?> <?php if($medicine_name!=""){?>- (<?php echo $medicine_name; ?>)<?php } ?></td>
                                        <td><?php echo html_escape($value['add_date']);?></td>
                                        <td width="100">
                                            <a href="<?php echo base_url();?>admin/Actionlog_controller/delet_actionlog/<?php echo html_escape($value['id']);?>" class="btn btn-xs btn-danger">
                                            <i class="fa fa-trash"></i> </a>
                                        </td>
                                    </tr>
                                    <?php
                                         }
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



