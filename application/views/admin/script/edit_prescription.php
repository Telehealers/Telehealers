<script type="text/javascript">
    // load patient name
    function loadName(){ 
        'use strict';         
        var patient_id = document.getElementById('p_id').value;
        var base_url = $("#base_url").val();
        if (patient_id!='') {
            $.ajax({ 

                'url': base_url + 'admin/Ajax_controller/load_patient_info/'+patient_id.trim(),
                'type': 'GET',
                'dataType': 'JSON',
                'success': function(data){ 
                    $('[name="name"]').val(data.patient_name);
                    $('[name="phone"]').val(data.patient_phone);
                    $('[name="birth_date"]').val(data.birth_date);
                    $('[name="patient_id"]').val(data.patient_id);

                var container = $("#ab");
                    if(data==0){
                        container.html("<div class='alert alert-success'><span class='glyphicon glyphicon-ok'></span> <strong>Your id is available</strong></div>");
                    }else{ 
                        container.html(data);
                    }
                }
            });
        }else{
            $(".had").show();
            $(".p_name").hide();
        };
    }

        // =========================================== -->
        // medicine info -->
        // ===========================================-->
        'use strict';
        $(document).ready(function(){
            var maxField = 50; 
            var addButton = $('.add_button'); 
            var wrapper = $('.field_wrapper');
            var x = 1; 
            var counter = 2;
            $(addButton).click(function(){ 
                if(x < maxField){ 
                    var fieldHTML = '<div id="count_'+(counter++)+'">'+
                    '<div class="form-group mdcn">'+
                    '<div class="col-md-1">'+
                    '<input type="text"  class="form-control" name="type[]"  placeholder="<?php echo display('type')?>"  />'+
                    '</div>'+ 
                     '<div class="col-md-3">'+
                     '<input type="hidden" class="mdcn_value" name="medicine_id[]" value="" />'+
                     '<input type="text"  class="mdcn_name form-control" name="md_name[]"  placeholder="<?php echo display('medicine_name')?>" autocomplete="off" required />'+
                     '<div id="suggesstion-box"></div>'+
                     '</div>'+

                     
                     '<div class="col-md-2"><input type="text"  class="form-control "  placeholder="<?php echo display('mgml')?>" name="mg[]" value=""/></div>'+ 
                     '<div class="col-md-1"><input type="text"  class="form-control"  placeholder="<?php echo display('dose')?>" name="dose[]" /></div>'+
                     '<div class="col-md-1"><input type="text"  class="form-control"  placeholder="<?php echo display('day')?>" name="day[]" /></div>'+
                     '<div class="col-md-3"><input type="text"  class="form-control"  placeholder="<?php echo display('medicine_comment')?>" name="comments[]" /></div>'+ 
                   
                    '<a href="javascript:void(0);" class=" btn btn-danger remove_button" title="Remove field"><span class="glyphicon glyphicon-trash"></span></a></div>'+
                    '</div>';  

                    x++; 
                    $(wrapper).append(fieldHTML); 
                }
            });


        $('table').on('keyup',".mdcn_name",function(){  
            var output = $(this).next(); 
            var base_url = $("#base_url").val();
            $.ajax({
            'type': 'GET',
            url: base_url + 'admin/Ajax_controller/medicine_sajetion/',
            data:'keyword='+$(this).val(),
                success: function(data){ 
                    $(output).html(data); 
                }
            });
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

        // ============================================= -->
                        // test info -->
        // ============================================= -->
        'use strict';
        $(document).ready(function(){

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
                 '<div class="col-md-5"> <input placeholder="<?php echo display('description')?>" name="test_description[]" class="form-control"  rows="2"></div>'+
                
               '<a href="javascript:void(0);" class=" btn btn-danger remove_button" title="Remove field"><span class="glyphicon glyphicon-trash"></span></a></div>'+
                '</div>';

                  $(wrapper).append(fieldHTML);
                }

            });

            $('table').on('keyup',".test_name",function(){ 
                var base_url = $("#base_url").val(); 
                var output = $(this).next(); 
                $.ajax({
                   'type': 'GET',
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
  

        // ========================================= -->
        //  advice info -->
        // ========================================= -->
        'use strict';
        $(document).ready(function(){
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
                 ' <input placeholder="<?php echo display('advice')?>" class="advice_name form-control" name="adv[]" autocomplete="off">'+
                 ' <div style="position:absolute;z-index:9999;" id="advice-box"></div>'+
                 '</div>'+
                
               '<a href="javascript:void(0);" class=" btn btn-danger remove_button" title="Remove field"><span class="glyphicon glyphicon-trash"></span></a></div>'+
                '</div>';

                  $(wrapper).append(fieldHTML);
                }
            });

            $('table').on('keyup',".advice_name",function(){ 
                var base_url = $("#base_url").val(); 
                var output = $(this).next(); 
                $.ajax({
                    'type': 'GET',
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
  
    // age to birth date convert
    'use strict';
    $(document).ready(function(){
        $("#age").keyup(function(){
           var age = (this.value);
           var base_url = $("#base_url").val();
           if(age !==''){
              $.ajax({
                    'url': base_url + 'admin/Ajax_controller/age_to_birthdate/'+age.trim(),
                    'type': 'GET', 
                    'data': {'age': age },
                    'success': function(data) { 
                        var container = $(".birth_date");
                        if(data==0){
                            container.val("0000-00-00");
                        }else{ 
                            container.val(data); 
                        }
                    }
                });
            }

        });
    })

</script>