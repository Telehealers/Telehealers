<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1>Referral Patient</h1>
            <small>Referral Patient</small>
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
                        <h4>Referral Patient</h4>
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
                            echo form_open_multipart('admin/Patient_controller/referral_patient_save', $attributes);                
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
									<option value="<?php echo $doctor['doctor_id'];?>" <?php if($patient_info->ref_doc_id==$doctor['doctor_id']){?> selected="selected" <?php } ?>><?php echo $doctor['doctor_name'];?> - <?php echo $doctor['email'];?></option>	
									<?php }} ?>									
									</select>														
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

            
    </div>            
    </section>
</div>

<style>
.dt-buttons.btn-group{display:none !important;}
.dataTables_filter{display:none !important;}
</style>

