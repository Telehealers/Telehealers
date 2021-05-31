<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1>Referral Appointmnet</h1>
            <small>Referral Appointmnet</small>
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
                        <h4>Referral Appointmnet</h4>
                    </div>
                </div>
                
                <div class="panel-body">
                        <div class="portlet-body form">
                         <?php 
                            $msg = $this->session->flashdata('message');
                              if($msg !=''){
                                  echo $msg;
                              }
                               if($this->session->flashdata('exception')!=""){
                                 echo $this->session->flashdata('exception');
                            }
                            $attributes = array('class' => 'form-horizontal','method'=>'post','role'=>'form');
                            echo form_open_multipart('admin/Appointment_controller/referral_appointment_save', $attributes);                
                         ?>
						 <?php 
						 //echo "<pre>";print_r($get_appointment);
						 $referral_to = '';
						 $app_status = '';
						 if(is_array($get_appointment) && count($get_appointment)>0){
							 $referral_to = $get_appointment[0]['referral_to'];
							 $app_status = $get_appointment[0]['app_status'];
						 }
						 ?>
						 <input type="hidden" name="p_id" id="p_id" value="<?php echo $p_id;?>" >
                            <div class="form-body">
                                <div class="form-group">
									<label class="col-md-3 control-label">
									<span class="text-danger"> * </span> Doctor </label>     
									<div class="col-md-7">  
									<select class="form-control" onChange="setvenue(this.value)"  name="doctor" id="doctor_id" required="required">	
									<option value="">Select Doctor</option>
									<?php foreach($doctor_info as $doctor){?>
									<?php if($doctor['doctor_id']!=$user_id){?>
									<option value="<?php echo $doctor['doctor_id'];?>" <?php if($referral_to==$doctor['doctor_id']){?> selected="selected" <?php } ?>><?php echo $doctor['doctor_name'];?> - <?php echo $doctor['email'];?></option>	
									<?php }} ?>									
									</select>														
									</div>
								</div>
						
                            </div>
							<?php if($app_status!=""){?>
							<div class="form-body">
                                <div class="form-group">
									<label class="col-md-3 control-label">Status</label>     
									<div class="col-md-7 control-label" style="text-align:left">  
									<?php 
										if($app_status==0){
											echo '<span>Pending</span>';
										}else if($app_status==1){
											echo '<span>Accepted</span>';
										}else{
											echo '<span>Rejected</span>';
										}
									?>												
									</div>
								</div>
						   </div>
							<?php } ?>
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

            
    </div>            
    </section>
</div>

<style>
.dt-buttons.btn-group{display:none !important;}
.dataTables_filter{display:none !important;}
</style>

