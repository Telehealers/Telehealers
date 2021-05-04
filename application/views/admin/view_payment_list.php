

<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('payment_list');?></h1>
            <small><?php echo display('payment_list');?></small>
            <ol class="breadcrumb">
                <li><a target="_blank" href="<?php echo base_url();?>"><i class="pe-7s-home"></i> <?php echo display('site_view')?></a></li>
                <li class="active"><a href="<?php echo base_url();?>admin/Dashboard"><?php echo display('deashbord');?></a></li>
            </ol>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php 
        echo @$msg = $this->session->flashdata('message'); 
     ?>
    <div class="row">
        <!--  table area -->
        <div class="col-sm-12">
            <div  class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('payment_list')?></h4>
                        </div>
                    </div>

                <div class="panel-body">

                    <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" >
                        <thead>
                            <tr>																<th>Doctor</th>
                                <th><?php echo display('patient_id');?></th>
                                <th><?php echo display('appointment_id');?></th>
                                <th>Razorpay Payment ID</th>
                                <th><?php echo display('amount');?></th>
                                <th><?php echo display('date');?></th>
                                
                            </tr>
                        </thead>
                        <tbody>
                           <?php
                                foreach ($info as $value) {																	$SQL1 = "select doctor_name from doctor_tbl where doctor_id = '".$value->doctor_id."'";								$query1 = $this->db->query($SQL1);								$result1 = $query1->result_array();								if(is_array($result1) && count($result1)>0){									$doctor_name = $result1[0]['doctor_name'];								}
                            ?>
                            <tr class="odd gradeX">
                                
								 <td><?php echo html_escape($doctor_name);?></td>
                                <td><?php echo html_escape($value->patient_id); ?></td>
                                <td><?php echo html_escape($value->appointment_id);?></td>
                                <td><?php echo html_escape($value->razorpay_payment_id);?></td>
                                <td><?php echo html_escape($value->amount);?> INR</td>
                                <td><?php echo html_escape($value->date_time);?></td>
                               
                                
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


<?php
    $printTitle = "Patient List";
    $this->session->set_flashdata(array('pTitle' => $printTitle));    
?>  



