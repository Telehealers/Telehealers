<?php
   // date_default_timezone_set(@$info->timezone->details);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo (!empty(html_escape($info->website_title->details))?html_escape($info->website_title->details):null); ?></title>
        <link rel="icon" href="<?php echo (!empty(html_escape($info->fabicon->picture))?html_escape($info->fabicon->picture):null); ?>" sizes="16x16">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        
        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>web_assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- flaticon -->
        <link href="<?php echo base_url(); ?>web_assets/public_css/css/flaticon.css" rel="stylesheet">
         <link href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
         <!-- style -->
        <link href="<?php echo base_url(); ?>assets/public_css/style2.css" rel="stylesheet">
        <!-- print preview js -->
        <script src="<?php echo base_url(); ?>web_assets/js/print_preview.js"></script>
        <!-- style -->
        <link href="<?php echo base_url(); ?>web_assets/css/inline.css" rel="stylesheet">


</head>


<body>
<div class="row" style="text-align:center;">

    <div class="col-lg-12">
        <h2>APPOINTMENT DETAILS:</h2>                 
    </div>
</div><!-- /.row -->

<div class="row" style="text-align:center;">
    <div class="col-lg-12">
        <?php if(!empty($this->session->flashdata('msg'))){ ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('msg'); ?>
            </div>        
        <?php } ?>
        <?php if(validation_errors()) { ?>
          <div class="alert alert-danger">
            <?php echo validation_errors(); ?>
          </div>
        <?php } ?>
    </div>
</div>

    <div class="row" style="text-align:center;">  
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
	&nbsp;
	</div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">                        
            <table class="table table-bordered table-hover table-striped print-table order-table" style="font-size:11px;">
                <tbody>                    
                    <tr>
                        <td class="text-left">Appointment ID</td>
                        <td class="text-left"><?php echo $info->appointment_id;?></td>               
                    </tr>
<tr>
                        <td class="text-left">Patient ID</td>
                        <td class="text-left"><?php echo $info->patient_id;?></td>               
                    </tr>
<tr>
                        <td class="text-left">Venue Name</td>
                        <td class="text-left"><?php echo $itemInfo['venue_name'];?></td>               
                    </tr>
					<tr>
                        <td class="text-left">Venue Contact</td>
                        <td class="text-left"><?php echo $itemInfo['venue_contact'];?></td>               
                    </tr>
					<tr>
                        <td class="text-left">Venue Address</td>
                        <td class="text-left"><?php echo $itemInfo['venue_address'];?></td>               
                    </tr>
<tr>
                        <td class="text-left">Doctor Name</td>
                        <td class="text-left"><?php echo $itemInfo['doctor_name'];?></td>               
                    </tr>
					<tr>
                        <td class="text-left">Appointment Date</td>
                        <td class="text-left"><?php echo $info->date;?></td>               
                    </tr>
<tr>
                        <td class="text-left">Appointment Time</td>
                        <td class="text-left"><?php echo $info->sequence;?></td>               
                    </tr>
<tr>
                        <td class="text-left">Patient CC</td>
                        <td class="text-left"><?php echo $info->problem;?></td>               
                    </tr>
					<?php if($info->service!="Consultation for COVID-19"){?>	
					<tr>
                        <td class="text-left">Fees</td>
                        <td class="text-left"><?php echo $itemInfo['price'];?> INR</td>       
                    </tr>
					<?php } ?>
					
                </tbody>                        
            </table>
        </div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
	&nbsp;
	</div>
    </div>

    <div class="row" style="text-align:center;">
        <div class="col-lg-12">
            <a href="<?php print site_url();?>" name="reset_add_emp" id="re-submit-emp" class="btn btn-warning"><i class="fa fa-mail-reply"></i> Back</a>
            <input  id="submit-pay" type="submit" onclick="razorpaySubmit(this);" value="Pay Now" class="btn btn-primary" />
        </div>
    </div>



	</body>

</html>