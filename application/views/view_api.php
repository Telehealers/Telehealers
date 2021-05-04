<?php
date_default_timezone_set('Europe/Rome');
?>
<!DOCTYPE html>
<html lang="it">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       <title>Habitusana</title>
        <?php 
            //query for logo 
            $result = $this->db->select('*')->from('web_pages_tbl')->where('name','fabicon')->where('status',1)->get()->row();
        ?>
        <link rel="icon" href="<?php echo (!empty(html_escape($result->picture))?html_escape($result->picture):null); ?>" sizes="16x16"> 
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Bootstrap -->
        <link href="<?php echo base_url();?>web_assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- jquery-ui -->
        <link href="<?php echo base_url();?>web_assets/css/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <!-- font-awesome -->
        <link href="<?php echo base_url();?>web_assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

        <!-- owl carousel -->
        <link href="<?php echo base_url();?>web_assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url();?>web_assets/plugins/owl-carousel/owl.theme.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url();?>web_assets/plugins/owl-carousel/owl.transitions.css" rel="stylesheet" type="text/css"/>
        <!-- Style -->
        <link href="<?php echo base_url();?>web_assets/css/style_web.css" rel="stylesheet" type="text/css"/>
    
    
    </head>



    <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
        <div class="se-pre-con"></div>

        <input type="hidden" id="base_url" value="<?php echo base_url()?>">
        <!-- Appointment section
        ==================================== -->
        <section id="appointment" class="appointment-inner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-offset-3">
                        <div class="tab">
                            <ul class="tabs">
                                <li><a href="#">APPOINTMENT</a></li>
                                <li><a href="#">REGISTER</a></li>
                            </ul>
                            <!-- / tabs -->
                            <div class="tab_content">
                                <div class="tabs_item">
                                    <?php 
                                      $mag = $this->session->flashdata('exception');
                                        if($mag !=''){
                                            echo htmlspecialchars_decode($mag);
                                        }
                                        $patient_id = $this->session->flashdata('patient_id');
                                        $attributes = array('name'=>'app_form', 'onsubmit'=>'return validateForm()');
                                        echo form_open('Api/appointment', $attributes);                
                                    ?>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="text" value="<?php echo heml_escape(@$patient_id);?>" onkeyup="loadName(this.value)" name="patient_id" id="patient_id" required class="form-control" placeholder="Patient ID">
                                            <span><?php echo form_error('patient_id'); ?> </span>
                                        </div>

                                        <div class='p_name' ></div>

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" name="date" id="date" class="form-control datepicker3" value="<?php echo set_value('date')?>"  required placeholder="Appointment Date">
                                            <span ><?php echo form_error('date'); ?> </span>
                                        </div>

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                             <select onchange="loadSchedul()" class="form-control" required name="venue_id" id="venue_id">
                                                <option value="">Venue</option>
                                                <?php foreach ($venue as $value) {
                                                    echo '<option value="'.heml_escape($value->venue_id).'">'.heml_escape($value->venue_name).'</option>';
                                                } ?>
                                                <span><?php echo form_error('venue_id'); ?> </span>
                                            </select>
                                        </div>

                                        <div class="schedul1"></div>
                                        <span ><?php echo form_error('sequence'); ?> </span>
                                  

                                        <div class="form-group">
                                            <textarea class="form-control" name="problem"  id="problem" placeholder="Write your problem" maxlength="140" rows="7"></textarea>         
                                        </div>
                                        <input type="submit" class="btn btn-blue btn-block" value="Submit">
                                    <?php echo form_close();?>
                                </div>


                                <!-- / tabs_item -->
                                <div class="tabs_item">
                                    <?php 
                                        $attributes = array('name'=>'register_form', 'onsubmit'=>'return validateregister()');
                                        echo form_open_multipart('Api/registration', $attributes); 
                                    ?>

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
                                            <input type="text" class="form-control" id="full_name" name="name" value="<?php echo set_value('name')?>" placeholder="Full Name" required>
                                            <span class="text-danger"><?php echo form_error('name'); ?> </span>
                                        </div>

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                                            <input type="text" class="form-control" name="phone" id="phone" value="<?php echo set_value('phone')?>" placeholder="Mobile Number" required>
                                            <span class="text-danger"><?php echo form_error('phone'); ?> </span>
                                        </div>

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                        </div>

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" class="form-control" name="birth_date" id="datepicker2" placeholder="Birth Date" required>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Gender </label>
                                            <label class="radio-inline"> 
                                                <input type="radio" value="Male" name="gender" required>Male
                                            </label>
                                            <label class="radio-inline"> 
                                                <input type="radio" value="Female" name="gender" required>Female
                                            </label> 
                                        </div>
                                       
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-bold"></i></span>
                                            <select class="form-control" name="blood_group" id="blood_group">
                                                <option value=''>--Select Blood Group--</option>
                                                <option value='A+'>A+</option>
                                                <option value='A-'>A-</option>
                                                <option value='B+'>B+</option>
                                                <option value='B-'>B-</option>
                                                <option value='O+'>O+</option>
                                                <option value='O-'>O-</option>
                                                <option value='AB+'>AB+</option>
                                                <option value='AB-'>AB-</option>
                                                <option value='Unknown'>Unknown</option>
                                            </select>
                                        </div>

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="file" class="form-control" name="picture" id="picture">
                                        </div>

                                        <div class="form-group">
                                            <textarea class="form-control"  id="address" name="address" placeholder="Address" maxlength="140" rows="7"></textarea>         
                                        </div>
                                        
                                        <input type="submit" id="submit2" name="submit2" class="btn btn-blue btn-block" value="Submit Form">

                                    <?php echo form_close();?>
                                </div>
                                <!-- / tabs_item -->
                            </div>
                            <!-- / tab_content -->
                        </div>
                        <!-- / tab -->
                    </div>
                </div>
            </div>
        </section>

                                                    

        <script src="<?php echo base_url();?>web_assets/js/jquery-min.js"></script>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
        <!-- Scrolling Nav JavaScript --> 
        <script src="<?php echo base_url();?>web_assets/js/jquery.easing.min.js"></script>
        <script src="<?php echo base_url();?>web_assets/js/scrolling-nav.js"></script>
        <script src="<?php echo base_url();?>web_assets/js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>web_assets/plugins/owl-carousel/owl.carousel.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>web_assets/js/custom.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>web_assets/js/api_footer.js" type="text/javascript"></script>
        


    </body>
</html>
  













