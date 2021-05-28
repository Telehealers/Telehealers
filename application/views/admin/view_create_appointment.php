
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('create_appointment')?></h1>
            <small><?php echo display('create_appointment')?></small>
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

                <div class="panel-heading">
                    <div class="panel-title">
                        <h4><?php echo display('create_appointment');?></h4>
                    </div>
                </div>
                        
                <div class="panel-body">
                    <div class="portlet-body form">

                    <?php 
                        $msg = $this->session->flashdata('message');
                            if($msg !=''){
                                  echo htmlspecialchars_decode($msg);
                            }
                        $mag = $this->session->flashdata('exception');
                        if($mag !=''){
                            echo '<div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                 <strong>'.html_escape($mag).'</strong>
                            </div>';
                        }
                        $attributes = array('class' => 'form-horizontal','target'=>'_self','name'=>'p_info');
                        echo form_open_multipart('Appointment/patientAppointment', $attributes);                
                    ?>
                        <div class="form-body">	

						<div class="form-group">

						<label class="col-md-3 control-label">

						<span class="text-danger"> * </span> Doctor </label>     

						<div class="col-md-7">  

						<select class="form-control" onChange="setvenue(this.value)"  name="doctor" id="doctor_id">	

						<?php foreach($doctor_info as $doctor){?>

						<option value="<?php echo $doctor['doctor_id'];?>"><?php echo $doctor['doctor_name'];?> - <?php echo $doctor['email'];?></option>	

						<?php } ?>									

						</select>									
						
						</div>

						</div>
						                      <div class="form-group">
 
                                <label class="col-md-3 control-label"><span class="text-danger">*</span><?php echo display('patient')?> :</label>
                                <div class="col-md-5">
                                        <select class="form-control"  name="patient_id" id="patient_id"  required>
                                            <option value="">Select Patient</option>
                                            <?php foreach($patient_info as $val){?>
                                            <option value="<?php echo $val->patient_id?>"><?php echo $val->patient_id?> (<?php echo $val->patient_name?>)</option>
                                            <?php }?>
                                        </select>
                                    </div></div></div>
                            <input type="hidden" name="doctor_id" value="<?php echo $this->session->userdata('doctor_id')?>">
                            <div class="form-group">
                                <label class="col-md-3 control-label"><span class="text-danger">*</span><?php echo display('date')?> :</label>
                                <div class="col-md-5">
                                    <input type="text" id="p_date" value="<?php echo set_value('date'); ?>" name="p_date"  onchange="loadSchedul()"class="form-control datepicker3" autocomplete="off"  placeholder="<?php echo display('date_placeholder')?>"  required="" >
                                    <span class="text-danger"><?php echo form_error('date'); ?> </span>
                                </div>
                            </div>

                            <!-- <div class="form-group">
                                <label class="col-md-3 control-label"><span class="text-danger">*</span> <?php echo display('patient_id')?> :</label>
                                <div class="col-md-5">
                                    <input type="text" name="p_id" id="patient_id" onkeyup="loadName(this.value);" class="form-control" autocomplete="off" placeholder="<?php echo display('patient_id')?>" value="<?php echo isset($a[0]['p_id']) ? $a[0]['p_id'] : set_value('p_id'); ?>" required> 
                                    <span class="text-danger"><?php echo form_error('p_id'); ?> </span>
                                    <span class='p_name' class="text-danger"></span>
                                </div>
                            </div> -->




                           <!--  <div class="form-group">
                                <label class="col-md-3 control-label "><span class="text-danger">*</span><?php echo display('venue')?> :</label>
 -->                                <!-- <div class="col-md-5">
                                    <select class="form-control v_name" id="venue" onchange="loadSchedul(this.value);" name="venue" value="<?php echo set_value('venue')?>" required>
                                        <option value="">--<?php echo display('select_venue');?>--</option>
                                        <?php foreach ($venue_info as $value) {
                                            echo '<option value="'.html_escape($value->venue_id).'">'.html_escape($value->venue_name).'</option>';
                                        }?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('venue'); ?> </span>
                                </div>
                            </div> -->

                            <div class="form-group">
                                <div class="col-md-3"></div>
                                <div class="col-md-5 schedul"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo display('patient_cc')?>:</label>
                                <div class="col-md-5">
                                    <textarea name="problem" class="form-control" rows="3"></textarea>
                                    <span class="text-danger"><?php echo form_error('problem'); ?> </span>
                                </div>
                            </div>
							
							

                            <div class="form-group row">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="reset" class="btn btn-danger"><?php echo display('reset')?></button>
                                    <button type="submit"  class="btn btn-success"><?php echo display('appointment')?></button>
                                </div>
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
<script>

</script>