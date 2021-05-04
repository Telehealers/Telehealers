<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('slider');?></h1>
            <small><?php echo display('slider');?></small>
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
            <div class="panel panel-default panel-form">

                <div class="panel-heading">
                    <div class="panel-title">
                        <h4><?php echo display('slider');?></h4>
                    </div>
                </div>

                
                <div class="panel-body">
                    <div class="portlet-body form">
                        <?php 
                            $msg = $this->session->flashdata('message_s');
                                if($msg !=''){
                                    echo htmlspecialchars_decode($msg);
                                }

                            if($this->session->flashdata('exception')!=""){
                                echo $this->session->flashdata('exception');
                            }
                       
                            $attributes = array('class' => 'form-horizontal','role'=>'form');
                            echo form_open_multipart('admin/Web_setup_controller/save_slider', $attributes);                
                         ?>
                                                       
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="field_wrapper">
                                                    <div class="form-group ">
                                                        <div class="col-md-3 col-xs-12">
                                                            <input type="file" required  class="form-control" name="picture[]"/>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <input type="text"  class="form-control" name="headline[]" placeholder="<?php echo display('heading');?>" />
                                                        </div>

                                                        <div class="col-md-3" ><input type="text"  class="form-control"  name="details[]" placeholder="<?php echo display('details');?>" /></div> 
                                                        <div class="col-md-3" ><input type="number"  class="form-control"  name="sequence[]" placeholder="Sequence" /></div>
                                                    </div> 
                                     
                                                </div>    
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                    
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <button type="reset" class="btn btn-danger"><?php echo display('reset');?></button>
                                        <button type="submit" class="btn btn-success"><?php echo display('submit');?></button>
                                    </div>
                                </div>
                                
                        <?php echo form_close();?>
                    </div>
                </div>
            </div>
        </div>            
    </section>






 <section class="content">

  
    <div class="row">
    <!-- =============== table area =============== -->
        <div class="col-sm-12">
            <div  class="panel panel-default">

                 <div class="panel-heading">
                    <div class="panel-title">
                        <h4><?php echo display('slider_list');?></h4>
                    </div>
                </div>

            <?php echo @$msg = $this->session->flashdata('message'); ?>
                <div class="panel-body">

                    <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                        <thead>
                            <tr>
                                <th><?php echo display('heading');?></th>
                                <th><?php echo display('details');?></th>
                                <th>Sequence</th>
                                <th><?php echo display('picture');?></th>
                                <th><?php echo display('action');?></th> 
                            </tr>
                        </thead>

                        <tbody>
                           <?php
                                foreach ($slider as $value) {
                            ?>
                                <tr class="odd gradeX">
                               
                                    <td><?php echo html_escape($value->heading);?></td>
                                    <td><?php echo html_escape($value->details);?></td>
                                    <td><?php echo html_escape($value->sequence);?></td>
                                    <td>
                                        <div class="profile-userpic">
                                            <?php 
                                                echo '<img width=50" src="'.html_escape($value->picture).'" class="img-responsive">';
                                            ?>
                                        </div>
                                    </td>
                                    <td width="100">
                                   		<a class="btn btn-sm btn-primary" href="<?php echo base_url();?>admin/Web_setup_controller/slider_edit/<?php echo html_escape($value->id);?>" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                 						<a class="btn btn-sm btn-danger" href="<?php echo base_url();?>admin/Web_setup_controller/delete_slider/<?php echo html_escape($value->id);?>" title="Hapus"><i class="glyphicon glyphicon-trash"></i></a>
                                    </td> 
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





