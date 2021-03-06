

<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('today_prescription');?></h1>
            <small><?php echo display('today_prescription');?></small>
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
            <?php echo $message = $this->session->flashdata('message');?>
            <div class="panel panel-default">
                <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('today_prescription');?></h4>
                        </div>
                    </div>
                    
                <div class="panel-body">
                   <table width="100%" class="table table-striped table-bordered table-hover" id="patient_list">
                        
                        <thead>
                            <tr>
                                <th class="all"><?php echo display('picture');?></th>
                                <th class="all"><?php echo display('patient_name');?></th>
                                <th class="all"><?php echo display('patient_id');?></th>
                                <th class="all"><?php echo display('phone_number');?></th>
                                <th class="all"><?php echo display('sex');?></th>
                                <th class="desktop"><?php echo display('action');?></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($Prescription as $value) {  ?>
                            <tr>
                                <td>
                                    <?php 
                                       if($value->picture){
                                        echo '<img width="60" src="'.html_escape($value->picture).'" class="img-responsive">';
                                       }else{
                                        echo '<img width="60" src="'.base_url().'assets/images/male.png" class="img-responsive">';
                                       }
                                    ?>
                                </td>

                                <td><?php echo html_escape($value->patient_name);?></td>
                                <td><?php echo html_escape($value->patient_id);?></td>
                                <td><?php echo html_escape($value->patient_phone);?></td>
                                <td><?php echo html_escape($value->sex); ?></td>
                                <td>
                                    <a class="btn btn-xs btn-info"target="_blank" href="<?php echo base_url();?>admin/Prescription_controller/my_prescription/<?php echo html_escape($value->prescription_id); ?>"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
    </div>            
    </section>
</div>




