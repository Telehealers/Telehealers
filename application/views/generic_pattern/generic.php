<!DOCTYPE html>
    <html lang="en">
    <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title> Generic </title>
            <!-- Bootstrap -->
           <link href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
         
            <!-- style -->
            <link href="<?php echo base_url(); ?>web_assets/css/bootstrap.min.css" rel="stylesheet">
            <script src="<?php echo base_url(); ?>web_assets/js/jquery-min.js"></script>
            
            <!-- dynamic style -->
            <?php require 'style-default.php';?>
            <?php require 'style-1.php';?>
            <?php require 'style-2.php';?>
            <!-- end style -->
            
            <!-- print_preview js -->
            <script src="<?php echo base_url(); ?>web_assets/js/print_preview.js"></script>

    </head>

    <body>
        <div class="container">
            <div id="default">
                <?php echo htmlspecialchars_decode(@$default);?>
            </div>

            <div id="others">
                <?php if(@$others!=NULL){
                        echo htmlspecialchars_decode(@$others);
                    }else{
                        echo "<div class='alert alert-danger'>There have no setup print pattern.</div>";
                    }
                ?>
            </div>
        </div>
     </body>
</html>

