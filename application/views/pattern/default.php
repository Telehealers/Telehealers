<?php
    $start = @$v_info->start_time;
    $end =  @$v_info->end_time;
    $pp_time = @$v_info->per_patient_time;
    $patient_time = date('H:i A', strtotime($start));
    $end_time = date('H:i A', strtotime($end));
	$img_url = 'https://www.telehealers.in/assets/uploads/images/telehe.png';
	$img_url2 = 'https://www.telehealers.in/web_assets2/images/aajay.jpg';
	//$img_url = 'https://www.telehealers.in/./assets/uploads/doctor/signat1.png';
?>

<?php 
    foreach ($patient_info as  $value) { } 
?>
<!-- style -->
<link href="<?php echo base_url(); ?>web_assets/css/inline.css" rel="stylesheet">

<div id="printDiv">
    <div id="dif_p" class="container gggggg" >
        <div class="row">
		
        <?php if($this->session->userdata('user_type')==1){?>
			<!--<div class="col-md-3">
             <a class="btn btn-primary" href="<?php echo base_url();?>admin/Prescription_controller/create_new_prescription"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo display('create_trade')?> </a>
			 </div>-->
        <?php }?>
		
		<div class="col-md-9" style="text-align:left;">
			<img src="<?php echo $img_url; ?>" style="width:140px; display:block;">
			
			</div>
			<div class="col-md-3">
            <div class="social-icons pull-right">
                <!--<label class="radio-inline btn btn btn-primary"  id="pad"><?php echo display('pad_print');?></label>-->
                <ul>
                    <li><a href="" onclick="printContent('printDiv')" title="Print"><i class="fa fa-print"></i></a></li>
                </ul>
            </div> 
			</div>
        </div>
    </div>
    <div class="main_form_row_fild" style="background-image: url(<?php echo $img_url2;?>);">
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
								
    	                        //echo $newDate = date_format($date1,"d-M-Y H:i:sa l");
								
								echo $newDate = date_format($date1,"d-M-Y l");
    	                    ?>
    	            </div>

    	           <div class="hed-2">                      
    	                <?php echo display('patient_id');?>: <?php echo html_escape(@$value->patient_id);?>&nbsp;&nbsp;
    	                <?php echo display('appointment_id');?>: <?php echo html_escape(@$value->appointment_id);?> 
						<?php if($value->patient_id!=""){ ?>
    	                <a class="d-hed-2" style="margin-left:20px;" target="_blank" href="<?php echo base_url();?>History_controller/patient_history/<?php echo html_escape(@$value->patient_id);?>"><?php echo display('patient_history');?></a>
						<?php } ?>
    	            </div>
                    
    	        </div>

    	        <div class="row address_area">
    	            <div class="a-one">
    	                <h4 ><?php echo html_escape(@$value->doctor_name);?> - (<?php echo html_escape(@$value->doc_id);?>)</h4>
    	                <?php echo html_escape(@$value->degrees);?><br>
    	                <b><?php echo html_escape(@$value->specialist);?></b><br>
    	                <?php echo html_escape(@$value->designation);?><br>
    	                <b><?php //echo html_escape(@$value->service_place);?></b>    	          
    	                <b><?php echo html_escape(@$v_info->venue_name);?></b><br>
    	                <?php //echo html_escape(@$v_info->venue_address);?>
    	                <?php //echo html_escape(@$v_info->venue_contact);?>
    	            </div>
    	        </div>

    	        <div class="row patient_area">
    	            <div class="col-md-12">
    	                <h5 >
    	                <strong><?php echo display('patient_name');?>:</strong> <b><?php echo html_escape(@$value->patient_name);?></b>
    	                 &nbsp; <strong>Age :</strong> 
    	                 <?php
							echo @$value->age;
    	                  ?>
                        <?php if(@$value->sex){ ?>
    	                 &nbsp;<strong><?php echo display('sex');?> :</strong> <?php echo html_escape(@$value->sex);}?> 
                        <?php if(@$value->weight){ ?>
    	                 &nbsp;<strong><?php echo display('patient_weight');?> :</strong> <?php echo html_escape(@$value->weight);}?> 
                         <?php if(@$value->pressure){ ?>
                         &nbsp;<strong><?php echo display('patient_bp');?> :</strong> <?php echo html_escape(@$value->pressure);}?>
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
                <div class="row" >
                	<!-- laft sideber -->
                    <div class="col-md-4 col-sm-4 left-side">
		                    <?php if(!empty($value->problem)){?>
		                        <div class="problem">
		                            <h4>Patient complaint</h4>
		                            <?php 
		                                $cc =  explode(",",$value->problem);
		                                for ($i=0; $i<count($cc); $i++) {
		                                     echo '<li class="tg">'.html_escape(@$cc[$i]).'</li>';
		                                }
		                            ?>
		                        </div>
		                      <?php } ?>


		                        <?php if(!empty($value->temperature)){?>
		                         <div class="temperature">
		                              <h4><?php echo display('temperature');?> : <?php echo(html_escape($value->temperature)?html_escape($value->temperature)."<sup>&deg</sup>C":'');?></h4>
		                            
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
                                       <h4><?php echo display('pd');?> </h4> 
                                       <?php 
                                            $p =  explode(",",$value->pd);
                                            for ($i=0; $i<count($p); $i++) {
                                             echo '<li class="tg">'.html_escape(@$p[$i]).'</li>';
                                            }
                                       ?> 
                                <?php }?>

                                <?php  if(!empty($t_info)) { ?>
		                       
		                        <div class="test-list">
		                             <h4><?php echo display('test');?></h4>
		                            <ul>
		                                <?php  $i=1; foreach ($t_info as $value2) { ?>
		                                
		                               <li><?php echo $i++.' . '.@$value2->test_name;?></li>
		                               <?php echo html_escape(@$value2->test_assign_description);?>

		                                <?php } ?>
		                            </ul>
		                        </div>
                                 <?php } ?>

		                    
                    </div><!--end left sideber-->



                    <!-- right sideber -->
                    <div class="col-md-8 col-sm-8 right-side">
                        <div class="table-responsive marg">
                           <?php if(!empty($value->history)){?>
                            <table  class="table table-bordered table-hover">
                                <div class="history">
                                    <thead><tr><th>
                                    <h4><?php echo display('history');?> </h4></th></tr></thead>
                                    <tbody><tr><td>
                                    <div style="text-indent: 5%;"><?php 
                                        echo html_escape(@$value->history);
                                    ?></div></td></tr></tbody>
                                </div>
                                <?php } ?>
                            <table  class="table table-bordered table-hover">
                                
                                <thead>
                                    
                                    <tr>
                                        <th><?php echo display('sl');?></th>
                                        <th><?php echo display('medicine_name');?></th>
                                        <th><?php echo display('medicine_comment');?></th>
                                    </tr>
                                    
                                </thead>

                                <tbody>
                                <?php $i=1; foreach ($patient_info as $value1) {  ?>
                                    <tr>
                                        <td><?php echo '&#8226;';?></td>
                                        <td><?php echo html_escape(@$value1->medicine_name);?></td>
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
                        <?php if(!empty($a_info)) { ?>
                                <div class="advice-details">
                                    <h4><?php echo display('advice');?></h4>
                                    <ul>
                                        <?php  $i=1; foreach ($a_info as $value2) { ?>
                                        <li><?php echo html_escape(@$value2->advice);?></li>

                                        <?php } ?>
                                    </ul>
                                </div>
                             <?php } ?>
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
                        
                        <p id="link">
                        To book an appointment:<?php echo 'www.telehealers.in';?>
                        </p>
                        Helpline #9071123400						
                    </div>
                    <div class="col-sm-5 f2">							
                        

						<?php if(isset($value->picture3) && $value->picture3 !=""){
						
						$signature = $value->picture3;
						
						$sign = str_replace('[removed]','data:image/png;base64,',$signature); 

						 ?>
						 
						<img src="<?php echo $sign; ?>" style="width:210px; margin-left:55px;">
						

						<?php } ?>
						<p id="signature" <?php if(isset($value->picture3) && $value->picture3 !=""){ ?> style="margin-top:0;" <?php } ?>><?php echo display('Signature');?></p>
                    </div>
                </div>
                
	            <div class="col-sm-12 footer1">
	                <?php //echo display('chamber_time');?>
	                <?php //echo display('start_time');?>  <?php //echo date('h:i A', strtotime(@$chember_time->start_time));?>
	                <?php //echo display('end_time');?>  <?php //echo date('h:i A', strtotime(@$chember_time->end_time));?>
	            </div>
            </div> 
        </div> 
        </div> 
<!--   -->
<!-- end footer area -->
<!--  -->  
    </div>
	</div>

<style>
@page {
    size: auto;
    margin: 0;
}
@print {
    @page :footer {
        display: none
    }
  
    @page :header {
        display: none
    }
}
</style>
