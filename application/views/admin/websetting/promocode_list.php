<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1>Promocode</h1>
            <small>Promocode</small>
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
        echo @$exception = $this->session->flashdata('exception'); 
    ?>
    <div class="row">
        <!--  table area -->
        <div class="col-sm-12">
            <div  class="panel panel-default">

                 <div class="panel-heading">
                    <div class="panel-title">
                        <h4>Promocode</h4>
                    </div>
                </div>

                
                <div class="panel-body">
                    <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Promocode</th>
                                <th>Limit</th>
								<th>Used</th>
                                <th>Price</th>
                                <th><?php echo display('action');?></th> 
                            </tr>
                        </thead>
                        
                        <tbody>
                           <?php
                                foreach ($post_info as $value) {
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo html_escape($value->title); ?></td>
								<td><?php echo html_escape($value->p_limit); ?></td>
								<td><?php echo html_escape($value->p_used); ?></td>
                                <td>Rs. <?php echo html_escape($value->price);?></td>
                                <td width="100">
                                    <a  class="btn btn-xs btn-info" href="<?php echo base_url();?>admin/promocode/edit_post/<?php echo html_escape($value->id);?>">
                                    <i class="fa fa-edit"></i> </a>
                                    <a  class="btn btn-xs btn-danger" href="<?php echo base_url();?>admin/promocode/delete_post/<?php echo html_escape($value->id) ;?>" onclick="return confirm('Are you want to delelte?');">
                                    <i class="fa fa-trash"></i> </a>
                                </td> 
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table> 
                </div>
                </div>
            </div>
        </div>
    </div>      
    </section>
</div>






