<footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="footer_content">
                        <div class="logo_menu">
                            <span><a href="https://telehealers.in/"><img src="<?php echo get_field('header_logo', 'options'); ?>" alt="Logo"/></a></span>
                            <ul>
                            <?php
                            $WCols = get_field('footer_menu', 'options');
                            foreach($WCols as $WColsItems){
                            ?>
                            <li>
                                <a href="<?php echo $WColsItems['menu_link']; ?>"><?php echo $WColsItems['menu_name']; ?></a>
                            </li>
                        <?php } ?>
                            </ul>
                        </div>
                        <div class="footer_copyright">
                            <span class="copyright"><?php echo get_field('footer_copyright', 'options'); ?></span>
                            <span class="like_ecom"><?php //echo get_field('footer_address', 'options'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

<?php wp_footer(); ?>

<script src="<?php echo bloginfo('stylesheet_directory'); ?>/assets/js/jquery.js"></script>
<script src="<?php echo bloginfo('stylesheet_directory'); ?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo bloginfo('stylesheet_directory'); ?>/assets/js/main.js"></script>	
<script src="<?php echo bloginfo('stylesheet_directory'); ?>/assets/js/all.min.js"></script>

</body>
</html>