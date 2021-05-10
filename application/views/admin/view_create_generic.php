<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('create_generic')?></h1>
            <small><?php echo display('create_generic')?></small>
            <ol class="breadcrumb">
                <li><a target="_blank" href="<?php echo base_url();?>"><i class="pe-7s-home"></i> <?php echo display('site_view')?></a></li>
                <li class="active"><a href="<?php echo base_url();?>admin/Dashboard"><?php echo display('deashbord');?></a></li>
            </ol>
        </div>
    </section>


    <!-- Main content -->
    <section class="content">
                 <div class="row">

             <?php 
                $attributes = array( 'class' => 'form-horizontal','method'=>'post','name'=>'n_p');
                echo form_open_multipart('admin/Generic_controller/save_generic', $attributes);
             ?>
                    <div class="col-md-12">
                        <div  class="panel panel-default panel-form">
                            <div class="panel-body">
                                <div class="portlet-body form">
                        <!--  -->
                        <!-- patinet info -->
                        <!--  -->
                                <div class="portlet-title">
                                   <div class="row">
                                        <div class="col-xs-12">
                                            <div class="portlet-title">
											
											<div class="form-group">	

											<label class="col-md-3 control-label">Doctor :</label>	

											<div class="col-md-5">					

											<select name="doctor" id="doctor_id" class="form-control">	

											<?php foreach($doctor_info as $doctor){?>	

											<option value="<?php echo $doctor['doctor_id'];?>"><?php echo $doctor['doctor_name'];?> - <?php echo $doctor['email'];?></option>	

											<?php } ?>		

											</select>		

											</div>		

											<div class="col-md-4">
											
												<input type="text" name="create_date" class="form-control datepicker1" placeholder="Create Date" "create_date">
											
											</div>											

											</div>
											
											
                                                 <div class="form-group ">
                                                 

                                                    <div class="col-md-12">
                                                        <select class="form-control" name="venue_id" required>
                                                            <option value="">--<?php echo display('select_venue');?>--</option>
                                                            <?php foreach($venue as $v_enue){
                                                            echo '<option value="'. $v_enue->venue_id.'">'.$v_enue->venue_name.'</option>';
                                                             } ?>
                                                        </select>  
                                                        
                                                    </div><br><hr/>
                                                    
                                                    <div class="col-md-12 ">
                                                        <div id="ab"></div>
                                                    </div>
                                                    <div class="col-md-2 pid" >
                                                        <!--<input type="text" name="p_id" id="p_id" onkeyup="loadNameOne(this.value);" class="form-control" placeholder="<?php echo display('patient_id')?>">--> 
														<select class="form-control"  name="p_id" id="p_id" onChange="loadNameOne(this.value);" required>
															<option value="">Select Patient</option>
															<?php if(is_array($patient_info) && count($patient_info)>0){?>
															<?php foreach($patient_info as $val){?>
															<option value="<?php echo $val->patient_id?>"><?php echo $val->patient_id?> (<?php echo $val->patient_name?>)</option>
															<?php }} ?>
														</select>
                                                    </div>

                                                    <div class="had">
                                                        <div class="col-md-2">
                                                            <input type="text" class="form-control"  placeholder="<?php echo display('patient_name')?>" name="name" required>
                                                        </div>
                                                        <input type="hidden" name="patient_id" required>
                                                       
                                                        <div class="col-md-2">
                                                            <input type="text" class="form-control"  placeholder="<?php echo display('phone_number')?>" name="phone" required>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <input type="text" name="birth_date"  class="form-control datepicker1 birth_date"  placeholder="<?php echo display('birth_date')?>" required>
                                                        </div>

                                                        <div class="col-md-1">
                                                            <input type="text" name="age" id="age" class="form-control" placeholder="<?php echo display('age')?>">
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="md-radio">
                                                                <input type="radio" id="lb1"  name="gender"  value="Male">
                                                                <label for="lb1"> <?php echo display('male')?></label>
                                                            
                                                                <input type="radio" id="lb2"  name="gender" value="Female">
                                                                 
                                                                <label for="lb2"> <?php echo display('female')?></label>
                                                            
                                                                <input type="radio" id="lb3" name="gender" value="Others">
                                                                 
                                                                <b><?php echo display('others')?></b>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div> <hr/>

                                    <div class="portlet-title">
                                         <div class="form-group ">
                                            <div class="col-md-6"><input type="text" class="form-control"  placeholder="<?php echo display('patient_cc')?>" name="Problem" /><samp></div>
                                            <div class="col-md-2"><input type="text" class="form-control"  placeholder="<?php echo display('patient_weight')?>" name="Weight" value=""/></div> 
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

            <!-- END PATIENT AREA -->

                            <div class="portlet-title">
                                <div class="row">
                                    <!--  -->
                                       <!-- Madicine area -->
                                    <!-- -->
                                            <div class="col-sm-12 col-xs-12">
                                                <table class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr> 
                                                            <td colspan="6" class="m_add_btn"><?php echo display('medicine')?> <a href="javascript:void(0);"  class="btn btn-primary add_button pull-right" title="Add field"> <span class="glyphicon glyphicon-plus"></span><?php echo display('add')?></a></td>
                                                        </tr>

                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="field_wrapper">
                                                                    <div class="form-group ">
                                                                         <div class="col-md-1 col-xs-12">
                                                                            <input type="text"  class="form-control" name="type[]"  placeholder="<?php echo display('type')?>" />
                                                                            
                                                                        </div>
                                                                         <div class="col-md-3">
                                                                            <input type="hidden" class="mdcn_value" name="group_id[]" value="" id="search-group_id" />
                                                                            <input type="text"  class="group_name form-control"  name="group_name[]" id="search-group" autocomplete="off" placeholder="Generic Name" />
                                                                            <div id="suggesstion-box"></div>
                                                                            
                                                                         </div>

                                                                         <div class="col-md-2" ><input type="text"  class="form-control"  placeholder="<?php echo display('mgml')?>" name="mg[]" /></div> 
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
                                <!-- start Test area  -->
                                <!-- -->
                                            <div class="col-sm-6 col-xs-12">
                                                <table class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr> 
                                                             <td colspan="6" class="t_add_btn"><?php echo display('test')?> 
                                                                <a href="javascript:void(0);"  class="btn btn-primary add_button1 pull-right" title="Add field"><span class="glyphicon glyphicon-plus"></span><?php echo display('add')?></a>
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
                                                                                <input placeholder="<?php echo display('description')?>" name="test_description[]" class="form-control" >
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

                                    <!--  -->
                                    <!-- Advice area  -->
                                    <!--  -->
                                            
                                            <div class="col-sm-6 col-xs-12">
                                                <table class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr> 
                                                             <td colspan="6" class="a_btn"><?php echo display('advice')?> 
                                                                <a href="javascript:void(0);"  class="btn btn-primary add_advice pull-right" title="Add field"><span class="glyphicon glyphicon-plus"></span><?php echo display('add')?></a>
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
                                                                                <input type="hidden" class="advice_value" name="advice[]" value=""/>
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
                                                    <button type="submit" class="btn btn-success"><?php //echo display('submit')?>Send to Patient</button>
                                            
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                 </form>
        </div>
    </section>

</div>    



<?php $this->load->view('admin/script/create_generic.php')?>