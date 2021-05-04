<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('create_appointment');?></h1>
            <small><?php echo display('create_appointment');?></small>
            <ol class="breadcrumb">
                <li><a target="_blank" href="<?php echo base_url();?>"><i class="pe-7s-home"></i> <?php echo display('site_view')?></a></li>
                <li class="active"><a href="<?php echo base_url();?>admin/Dashboard"><?php echo display('deashbord');?></a></li>
            </ol>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-sm-5">
                <div  class="panel panel-default panel-form">

                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Patient Info</h4>
                        </div>
                    </div>


                    <div class="panel-body">
                        <div class="portlet-body form">

                            <div id="print">             
                               <a href="" onclick="printContent('printid')">
                                    <img src="<?php echo base_url();?>assets/images/print.png" height="30" width="40">
                               </a>                
                            </div>

                            <div id="printid" class="printpage">

                                <h2><?php echo display('register_information');?></h2>

                                    <?php if(!empty($info['picture'])) { ?>
                                        <img width="200" class="ap_img" src="<?php echo html_escape(@$info['picture']);?>">
                                    <?php }else{ ?>
                                        <img width="200" class="ap_img" src="<?php echo base_url();?>assets/images/male.png">
                                    <?php } ?>

                                    <table>

                                        <tr>
                                            <td><?php echo display('patient_name');?> : </td>
                                            <td> <?php echo html_escape(@$info['patient_name']);?> </td>
                                        </tr>

                                        <tr>
                                            <td><?php echo display('phone_number');?> : </td>
                                            <td> <?php echo html_escape(@$info['patient_phone']);?> </td>
                                        </tr>

                                        <tr>
                                            <td><?php echo display('address');?> : </td>
                                            <td> <?php echo html_escape(@$info['address']);?> </td>
                                        </tr>

                                        <tr>
                                          <td><?php echo display('birth_date');?> : </td>
                                            <td> 
                                              <?php 
                                               @$date1 = date_create($info['birth_date']);
                                                echo date_format($date1,"d-M-Y")
                                              ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><?php echo display('sex');?> : </td>
                                            <td> <?php echo html_escape(@$info['sex']);?> </td>
                                        </tr>

                                        <tr>
                                            <td><?php echo display('blood_group');?> : </td>
                                            <td> <?php echo html_escape(@$info['blood_group']);?> </td>
                                        </tr>

                                        <tr>
                                            <td><?php echo display('patient_id');?>: </td>
                                            <td id="font_style"> <?php echo html_escape(@$info['patient_id']);?> </td>
                                        </tr>
                                        <tr>
                                            <td><?php echo display('date');?> : </td>
                                            <td> <?php echo html_escape(@$info['create_date']);?></td>
                                        </tr>
                                    </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>    

            <!--  form area -->
            <div class="col-sm-7">
                   
                <div  class="panel panel-default panel-form">

                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('create_appointment');?></h4>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="portlet-body form">
                        <?php 
                            $mag = $this->session->flashdata('exception');
                            if($mag !=''){
                                echo '<div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                     <strong>'.html_escape($mag).'</strong>
                                </div>';
                            }
                            $attributes = array('class' => 'form-horizontal','target'=>'_blank','name'=>'p_info','role'=>'form');
                            echo form_open('admin/Appointment_controller/save_appointment', $attributes);                
                        ?>
                            <div class="form-body">

                                    <div class="form-group">
                                        <label class="col-md-3 control-label"><span class="text-danger"> * </span> <?php echo display('date');?></label>
                                        <div class="col-md-8">
                                           <input type="text" id="date" value="<?php echo set_value('date'); ?>" name="date" class="form-control datepicker1"  placeholder="yyyy-mm-dd" required>
                                            <span class="text-danger"><?php echo form_error('date'); ?> </span>
                                         </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label"><span class="text-danger"> * </span> <?php echo display('patient_id');?></label>
                                        <div class="col-md-8">
                                            <input type="text" value="<?php echo html_escape(@$info['patient_id']);?>" name="p_id" id="patient_id" onkeyup="loadName(this.value);" class="form-control" placeholder="<?php echo display('patient_id');?>" value="<?php echo isset($a[0]['p_id']) ? $a[0]['p_id'] : set_value('p_id'); ?>" required> 
                                            <span class="text-danger"><?php echo form_error('p_id'); ?> </span>
                                            <span class='p_name' class="text-danger"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label "><span class="text-danger"> * </span> <?php echo display('venue');?> </label>
                                        <div class="col-md-8">
                                            <select class="form-control v_name" id="venue" onchange="loadSchedul(this.value);" name="venue" value="<?php echo set_value('venue')?>" required>
                                                <option value="">--<?php echo display('select_venue');?>--</option>
                                                <?php foreach ($venue_info as $value) {
                                                    echo '<option value="'.html_escape($value->venue_id).'">'.html_escape($value->venue_name).'</option>';
                                                }?>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('venue'); ?> </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label"><?php echo display('choose_serial');?></label>
                                        <div class="col-md-8 schedul"></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label"><?php echo display('patient_cc');?></label>
                                        <div class="col-md-8">
                                            <textarea name="problem" class="form-control"></textarea>
                                            <span class="text-danger"><?php echo form_error('problem'); ?> </span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-offset-3 col-sm-6">
                                             <button type="reset" class="btn btn-danger"><?php echo display('reset')?></button>
                                            <button type="submit" class="btn btn-success"><?php echo display('submit')?></button>
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
