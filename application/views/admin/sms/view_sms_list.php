<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('sms_list');?></h1>
            <small><?php echo display('sms_list');?></small>
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
                    <div class="panel panel-default">

                         <div class="panel-heading ">
                    <div class="panel-title" >
                        <h4><?php echo display('sms_list');?></h4>
                    </div>
                </div>
                
                        <div class="panel-body">
                    
                                <table width="100%" class="table table-striped table-bordered table-hover" id="sms">
                                    <thead>
                                        <tr>
                                            <th class=""><?php echo display('reciver');?></th>
                                            <th class=""><?php echo display('provider');?></th>
                                            <th class=""><?php echo display('date_time');?></th>
                                            <th class=""><?php echo display('message');?></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php foreach($coustom_sms as $value){?>
                                        <tr>
                                            <td><?php echo html_escape($value->reciver);?></td>
                                            <td><?php echo html_escape($value->gateway);?></td>
                                            <td><?php echo html_escape($value->sms_date_time);?></td>
                                            <td><?php echo html_escape($value->message);?></td>
                                        </tr>
                                        <?php
                                            }
                                        ?>

                                         <?php foreach($auto_sms as $value){?>
                                        <tr>
                                            <td><?php echo html_escape($value->reciver);?></td>
                                            <td><?php echo html_escape($value->gateway);?></td>
                                            <td><?php echo html_escape($value->sms_date_time);?></td>
                                            <td><?php echo html_escape($value->message);?></td>
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
    </section>
</div>




