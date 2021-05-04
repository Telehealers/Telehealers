<?php
  $start = @$v_info->start_time;
  $end =  @$v_info->end_time;
  $pp_time = @$v_info->per_patient_time;
  $patient_time = date('h:i A', strtotime($start));
  $end_time = date('h:i A', strtotime($end));
?>

<?php 
 foreach ($patient_info as  $value) { } 
?>

<!-- style -->
<link href="<?php echo base_url(); ?>web_assets/css/inline.css" rel="stylesheet">

    <div id="dif_p" class="container gggggg" >
        <div class="row">			<div class="col-md-3">
             <a class="btn btn-primary" href="<?php echo base_url();?>admin/Generic_controller/create_new_generic">
             <i class="fa fa-plus" aria-hidden="true"></i> <?php echo display('create_generic')?></a>
            </div>						<div class="col-md-6" style="text-align:center;">			
             <!-- <img src="http://telehealers.in/./assets/uploads/images/telehe.png" style="width:140px;"> -->
            </div>
            <div class="col-md-3">
            <div class="social-icons pull-right">
                <!--<label class="radio-inline btn btn btn-primary"  id="pad"><?php echo display('paid_print');?></label>-->
                <ul>
                    <li><a href="" onclick="printContent('div1')" title="Print"><i class="fa fa-print"></i></a></li>
                </ul>
            </div> 			</div>
        </div>
    </div>


<div class="main_form_row_fild" style="background-image: url(<?php echo base_url();?>/web_assets2/images/aajay.jpg);">
    <div id="div1">
        <?php if(!empty($patient_info)){ ?>
        <!--   -->
        <!-- start hoder area -->
        <!--  -->        
        <div class="container">
        	<div class="main-header">
    	        <div class="row header_area">
    	            <div class="hed-1 ">
    	                <b><?php echo display('date');?> :</b> 
    	                    <?php 
    	                        $date1 =  date_create(@$value->create_date_time);
    	                        echo $newDate = date_format($date1,"d-M-Y H:i:sa l");
    	                    ?>
    	            </div>
    	           <div class="hed-2">                      
    	                <?php echo display('patient_id');?>: <?php echo html_escape(@$value->patient_id);?>,
    	                <?php echo display('appointment_id');?>: <?php echo html_escape(@$value->appointment_id);?> 
    	                <a class="d-hed-2"  target="_blank" href="<?php echo base_url();?>History_controller/patient_history/<?php echo html_escape(@$value->patient_id);?>"><?php echo display('patient_history');?></a>
    	            </div>
    	        </div>

    	        <div class="row address_area">
    	            <div class="a-one">
    	                <h4 ><?php echo html_escape(@$value->doctor_name);?>- (<?php echo html_escape(@$value->doc_id);?>)</h4>
    	                <?php echo html_escape(@$value->degrees);?><br>
    	                <b><?php echo html_escape(@$value->specialist);?></b><br>
    	                <?php echo html_escape(@$value->designation);?><br>
    	                <b><?php //echo html_escape(@$value->service_place);?></b>    	            
    	                <b><?php echo html_escape(@$v_info->venue_name);?></b><br>
    	                <?php //echo html_escape(@$v_info->venue_address);?>,
    	                <?php //echo html_escape(@$v_info->venue_contact);?>
    	            </div>
    	        </div>

    	        <div class="row patient_area">
    	            <div class="col-md-12">
    	                <h5 >
    	                <strong><?php echo display('patient_name');?>:</strong> <b><?php echo html_escape(@$value->patient_name);?></b>,
    	                 &nbsp; <strong><?php echo display('age');?> :</strong> 
    	                 <?php
    	                    $date1=date_create(@$value->birth_date);
    	                    $date2= date_create( date('y-m-d'));
    	                    $diff=date_diff($date1,$date2);
    	                    echo @$diff->format("%Y-Y:%m-M:%d-D");
    	                  ?>,
    	                 &nbsp;<strong><?php echo display('sex');?> :</strong> <?php echo html_escape(@$value->sex);?>, 
    	                 &nbsp;<strong><?php echo display('patient_weight');?> :</strong> <?php echo html_escape(@$value->weight);?>, 
                         &nbsp;<strong><?php echo display('patient_bp');?> :</strong> <?php echo html_escape(@$value->pressure);?>
    	                 </h5>
    	            </div>
    	        </div>
            </div>
        </div>

    <!--   -->
    <!-- end hoder area -->
    <!--  -->



    <!--   -->
    <!-- start content area -->
    <!--  -->  
            <div class="container">
                <div class="row">
                	<!-- laft sideber -->
                    <div class="col-md-4 col-sm-4 left-side">
		                    <?php if(!empty($value->problem)){?>
		                        <div class="problem">
		                            <h4><b><?php echo display('patient_cc');?></b></h4>
		                            <?php 
		                                $cc =  explode(",",$value->problem);
		                                for ($i=0; $i<count($cc); $i++) {
		                                     echo '<li class="tg">'.html_escape(@$cc[$i]).'</li>';
		                                }
		                            ?>
		                        </div>
		                    <?php } ?>

                                <?php if(!empty($value->history)){?>
                                <div class="history">
                                    <h4><b><?php echo display('history');?> </b></h4>
                                    <?php 
                                        $hs =  explode(",",$value->history);
                                        for ($i=0; $i<count($hs); $i++) {
                                             echo '<li class="tg">'.html_escape(@$hs[$i]).'</li>';
                                        }
                                    ?>
                                </div>
                                <?php } ?>

		                        <?php if(!empty($value->temperature)){?>
		                        <div class="temperature">
		                              <h4><b><?php echo display('temperature');?> : </b><?php echo(html_escape($value->temperature)?html_escape($value->temperature)."<sup>&deg</sup>C":'');?></h4>
		                        </div>
		                        <?php } ?>

                                <?php if(!empty($value->oex)){?>
                                        <h4><?php echo display('oex');?></h4>
                                        <?php  
                                        $o =  explode(",",$value->oex);
                                        for ($i=0; $i<count($o); $i++) {
                                         echo '<li class="tg">'.html_escape(@$o[$i]).'</li>';
                                        }       
                                        ?>
                                <?php }?>

                                <?php if(!empty($value->pd)){?>
                                       <h4><?php echo display('pd');?></h4> 
                                       <?php 
                                            $p =  explode(",",$value->pd);
                                            for ($i=0; $i<count($p); $i++) {
                                             echo '<li class="tg">'.html_escape(@$p[$i]).'</li>';
                                            }
                                       ?> 
                                <?php }?>

                                <?php  if(!empty($t_info)) { ?>
		              
    		                        <div class="test-list">
    		                            <h4><b><?php echo display('test');?></b></h4>
    		                            <ul>
    		                                <?php  $i=1; foreach ($t_info as $value2) { ?>
        		                               <li><?php echo $i++.' . '.html_escape(@$value2->test_name);?></li>
        		                               <?php echo html_escape(@$value2->test_assign_description);?>
    		                                <?php } ?>
    		                            </ul>
    		                        </div>

                                <?php } ?>

        		                <?php if(!empty($a_info)) { ?>
                                    <div class="advice-details">
                                        <h4><b><?php echo display('advice');?></b></h4>
                                        <ul>
                                            <?php  $i=1; foreach ($a_info as $value2) { ?>
                                            <li><?php echo html_escape(@$value2->advice);?></li>

                                            <?php } ?>
                                        </ul>
                                    </div>
                                <?php } ?>
                    </div><!--end left sideber-->



                    <!-- right sideber -->
                    <div class="col-md-8 col-sm-8 right-side">
                        <div class="table-responsive marg">
                            <table  class="table table-bordered table-hover">
                                
                                <thead>
                                    <tr>
                                        <th><?php echo display('sl');?></th>
                                        <th><?php echo display('type');?></th>
                                        <th><?php echo display('generic_name');?></th>
                                        <th><?php echo display('mgml');?></th>
                                        <th><?php echo display('dose');?> </th>
                                        <th><?php echo display('day');?></th>
                                        <th><?php echo display('medicine_comment');?></th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php $i=1; foreach ($patient_info as $value1) {  ?>
                                    <tr>
                                        <td><?php echo @$i++;?></td>
                                        <td><?php echo html_escape(@$value1->medicine_type);?></td>
                                        <td><?php echo html_escape(@$value1->group_name);?></td>
                                        <td><?php echo html_escape(@$value1->mg);?></td>
                                        <td><?php echo html_escape(@$value1->dose);?></td>
                                        <td><?php echo html_escape(@$value1->day);?></td>
                                        <td><?php echo html_escape(@$value1->medicine_com);?></td>
                                    </tr>
                                <?php } ?> 
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td colspan="7" class="text-center"><?php echo html_escape(@$value1->pres_comments); ?></a>.</td>
                                    </tr>
                                </tfoot>
                                
                            </table>
                        </div>
                    </div><!-- end right sideber-->

                </div>
            </div>
        <?php } else{ ?>
            <section>
                <div class="container">
                    <div class="row details-content">
                        <div class="patient-details text-center">
                            <div class="alert alert-block alert-danger fade in">
                                 <strong><?php echo display('prescription_empty_msg');?></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </section>               
        <?php } ?>

        <!--   -->
        <!-- start footer area -->
        <!--  -->  
        <div class="ecc container">
            <div class="row main-footer">
                 <div class="col-sm-7 f1">
                    <p id="link"><?php echo base_url();?></p>
                </div>

                <div class="col-sm-5 f2">
                    

					<?php //echo "signature--".$value->picture2; ?>
					<?php 
					if(isset($value->picture2) && $value->picture2 !=""){
						
						?>
						<?php $signature = $value->picture2; ?>

						<?php if($signature!=""){?>		

						<img src="<?php echo $signature; ?>" style="width:120px;margin-right:120px; float:right;">						
						<br><br>
						<?php } ?>		

						<?php } ?>
						
						<p id="signature"><?php echo display('Signature');?></p>																				
                </div>           
            </div>
	            <div class="col-sm-12 footer1">
	                <?php echo display('chamber_time');?> :
	                <?php echo display('start_time');?>: <?php echo date('h:i A', strtotime(@$chember_time->start_time));?>,
	                <?php echo display('end_time');?> : <?php echo date('h:i A', strtotime(@$chember_time->end_time));?>
	            </div>
            </div> 
        </div> 
                        </div>
        <!--   -->
        <!-- end footer area -->
        <!--  -->  
        </div>


