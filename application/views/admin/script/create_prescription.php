
    <script type="text/javascript">
        function loadName(){
    'use strict';          
        var patient_id = document.getElementById('p_id').value;

        if (patient_id!='') {
            $.ajax({ 

                'url': '<?php echo base_url();?>' + 'admin/Ajax_controller/load_patient_info/'+patient_id.trim(),
                'type': 'GET',
                'dataType': 'JSON',
                'success': function(data){ 
                        //$(".had").hide();
                        document.getElementById("ptname").textContent=data.patient_name;
                        document.getElementById("ptage").textContent=data.age;
                        document.getElementById("ptsex").textContent=data.sex;
                        document.getElementById("ptid").textContent=data.patient_id;
                        document.getElementsByName("patient_id")[0].value=data.patient_id;

                       
                    
                }
            });
        }else{
            $(".had").show();
            $(".p_name").hide();
        };
    }
        $(document).ready(function(){

            'use strict';

            var base_url = $('#base_url').val();
            var maxField = 50; 
            var addButton = $('.add_button'); 
            var wrapper = $('.field_wrapper');
           
            var x = 1; 
            var counter = 2;
            $(addButton).on('click',function(){ 
                if(x < maxField){ 
                    var fieldHTML = '<div id="count_'+(counter++)+'">'+
                    '<div class="form-group mdcn">'+
                    '<div class="col-md-1" >'+
                    '<input type="text"  class="form-control" name="type[]"  placeholder="<?php echo display('type')?>"  />'+
                    '</div>'+ 
                     '<div class="col-md-3">'+
                     '<input type="hidden" class="mdcn_value" name="medicine_id[]" value="" />'+
                     '<input type="text"  class="mdcn_name form-control" name="md_name[]"  placeholder="<?php echo display('medicine_name')?>" autocomplete="off" required />'+
                     '<div  id="suggestion-box"></div>'+
                     '</div>'+
                     '<div class="col-md-2"><input type="text"  class="form-control "  placeholder="<?php echo display('mgml')?>" name="mg[]" value=""/></div>'+ 
                     '<div class="col-md-1"><input type="text"  class="form-control"  placeholder="<?php echo display('dose')?>" name="dose[]" /></div>'+
                     '<div class="col-md-1"><input type="text"  class="form-control"  placeholder="<?php echo display('day')?>" name="day[]" /></div>'+
                     '<div class="col-md-3"><input type="text"  class="form-control"  placeholder="<?php echo display('medicine_comment')?>" name="comments[]" /></div>'+ 
                   
                    '<a href="javascript:void(0);" class="btn btn-danger remove_button" title="Remove field"><span class="glyphicon glyphicon-trash"></span></a></div>'+
                    '</div>';  

                    x++; 
                    $(wrapper).append(fieldHTML); 
                }
            });
        
        $('#medicine_name').autocomplete({
            source: '/admin/Ajax_controller/medicine_selection/',
            minLength: 2,
            select: function(event, ui) {
                $('#medicine_name').val(ui.item.label);
                $('#medicine_value').val(ui.item.value);
                return false;
            },
            focus: function(event, ui) {
                $('#medicine_name').val(ui.item.label);
                return false; 
            }
        });
 

        $('body').on('click','#country-list > li',function(){
            var mdcn_name_val = $(this).val();
            var mdcn_name_txt = $(this).text();

            var target_val = $(this).parent().parent().prev().prev(); 
            var target_text = $(this).parent().parent().prev(); 

            $(target_val).val(mdcn_name_val); //value passing
            $(target_text).val(mdcn_name_txt); //value passing

            $(this).parent().slideUp(300); 
        });

        $(wrapper).on('click', '.remove_button', function(e){ 
            e.preventDefault();
            $(this).parent('div').remove(); 
            x--; 
        });


        });


        //<!-- ============================================= -->
        //<!-- test info -->
        //<!-- ============================================= -->
   
        $(document).ready(function(){
            'use strict';

            var base_url = $('#base_url').val();

            var maxField = 50; 
            var testButton = $('.add_button1'); 
            var wrapper = $('.field_wrapper1'); 
            var counter = 2;
            var x = 1; 

            $(testButton).click(function(){ 
                if(x < maxField){
                  var fieldHTML = '<div id="count_test'+(counter++)+'">'+
                '<div class="form-group ">'+
                 '<div class="col-md-5">'+
                 '<input type="hidden" class="test_value" name="test_name[]" value="" />'+
                 ' <input placeholder="<?php echo display('test_name')?>" class="test_name form-control" name="te_name[]" autocomplete="off"  >'+
                 ' <div id="test-box"></div>'+
                 '</div>'+
                 '<div class="col-md-5"> <input placeholder="Description" name="test_description[]" class="form-control"  rows="2"></div>'+
                
               '<a href="javascript:void(0);" class="btn btn-danger remove_button" title="Remove field"><span class="glyphicon glyphicon-trash"></span></a></div>'+
                '</div>';

                  $(wrapper).append(fieldHTML);
                }

            });

            $('table').on('keyup',".test_name",function(){  
                var output = $(this).next(); 
                $.ajax({
                    type: "GET",
                    url: base_url + 'admin/Ajax_controller/test_sajetion/',
                    data:'keyword='+$(this).val(),
                    success: function(data){ 
                        $(output).html(data); 
                    } 
                });
            });
        
            $('body').on('click','#country-list > li',function(){
                var test_name_val = $(this).val();
                var test_name_txt = $(this).text();

                var target_val = $(this).parent(); 
                var target_text = $(this).parent(); 

                $(target_val).val(test_name_val); //value passing
                $(target_text).val(test_name_txt); //value passing
                $(this).parent().slideUp(300); 
            });


            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent('div').remove();
                x--; 
            });
        });


        //<!-- ========================================= -->
        //<!--  advice info -->
        //<!-- ========================================= -->

        $(document).ready(function(){
            'use strict';

            var base_url = $('#base_url').val();
            var maxField = 50; 
            var add_advice = $('.add_advice'); 
            var wrapper = $('.field_wrapper2'); 
            var counter = 2;
            var x = 1; 

            $(add_advice).click(function(){ 
                if(x < maxField){
                  var fieldHTML = '<div id="count_add'+(counter++)+'">'+
                '<div class="form-group ">'+
                 '<div class="col-md-10">'+
                 '<input type="hidden" class="advice_value" name="advice[]" value="" />'+
                 ' <input placeholder="Advice" class="advice_name form-control" name="adv[]" autocomplete="off">'+
                 ' <div style="position:absolute;z-index:9999;" id="advice-box"></div>'+
                 '</div>'+
                
               '<a href="javascript:void(0);" class="btn btn-danger remove_button" title="Remove field"><span class="glyphicon glyphicon-trash"></span></a></div>'+
                '</div>';

                  $(wrapper).append(fieldHTML);
                }

            });

            $('table').on('keyup',".advice_name",function(){  
                var output = $(this).next(); 
                $.ajax({
                    type: "GET",
                    url: base_url + 'admin/Ajax_controller/advice_sajetion/',
                    data:'keyword='+$(this).val(),
                    success: function(data){ 
                        $(output).html(data); 
                    } 
                });
            });
        
            $('body').on('click','#country-list > li',function(){
                var advice_name_val = $(this).val();
                var advice_name_txt = $(this).text();

                var target_val = $(this).parent(); 
                var target_text = $(this).parent(); 

                $(target_val).val(advice_name_val); //value passing
                $(target_text).val(advice_name_txt); //value passing
                $(this).parent().slideUp(300); 
            });


            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent('div').remove();
                x--; 
            });
        });
    </script>
