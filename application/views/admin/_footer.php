            <?php 
                $result = $this->db->select('*')->from('web_pages_tbl')->where('name','copy_right')->where('status',1)->get()->row();
            ?>

            <footer class="main-footer">
               <p><?php echo htmlspecialchars_decode(@$result->details);?></p>
            </footer>
        </div>

	<input type="hidden" id="base_url" value="<?php echo base_url()?>">
        <input type="hidden" id="segment1" value="<?php echo $this->uri->segment(1); ?>">
        <input type="hidden" id="segment2" value="<?php echo $this->uri->segment(2); ?>">
        <input type="hidden" id="segment3" value="<?php echo $this->uri->segment(3); ?>">
		

        <!-- jquery-ui --> 
        <script src="<?php echo base_url()?>assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- lobipanel -->
        <script src="<?php echo base_url()?>assets/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
        <!-- FastClick -->
        <script src="<?php echo base_url()?>assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
        <!-- AdminBD frame -->
        <script src="<?php echo base_url()?>assets/dist/js/frame.min.js" type="text/javascript"></script>
        <!-- Toastr js -->
        <script src="<?php echo base_url()?>assets/plugins/toastr/toastr.min.js" type="text/javascript"></script>
        <!-- Sparkline js -->
        <script src="<?php echo base_url()?>assets/plugins/sparkline/sparkline.min.js" type="text/javascript"></script>
       
        <!-- summernote js -->
        <script src="<?php echo base_url()?>assets/plugins/summernote/summernote.min.js" type="text/javascript"></script>
        <!-- Dashboard js -->
        <script src="<?php echo base_url()?>assets/dist/js/dashboard.min.js" type="text/javascript"></script>
         <!-- datatable -->
        <script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.min.js" type="text/javascript"></script> 
        <script src="<?php echo base_url();?>assets/plugins/datatables/dataTables_custom.min.js" type="text/javascript"></script>   
        <!-- Custom Theme JavaScript -->
        <script src="<?php echo base_url()?>assets/custom.js" type="text/javascript"></script>
        <!-- date time picker -->
        <script src="<?php echo base_url()?>assets/plugins/ui-datetimepicker/jquery-ui-timepicker-addon.js"></script>
        <script src="<?php echo base_url()?>assets/plugins/ui-datetimepicker/jquery-ui-sliderAccess.js"></script>
		<!--<script src="//jonthornton.github.io/jquery-timepicker/jquery.timepicker.js"></script>-->
        

    </body>
</html>