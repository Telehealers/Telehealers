<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
 
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->  
  <link rel="stylesheet" href="<?php echo bloginfo('stylesheet_directory'); ?>/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo bloginfo('stylesheet_directory'); ?>/assets/css/main.css">
</head>

<body>
<header class="header">
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-8">
                        <div class="top_content">
                            <p><a href="mailto:info@telehealers.in"><?php echo get_field('header_email', 'options'); ?></a></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-4">
                        <div class="top_social">
                            <ul>
                                <li>
                                    <a href="<?php echo get_field('linkedin', 'options'); ?>" target="blank"><i class="fab fa-linkedin-in"></i></a>
                                </li>
                                <li>
                                    <a href="<?php echo get_field('twitter', 'options'); ?>" target="blank"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="<?php echo get_field('instagram', 'options'); ?>" target="blank"><i class="fab fa-instagram"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="menubar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="navbar navbar-expand-md">
                            <div class="container-fluid">
                                <a class="navbar-brand" href="https://telehealers.in/">
                                    <img src="<?php echo get_field('header_logo', 'options'); ?>" alt="Logo" />
                                </a>
                                <div class="buttonmenu">
                                    <input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
                                    <label for="openSidebarMenu" class="sidebarIconToggle">
                                      <div class="spinner diagonal part-1"></div>
                                      <div class="spinner horizontal"></div>
                                      <div class="spinner diagonal part-2"></div>
                                    </label>
                                </div>
                                <div class="main_menu_custom" id="custom_menu">
                                    <ul class="navbar-nav ml-auto ">
                                    <?php
                                        $WCols = get_field('header_menu','options');
                                        foreach($WCols as $WColsItems){
                                    ?>
                                    <li>
                                        <a href="<?php echo $WColsItems['h_menu_link']; ?>"><?php echo $WColsItems['h_menu_name']; ?></a>
                                    </li>
                                    <?php } ?> 
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
