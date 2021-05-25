<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('edit_prescription');?></h1>
            <small>Edit Prescription</small>
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
                $attributes = array( 'class' => 'form-horizontal','name'=>'n_p');
                echo form_open_multipart('admin/Prescription_controller/update_prescription', $attributes);
             ?>
                    <div class="col-md-12">
                       <div class="panel panel-bd">

                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4><?php echo display('edit_prescription');?></h4>
                            </div>
                        </div>
                            
                    <div class="panel-body">

                    <div class="portlet-body form">
                        <!--  -->
                        <!-- patinet info -->
                        <!--  -->
                                <div class="portlet-title">
                                    <div class="row">
                                        <div class="col-md-12 col-xs-12">
                                            <div class="caption">
                                                <span class="caption-subject font-green sbold uppercase"><?php echo display('name');?> : </span><?php echo html_escape(@$pres->patient_name);?>,&nbsp&nbsp&nbsp
                                                <span class="caption-subject font-green sbold uppercase"><?php echo display('age');?> : </span>
                                                <?php
                                                    $date1=date_create(@$pres->birth_date);
                                                    $date2= date_create( date('y-m-d'));
                                                    $diff=date_diff($date1,$date2);
                                                    echo @$diff->format("%Y-Y:%m-M:%d-D");
                                                ?>,&nbsp&nbsp&nbsp 
                                                <span class="caption-subject font-green sbold uppercase"><?php echo display('sex');?> : </span><?php echo html_escape(@$pres->sex);?>,&nbsp&nbsp&nbsp
                                                <span class="caption-subject font-green sbold uppercase">Id : </span><?php echo html_escape(@$pres->patient_id);?>
                                            </div>
                                        </div>


                                    </div> <hr/>

                                    <input type="hidden" name="prescription_id" value="<?php echo html_escape($pres->prescription_id);?>">
                                    <input type="hidden" name="appointment_id" value="<?php echo html_escape($pres->appointment_id);?>">
                                    <input type="hidden" name="patient_id" value="<?php echo html_escape($pres->patient_id);?>">
                                    <input type="hidden" name="doctor_id" value="<?php echo html_escape($pres->doctor_id);?>">

                                            
                                    <div class="portlet-title">
                                         <div class="form-group ">
                                            <div class="col-md-6"><input type="text" class="form-control" value="<?php echo html_escape(@$pres->problem);?>"  placeholder="<?php echo display('patient_cc')?>" name="Problem" /></div>
                                            <div class="col-md-2"><input type="text" class="form-control" value="<?php echo html_escape(@$pres->weight);?>"  placeholder="<?php echo display('patient_weight')?>" name="Weight" value=""/></div> 
                                            <div class="col-md-2"><input type="text" class="form-control" value="<?php echo html_escape(@$pres->pressure);?>" placeholder="<?php echo display('patient_bp')?>" name="Pressure"  value=""/></div>
                                            <div class="col-md-2"><input type="text" class="form-control" value="<?php echo html_escape(@$pres->temperature);?>" placeholder="<?php echo display('temperature')?>" name="temperature"  value=""/></div>
                                        </div>
                                    </div><hr/>

                                    <div class="portlet-title">
                                         <div class="form-group ">
                                            <div class="col-md-4"><input type="text" class="form-control" value="<?php echo html_escape(@$pres->history);?>" placeholder="<?php echo display('history')?>" name="history" /></div>
                                            <div class="col-md-4"><input type="text" class="form-control" value="<?php echo html_escape(@$pres->oex);?>" placeholder="<?php echo display('oex')?>" name="oex" /></div>
                                            <div class="col-md-4"><input type="text" class="form-control" value="<?php echo html_escape(@$pres->pd);?>" placeholder="<?php echo display('pd')?>" name="pd" value=""/></div> 
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
                        
                                                                    <?php foreach($m_info as $medicine){?>
                                                                        <div class="form-group ">
                                                                             <div class="col-md-1 col-xs-12">
                                                                                <input type="text"  class="form-control" name="type[]" value="<?php echo html_escape($medicine->medicine_type)?>" placeholder="<?php echo display('type')?>" />
                                                                               
                                                                            </div>
                                                                             <div class="col-md-3">
                                                                                <input type="hidden" class="mdcn_value" name="medicine_id[]" value="<?php echo html_escape($medicine->medicine_id)?>" />
                                                                                <input type="text"  class="mdcn_name form-control" name="md_name[]"  value="<?php echo html_escape($medicine->medicine_name)?>" autocomplete="off" placeholder="<?php echo display('medicine_name')?>" />
                                                                                <div id="suggesstion-box"></div>
                                                                             </div>

                                                                             <div class="col-md-2" ><input type="text"  class="form-control"  placeholder="<?php echo display('mgml')?>" value="<?php echo html_escape($medicine->mg)?>" name="mg[]" /></div> 
                                                                             <div class="col-md-1" ><input type="text"  class="form-control"  placeholder="<?php echo display('dose')?>" name="dose[]" value="<?php echo html_escape($medicine->dose)?>" /></div>
                                                                             <div class="col-md-1"><input type="text"  class="form-control"  placeholder="<?php echo display('day')?>" name="day[]" value="<?php echo html_escape($medicine->day)?>" /></div>
                                                                             <div class="col-md-3"><input type="text"  class="form-control"  placeholder="<?php echo display('medicine_comment')?>" name="comments[]" value="<?php echo html_escape($medicine->medicine_com)?>" /></div> 
                                                                            <a href="javascript:void(0);" class=" btn btn-danger remove_button" title="Remove field"><span class="glyphicon glyphicon-trash"></span></a>
                                                                        </div> 
                                                                     <?php }?>    
                                                     
                                                                </div>    
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="6">
                                                                <div class="form-group col-md-12">
                                                                    <textarea placeholder="<?php echo display('overal_comment')?>" name="prescription_comment" class="form-control" rows="2"> <?php echo html_escape(@$pres->pres_comments);?></textarea>
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
                                                                    <?php foreach($t_info as $test){?>
                                                                        <div id="count_test1">
                                                                        <div class="form-group ">
                                                                            <div class="col-md-5">
                                                                                <input type="hidden" class="test_value" name="test_name[]" value="<?php echo html_escape($test->test_id)?>" />
                                                                                <input placeholder="<?php echo display('test_name')?>"  value="<?php echo html_escape($test->test_name)?>" class="test_name form-control" name="te_name[]" autocomplete="off" >
                                                                                <div id="test-box"></div>
                                                                            </div>
                                                                            <div class="col-md-5"> 
                                                                                <input placeholder="<?php echo display('description')?>" value="<?php echo html_escape($test->test_assign_description)?>" name="test_description[]" class="form-control" ><samp> <?php echo display('discription')?></samp>
                                                                            </div>
                                                                                <a href="javascript:void(0);" class=" btn btn-danger remove_button" title="Remove field"><span class="glyphicon glyphicon-trash"></span></a>
                                                                        </div>
                                                                    </div>
                                                                    <?php }?>
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
                                                                <a href="javascript:void(0);"  class="btn btn-primary add_advice pull-right" title="Add field"><span class="glyphicon glyphicon-plus"></span><?php echo display('add')?>  </a>
                                                             </td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="field_wrapper2">
                                                                <?php foreach($a_info as $advice){?>
                                                                    <div id="count_advice1">
                                                                        <div class="form-group ">
                                                                            <div class="col-md-10">
                                                                                <input type="hidden" class="advice_value" value="<?php echo html_escape($advice->advice_id)?>" name="advice[]" value=""/>
                                                                                <input placeholder="<?php echo display('advice')?>" value="<?php echo html_escape($advice->advice)?>" class="advice_name form-control" name="adv[]" autocomplete="off" >
                                                                                <div  id="advice-box"></div>
                                                                            </div><a href="javascript:void(0);" class=" btn btn-danger remove_button" title="Remove field"><span class="glyphicon glyphicon-trash"></span></a>
                                                                        </div>
                                                                    </div>
                                                                <?php }?>   
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-offset-10 col-sm-6">
                                                <button type="submit" class="btn btn-success"><?php echo display('update')?></button>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                 </form>
            </div>
        </div>
        
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->


<?php $this->load->view('admin/script/edit_prescription.php');?>

