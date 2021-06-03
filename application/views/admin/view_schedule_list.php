
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('schedule_list');?></h1>
            <small><?php echo display('schedule_list');?></small>
            <ol class="breadcrumb">
                <li><a target="_blank" href="<?php echo base_url();?>"><i class="pe-7s-home"></i> <?php echo display('site_view')?></a></li>
                <li class="active"><a href="<?php echo base_url();?>admin/Dashboard"><?php echo display('deashbord');?></a></li>
            </ol>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
          <div class="row">
    <!--  table area-->
     <div class="col-sm-12">
        <?php 
            $del_msg = $this->session->userdata('del_msg');
            $msg = $this->session->userdata('message');
            if($del_msg !=''){
                  echo "<div class='alert alert-success msg'>".html_escape($del_msg)."</div><br>";
                  $this->session->unset_userdata('del_msg');
            }
            if($msg !=''){
                  echo "<div class='alert alert-success msg'>".html_escape($msg)."</div><br>";
                  $this->session->unset_userdata('message');
            }

    function day($day){
        if($day == 1){
            return $day = "Sunday";
        }
        elseif ($day == 2) {
            return $day = "Monday";
        }elseif ($day == 3) {
            return $day = "Tuesday";
        }elseif ($day == 4) {
            return $day = "Wednesday";
        }elseif ($day == 5) {
            return $day = "Thusday";
        }elseif ($day == 6) {
            return $day = "Friday";
        }else {
            return $day = "Saturday";
        }
    }

           


        ?>
            <div  class="panel panel-default">
                <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('schedule_list')?></h4>
                        </div>
                    </div>
                    
                <div class="panel-body">
                    <div class="table-responsive order-table">
                        <table width="100%" class="table table table-striped table-bordered table-hover" id="dataTables">
                            <thead>

                                <tr>
                                    <th >#SL</th>
                                    <th >Doctor </th>
									<th >Fees</th>
									<th ><?php echo display('venue');?> </th>
                                    <th ><?php echo display('day');?> </th>
                                    <th ><?php echo display('start_time');?> </th>
                                    <th ><?php echo display('end_time');?> </th>
                                    <th ><?php echo display('set_per_patient_time');?> </th>
                                    <th ><?php echo display('action');?> </th>
                                </tr>

                            </thead>
                            <tbody>

                            <?php
                            $i = 1;
                                if(!empty($schedul_info))
                                   foreach ($schedul_info as $value) {
									   
									 $SQL = "select doctor_name from doctor_tbl where doctor_id ='".$value->doctor_id."'";   
									 $query = $this->db->query($SQL);

									$result2 = $query->result_array();
									$doctor_name = '-';
									if(is_array($result2) && count($result2)>0){
										$doctor_name = $result2[0]['doctor_name'];
									}
                                ?>
                                <tr>
                                    <td><?php echo $i++;?></td>
									<td><?php echo html_escape($doctor_name);?></td>
									<td><?php if($value->fees==1){echo 'Free';}if($value->fees==2){echo 'Paid';}?></td>
                                    <td><?php echo html_escape($value->venue_name);?></td>
                                    <td><?php echo html_escape(day($value->day));?></td>
                                    <td><?php echo html_escape($value->start_time);?></td>
                                    <td><?php echo html_escape($value->end_time);?></td>
                                    <td><?php echo html_escape($value->per_patient_time);?></td>

                                    <td class="text-right">
                                      <a href="<?php echo base_url();?>admin/Schedule_controller/schedul_edit/<?php echo html_escape($value->schedul_id);?>" class="btn btn-xs btn-info">
                                        <i class="fa fa-edit"></i></a>
                                        <a href="<?php echo base_url();?>admin/Schedule_controller/schedul_delete/<?php echo html_escape($value->schedul_id);?>" class="btn btn-xs btn-danger">
                                        <i class="fa fa-trash"></i></a>
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






