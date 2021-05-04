<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('web_site_enable_disable');?></h1>
            <small><?php echo display('web_site_enable_disable');?></small>
            <ol class="breadcrumb">
                <li><a target="_blank" href="<?php echo base_url();?>"><i class="pe-7s-home"></i> <?php echo display('site_view')?></a></li>
                <li class="active"><a href="<?php echo base_url();?>admin/Dashboard"><?php echo display('deashbord');?></a></li>
            </ol>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">


        <!--  form area -->
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4><?php echo display('web_site_enable_disable');?></h4>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="portlet-body form">
                        <?php 
                            $msg = $this->session->flashdata('message');
                              if($msg !=''){
                                  echo htmlspecialchars_decode($msg);
                              }
                              
                           ?>
                       <form class="form-horizontal">

                            <?php if ($info->details=='on') {?>

                                    <div class="form-body">
                                        <p><?php echo display('website_desable_msg');?></p>
                                        <a class="btn btn-lg btn-danger" href="<?php echo base_url();?>admin/Web_setup_controller/save_off"> <i class="fa fa-times"></i> <?php echo display('website_desable');?></a>
                                    </div>

                            <?php } else{ ?>

                                    <div class="form-body">
                                       <p><?php echo display('website_enable_msg');?></p>
                                        <a class="btn btn-lg btn-success" href="<?php echo base_url();?>admin/Web_setup_controller/save_on"> <i class="fa fa-eye"></i> <?php echo display('website_enable');?></a>
                                    </div>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
          <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="panel-title">
                        <h4><?php echo display('html_code_title');?></h4>
                    </div>
                </div>

            <div class="panel-heading ">
                <div class="panel-title" >
                    <p><?php echo display('html_code_description');?></p>
                </div>
            </div>
            <div class="breadcrumbs ng-scope">
                
                  <?php 
                   $api_iframe = '<iframe id="sframe" src="'.base_url().'api" width="100%" height="800" marginwidth="0"marginheight="0" frameborder="0" scrolling="no" ></iframe>'; 
                  ?>

                  <div class="form-group">
                      <textarea class="form-control" name="problem"  id="problem" placeholder="Write your problem" maxlength="140" rows="7">
                        <?php echo htmlspecialchars_decode($api_iframe);?>
                      </textarea>         
                  </div>
            </div>
            </div>
        </div>

         <div class="col-sm-6">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="panel-title">
                        <h4><?php echo display('js_code_title');?></h4>
                    </div>
                </div>

                <div class="panel-heading ">
                    <div class="panel-title">
                        <p><?php echo display('js_code_description');?></p>
                    </div>
               </div>
                  <?php 
                  $a ='<script type="text/javascript">';
                  $b = "var sfrm = document.createElement('iframe');
                  sfrm.setAttribute('id', 'sframe'); 
                  sfrm.setAttribute('src', '".base_url()."'Api); 
                  sfrm.setAttribute('width', '100%');
                  sfrm.setAttribute('height', '800px');
                  sfrm.setAttribute('frameborder', '0');
                  sfrm.setAttribute('scrolling', 'no');";
                  $c="document.write('<div id=".'"s384gh4r"'."></div>');";
                  $d="document.getElementById('s384gh4r').appendChild(sfrm);</script>"; 
                  ?>
                  <div class="form-group">
                      <textarea class="form-control" name="problem"  id="problem" placeholder="Write your problem" maxlength="140" rows="7">
                        <?php echo html_escape($a).html_escape($b).html_escape($c).html_escape($d);?>
                      </textarea>         
                  </div>
            </div>
        </div>

    </div>            
    </section>
</div>




