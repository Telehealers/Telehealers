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
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- flaticon -->
        <link href="<?php echo base_url(); ?>assets/public_css/css/flaticon.css" rel="stylesheet">
        <!-- font-awesome -->
         <link href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- style -->
        <link href="<?php echo base_url(); ?>assets/public_css/style2.css" rel="stylesheet">
    
</head>  

<body>



<div id="div1">

     <div class="container" >
          <div class="row top-bar">
              <div class="left-text pull-left">
                  <p><?php echo date("Y-m-d h:i:s");?></p>
              </div>  
          </div>
      </div>
		
	
      <div class="container header" >
        <div style="">
            <a href="<?php echo base_url();?>"><img  src="<?php echo (!empty(html_escape($info->logo->picture))?html_escape($info->logo->picture):null); ?>" ></a>
        </div>
      </div>

		
				<div class="container">
          <p class="text-danger">Sorry!</p>
          <p class="text-danger">We did not recive your payment. It's may be error or thre is not enough money of your account.</p>
        </div>
		

			<div class="container inners">
         <div>
         Pay with paypal
              <a target="_blank" href="<?php echo base_url();?>">
              <img  src="<?php echo base_url()?>assets/images/paypal.png" class="img-responsive" ></a>
        </div>
			</div> 
		</div>
		
	</body>
</html>