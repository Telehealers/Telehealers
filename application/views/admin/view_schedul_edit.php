
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('edit_schedule');?></h1>
            <small><?php echo display('edit_schedule');?></small>
            <ol class="breadcrumb">
                <li><a target="_blank" href="<?php echo base_url();?>"><i class="pe-7s-home"></i> <?php echo display('site_view')?></a></li>
                <li class="active"><a href="<?php echo base_url();?>admin/Dashboard"><?php echo display('deashbord');?></a></li>
            </ol>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <!--  form area-->
        <div class="col-sm-12">
            <div  class="panel panel-default panel-form">

                <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('edit_schedule')?></h4>
                        </div>
                    </div>
                    
                <div class="panel-body">
                    <div class="portlet-body form">

                         <?php if(validation_errors()){?>
                            <div class='alert alert-danger msg'><?php echo validation_errors();?></div>
                        <?php }?>
                        <?php 
                          $mag = $this->session->userdata('message');
                           if($mag){
                               echo "<div class='alert alert-success msg'>".$mag."</div><br>";
                               $this->session->unset_userdata('message');
                           }
                       
                            $attributes = array('class' => 'form-horizontal','name'=>'s_info','role'=>'form');
                            echo form_open('admin/Schedule_controller/edit_schedul_stup', $attributes);                
                        ?>

                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo display('venue');?> </label>
                            <div class="col-md-5">
                                <select class="form-control" name="venue" id="v_id">
                                    <option value=''>--<?php echo display('select_venue');?>--</option>
                                    <?php foreach ($venue_info as $key => $value) {
                                      echo ' <option value="'.html_escape($value->venue_id).'" '.(html_escape($schedul_info->venue_id)==html_escape($value->venue_id)?'selected':'').'>'.html_escape($value->venue_name).'</option>';
                                    }?>
                                </select>
                                <?php echo form_error('venue', '<div class=" text-danger">', '</div>'); ?>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-3 control-label"> <?php echo display('set_time');?> </label>
                            <div class="col-md-5">
                                <div class="input-group  input-daterange">

                                    <div class="input-group ">
                                        <input type="text" class="form-control" id="basic_example_1"  value="<?php echo html_escape($schedul_info->start_time);?>" autocomplete="off" name="s_time">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                    
                                    <span class="input-group-addon"> to </span>

                                    <div class="input-group ">
                                        <input type="text" class="form-control" id="basic_example_2" value="<?php echo html_escape($schedul_info->end_time);?>" autocomplete="off" name="e_time" >
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                                <!-- /input-group -->
                                <?php echo form_error('s_time', '<div class=" text-danger">', '</div>'); ?>
                                <?php echo form_error('e_time', '<div class=" text-danger">', '</div>'); ?>
                            </div>
                        </div>



                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('day');?></label>
                                    <div class="col-md-5">
                                        <select class="form-control" name="day" id="day" onchange="loadError(this.value);">
                                            <option value=''>--Select day--</option>
                                            <option value='1' <?php echo (html_escape($schedul_info->day)=='1'?'selected':'')?>><?php echo display('saturday');?></option>
                                            <option value='2' <?php echo (html_escape($schedul_info->day)=='2'?'selected':'')?>><?php echo display('sunday');?></option>
                                            <option value='3' <?php echo (html_escape($schedul_info->day)=='3'?'selected':'')?>><?php echo display('monday');?></option>
                                            <option value='4' <?php echo (html_escape($schedul_info->day)=='4'?'selected':'')?>><?php echo display('tuesday');?></option>
                                            <option value='5' <?php echo (html_escape($schedul_info->day)=='5'?'selected':'')?>><?php echo display('wednesday');?></option>
                                            <option value='6' <?php echo (html_escape($schedul_info->day)=='6'?'selected':'')?>><?php echo display('thusday');?></option>
                                            <option value='7' <?php echo (html_escape($schedul_info->day)=='7'?'selected':'')?>><?php echo display('friday');?></option>
                                        </select>
                                        <?php echo form_error('day', '<div class=" text-danger">', '</div>'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> <?php echo display('set_per_patient_time');?> </label>
                                    <div class="col-md-5">
                                      
                                    <div class=" input-daterange">
                                        <input type="number" name="p_time" value="<?php echo html_escape($schedul_info->per_patient_time);?>" autocomplete="off" class="form-control">
                                        <span class="help-block"> <?php echo display('set_time_msg');?> </span>
                                        <?php echo form_error('p_time', '<div class=" text-danger">', '</div>'); ?>
                                    </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo display('visibility');?></label>
                                    <div class="col-md-5">
                                        <div class="md-radio-inline">
                                            <div class="md-radio">
                                                <input type="radio" id="checkbox2_5" value="1" name="visible" <?php echo ($schedul_info->visibility=='1')?'checked':'' ?>  value="1" class="md-radiobtn">
                                                <label for="checkbox2_5">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> <?php echo display('yes');?>
                                                </label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" id="checkbox2_10" value="0" name="visible"  <?php echo (html_escape($schedul_info->visibility)=='0')?'checked':'' ?> value="0" class="md-radiobtn">
                                                <label for="checkbox2_10">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> <?php echo display('no');?>
                                                </label>
                                            </div>
                                            <?php echo form_error('visible', '<div class=" text-danger">', '</div>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?php echo html_escape($schedul_info->schedul_id);?>">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-success"><?php echo display('Update');?></button>
                                </div>
                            </div>
                         <?php echo form_close();?>
                     </div>
                </div>
            </div>
        </div>
    </div> <!-- /#page-wrapper -->            
    </section>
</div>

