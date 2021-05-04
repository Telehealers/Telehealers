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
        <!-- style -->
        <link href="<?php echo base_url(); ?>assets/public_css/style2.css" rel="stylesheet">

        <script src="<?php echo base_url(); ?>web_assets/js/print_preview.js"></script>
    </head>  

<body>


<div class="container" >
      <div class="row top1-bar">
          <div class="social-icons pull-right">
              <ul>
                  <li><a href="" onclick="printContent('div1')" title="Print">Print</a></li>
              </ul>
          </div> 
      </div>
  </div>

 <div id="div1">

      <div class="container" >
          <div class="row top-bar">
              <div class="left-text pull-left">
                  <p><?php echo date("Y-m-d h:i:s");?></p>
              </div>  
          </div>
      </div>
		

	
      <div class="container header text-white">
        <a href="<?php echo base_url();?>"><img  src="<?php echo (!empty(html_escape($info->logo->picture))?html_escape($info->logo->picture):null); ?>" ></a>
      </div>

		
				<div class="container">
         <table class="table table-bordered">
         
          <tbody>
            <tr>
              <td>Patient Name</td>
              <td><?php echo html_escape($patient->patient_name)?></td>
             
            </tr>
            <tr>
              <td>Appointment Id </td>
              <td><?php echo html_escape($payment_info->appointment_id)?></td>
              
            </tr>
            <tr>
              <td >Payment amount</td>
              <td><?php echo html_escape($payment_info->amount)?></td>
            </tr>
          </tbody>
        </table>


          <div class="alert alert-success">
            <p class="text-success">Success! We have received your payment. Thanks for your payment via paypal</p>
          </div>
        </div>
		

			<div class="container inners">
         
			</div> 

		</div>
		
	</body>
</html>