

<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1>Phrase</h1>
            <small>Phrase</small>
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

       
    <div  class="panel panel-default ">

            <div class="panel-heading">
                <div class="panel-title">
                    <a href="<?php echo  base_url('language') ?>" class="btn btn-info pull-right text-white">Language Hom</a>
                    <h4>Phrase</h4>
                </div>
            </div>

                <div class="panel-body">
                    <div class="portlet-body">

                      <table class="table table-striped">
                        <thead>
                            <tr>
                                <td colspan="2">
                                    <?php echo  form_open('language/addPhrase', ' class="form-inline" ') ?> 
                                        <div class="form-group">
                                            <label class="sr-only" for="addphrase"> Phrase Name</label>
                                            <input name="phrase[]" type="text" class="form-control" id="addphrase" placeholder="Phrase Name">
                                        </div>
                                          
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    <?php echo  form_close(); ?>
                                </td>
                            </tr>
                            <tr>
                                <th><i class="fa fa-th-list"></i></th>
                                <th>Phrase</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($phrases)) {?>
                                <?php $sl = 1 ?>
                                <?php foreach ($phrases as $value) {?>
                                <tr>
                                    <td><?php echo  $sl++ ?></td>
                                    <td><?php echo html_escape($value->phrase) ?></td>
                                </tr>
                                <?php } ?>
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



