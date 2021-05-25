<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('create_trade')?></h1>
            <small><?php echo display('create_trade')?></small>
            <ol class="breadcrumb">
                <li><a target="_blank" href="<?php echo base_url();?>"><i class="pe-7s-home"></i> <?php echo display('site_view')?></a></li>
                <li class="active"><a href="<?php echo base_url();?>admin/Dashboard"><?php echo display('deashbord');?></a></li>
            </ol>
        </div>
    </section>

    


    <!-- Main content -->
    <section class="content">
        
            <?php 
                if(!empty($patient_info)){
            ?>
               
            <div class="row">
                    <?php 
                        $attributes = array('class' =>'form-horizontal','role'=>'form');
                        echo form_open('admin/Prescription_controller/save_prescription', $attributes);
                    ?>
                    <div class="col-md-12">


                        <div  class="panel panel-default panel-form">

                            <div class="panel-heading">
                                <div class="panel-title">
                                    <h4><?php echo display('create_trade');?></h4>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="portlet-body form">
                                <!--  -->
                                    <!-- patinet info -->
                                <!--  -->
                                <?php  if(is_array($doctor_info)){
                                            ?>

                                            <div class="col-xs-12">
                                            <div class="portlet-title">
                                            
                                            <div class="form-group">    

                                            <label class="col-md-3 control-label">Doctor :</label>  

                                            <div class="col-md-5">                  

                                            <select name="doctor" id="doctor_id" class="form-control">  

                                            
                                            <?php foreach($doctor_info as $doctor){?>   

                                            <option value=<?php echo $doctor['doctor_id'];?>><?php echo $doctor['doctor_name'];?> - <?php echo $doctor['email'];?></option>   

                                            <?php } }?>      

                                            </select>       

                                            </div>      

                                <div class="portlet-title">
                                    <?php if(is_array($patient_info) && count($patient_info)>0){?>
                                    <div class="row">
                                         <div class="col-xs-12 pid" > 
                                        <select class="form-control"  name="p_id" id="p_id" onChange="loadName(this.value)" required>
                                            <option value="">Select Patient</option>
                                            <?php foreach($patient_info as $val){?>
                                            <option value="<?php echo $val->patient_id?>"><?php echo $val->patient_id?> (<?php echo $val->patient_name?>)</option>
                                            <?php }}?>
                                        </select>
                                    </div>

                                         <div class="col-xs-12">
                                            <div class="caption">
                                                <span class=""><b><?php echo display('patient_name')?> : </b></span>
                                                <span id="ptname"><?php 
                                                if(!is_array($patient_info)){
                                                    echo html_escape(@$patient_info->patient_name)   ;}?>,&nbsp&nbsp&nbsp
                                                </span>
                                                <span class=""><b><?php echo display('age')?> : </b></span>
                                                <span id="ptage"> <?php 
                                                if(!is_array($patient_info)){
                                                    echo html_escape(@$patient_info->age)   ;}?>,&nbsp&nbsp&nbsp </span>
                                                <span class=""><b><?php echo display('sex')?> : </b></span>
                                                <span id="ptsex"> <?php 
                                                if(!is_array($patient_info)){
                                                    echo html_escape(@$patient_info->sex)   ;}?>,&nbsp&nbsp&nbsp</span>

                                                <span class=""><b><?php echo display('patient_id')?> : </b></span>
                                                <span id="ptid"><?php 
                                                if(!is_array($patient_info)){
                                                    echo html_escape(@$patient_info->patient_id)   ;}?>&nbsp&nbsp&nbsp </span>
                                           
                                        </div>
                                    </div> <hr/>
									<div class="row">
                                         <div class="col-xs-4">
										 <input type="text" name="create_date" class="form-control datepicker1" placeholder="Create Date">
										 </div>
									</div>
                                     <input type="hidden" name="patient_id" value="<?php
                                     if(!is_array(@$patient_info)) echo html_escape(@$patient_info->patient_id);?>"> 
                                     <input type="hidden" name="appointment_id" value="<?php echo html_escape(@$patient_info->appointment_id);?>"> 
                                     <input type="hidden" name="venue_id" value="<?php echo html_escape(@$patient_info->venue_id);?>"> 
									
									<br>
                                    <div class="portlet-title">
                                         <div class="form-group ">
                                            <div class="col-md-6"><input type="text" class="form-control"  placeholder="<?php echo display('patient_cc')?>" name="Problem"  value=" <?php echo html_escape(@$patient_info->problem);?>"/></div>
                                            <div class="col-md-2"><input type="text" class="form-control "  placeholder="<?php echo display('patient_weight')?>" name="Weight" value=""/></div> 
                                            <div class="col-md-2"><input type="text" class="form-control"  placeholder="<?php echo display('patient_bp')?>" name="Pressure"  value=""/></div>
                                            <div class="col-md-2"><input type="text" class="form-control"  placeholder="<?php echo display('temperature')?>" name="temperature"  value=""/></div>
                                        </div>
                                    </div><hr/>
                                    <div class="portlet-title">
                                         <div class="form-group ">
                                            <div class="col-md-4"><input type="text" class="form-control"  placeholder="<?php echo display('history')?>" name="history" /></div>
                                            <div class="col-md-4"><input type="text" class="form-control"  placeholder="<?php echo display('oex')?>" name="oex" /></div>
                                            <div class="col-md-4"><input type="text" class="form-control"  placeholder="<?php echo display('pd')?>" name="pd" value=""/></div> 
                                        </div>
                                    </div>
                                </div>

                                <div class="portlet-title">
                                    <div class="row">
                                        <!-- -->
                                            <!-- Madicine area -->
                                        <!--  -->
                                    <div class="col-sm-12 col-xs-12">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr> 
                                                    <td colspan="6" class="m_add_btn"><?php echo display('medicine')?> <a href="javascript:void(0);"  class="btn btn-primary add_button pull-right" title="Add field"><span class="glyphicon glyphicon-plus"></span><?php echo display('add')?></a></td>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="field_wrapper">
                                                            <div class="form-group ">
                                                                <div class="col-md-1">
                                                                     <input type="text"  class="form-control" name="type[]"  placeholder="Type" />
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="hidden" id="medicine_value" class="mdcn_value" name="medicine_id[]" value="" />
                                                                    <input type="text"  id="medicine_name" class="mdcn_name form-control" name="md_name[]" autocomplete="off" placeholder="<?php echo display('medicine_name')?>" />
                                                                    
                                                                </div>

                                                                 <div class="col-md-2" ><input type="text"  class="form-control"  placeholder="<?php echo display('mgml')?>L" name="mg[]"  /></div> 
                                                                 <div class="col-md-1" ><input type="text"  class="form-control"  placeholder="<?php echo display('dose')?>" name="dose[]"  /></div>
                                                                 <div class="col-md-1"><input type="text"  class="form-control"  placeholder="<?php echo display('day')?>" name="day[]"  /></div>
                                                                 <div class="col-md-3"><input type="text"  class="form-control"  placeholder="<?php echo display('medicine_comment')?>" name="comments[]"  /></div> 
                                                                <a href="javascript:void(0);" class=" btn btn-danger remove_button" title="Remove field"><span class="glyphicon glyphicon-trash"></span></a>
                                                            </div> 
                                             
                                                        </div>    
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6">
                                                        <div class="form-group col-md-12">
                                                             <textarea placeholder="<?php echo display('overal_comment')?>" name="prescription_comment" class="form-control" rows="2"></textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- -->
                                        <!-- Test area  -->
                                    <!-- -->
                                    <div class="col-sm-6 col-xs-12">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr> 
                                                     <td colspan="6" class="t_add_btn"><?php echo display('test')?> 
                                                        <a href="javascript:void(0);"  class="btn btn-primary add_button1 pull-right" title="Add field"><span class="glyphicon glyphicon-plus"></span><?php echo display('add')?> </a>
                                                     </td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    <tr>
                                                        <td> 
                                                            <div class="field_wrapper1">
                                                                <div id="count_test1">
                                                                <div class="form-group ">
                                                                    <div class="col-md-5">
                                                                        <input type="hidden" class="test_value" name="test_name[]" value="" />
                                                                        <input placeholder="<?php echo display('test_name')?>"   class="test_name form-control" name="te_name[]" autocomplete="off" >
                                                                        <div id="test-box"></div>
                                                                    </div>
                                                                    <div class="col-md-5"> 
                                                                        <input placeholder="<?php echo display('description')?>" name="test_description[]" class="form-control"> 
                                                                    </div>
                                                                        <a href="javascript:void(0);" class=" btn btn-danger remove_button" title="Remove field"><span class="glyphicon glyphicon-trash"></span></a>
                                                                </div>
                                                            </div>
                                                            </div>

                                                        </td>
                                                    </tr>
                                            </tbody>
                                        </table>
                                    </div>
<!-- ================================================ -->
                                <!-- Advice area  -->
<!-- ================================================ -->
                                            
                                        <div class="col-sm-6 col-xs-12">
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr> 
                                                         <td colspan="6" class="a_btn"><?php echo display('advice')?>
                                                            <a href="javascript:void(0);"  class="btn btn-primary add_advice pull-right" title="Add field"> <span class="glyphicon glyphicon-plus"></span><?php echo display('add')?></a>
                                                         </td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                        <tr>
                                                            <td>
                                                                 <div class="field_wrapper2">
                                                                    <div id="count_advice1">
                                                                        <div class="form-group ">
                                                                            <div class="col-md-10">
                                                                                <input type="hidden" class="advice_value" name="advice_name[]" value=""/>
                                                                                <input placeholder="<?php echo display('advice')?>" class="advice_name form-control" name="adv[]" autocomplete="off" >
                                                                                <div  id="advice-box"></div>
                                                                            </div><a href="javascript:void(0);" class=" btn btn-danger remove_button" title="Remove field"><span class="glyphicon glyphicon-trash"></span></a>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                
                                                            </td>
                                                        </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    
                                    <div class="form-group row">
                                        <div class="col-sm-offset-9 col-sm-6">
                                            <button type="reset" class="btn btn-danger"><?php echo display('reset')?></button>
                                            <button type="submit" class="btn btn-success"><?php //echo display('submit')?> Save</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php echo form_close()?>
        </div>
    <?php } else { 
            echo "<div class='alert alert-danger msg'> <strong>Sorry!</strong> The Appointment id Wrong.</div><br>";
        }
    ?>

    </section>

</div>


<?php $this->load->view('admin/script/create_prescription.php');?>