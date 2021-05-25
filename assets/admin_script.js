function loadePattern(pattern){
    'use strict';
    var base_url = $("#base_url").val();
   
    $.ajax({
        'url': base_url + 'admin/Ajax_controller/patternSetDataEdit/'+pattern,
        'type': 'GET',
        'dataType': 'JSON',
        'success': function(data)
        {
            $('[name="h_height"]').val(data.header_height);
            $('[name="h_width"]').val(data.header_width);
            $('[name="f_height"]').val(data.footer_height);
            $('[name="f_width"]').val(data.footer_width);
            $('[name="content1_height"]').val(data.content_height_1);
            $('[name="content1_width"]').val(data.content_width_1);
            $('[name="content2_height"]').val(data.content_height_2);
            $('[name="content2_width"]').val(data.content_width_2);
        },
        'error': function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}




// add medicine
    $(document).ready(function(){

        'use strict';

        $("#search-box").on('keyup',function(){
            var base_url = $("#base_url").val();
            $.ajax({
            type: "GET",
            url: base_url + 'admin/Ajax_controller/Company_sajetion/',
            data:'keyword='+$(this).val(),
            beforeSend: function(){
                $("#search-box").css("background","#FFF url(<?php echo base_url();?>image/LoaderIcon.gif) no-repeat 165px");
            },
                success: function(data){
                    $("#suggestion-box").show();
                    $("#suggestion-box").html(data);
                    $("#search-box").css("background","#FFF");
                }
            });
        });
  

        $('body').on('click','#country-list > li',function(){
            $("#search-box").val($(this).html());
            $("#search-company_id").val($(this).val());
            $("#country-list").slideUp(300);
        });
   

        //<!-- Group Sajetion -->
        $("#search-group").on('keyup',function(){

            var base_url = $("#base_url").val();

            $.ajax({
            type: "GET",
            url: base_url + 'admin/Ajax_controller/group_sajetion/',
            data:'keyword='+$(this).val(),
            beforeSend: function(){
                $("#search-group").css("background","#FFF url(<?php echo base_url();?>image/LoaderIcon.gif) no-repeat 165px");
            },
                success: function(data){
                    $("#suggesstion-group").show();
                    $("#suggesstion-group").html(data);
                    $("#search-group").css("background","#FFF");
                }
            });
        });

        $('body').on('click','#group-list >',function(){
            $("#search-group").val($(this).html());
            $("#search-group_id").val($(this).val());
            $("#group-list").slideUp(300);
        });
    });



    function EditTestName(id){
        'use strict';
        var base_url = $("#base_url").val();
        $.ajax({ 
            'url': base_url + 'admin/Disease_test_controller/edit_test_name/'+id,
            'type': 'GET', 
            'data': {'test_id': id },
            'success': function(data) {
                var container = $(".viewEditModal");
                container.html(data);
            }
        });    
    }
    
// end add medicine




    function sms_send(id){
        var base_url = $("#base_url").val();
        //Ajax Load data from ajax
        $.ajax({
            url : base_url+"admin/Ajax_controller/getInfo/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                 $('[name="to"]').val(data.patient_phone);
                 $('[name="name"]').val(data.patient_name);
                 $('[name="patient_id"]').val(data.patient_id);
                 $('[name="appointment_id"]').val(data.appointment_id);
                 $('[name="appointment_date"]').val(data.date);
                 $('[name="sequence"]').val(data.sequence);
                 $('[name="doctor_name"]').val(data.doctor_name);
                 $('[name="per_patient_time"]').val(data.per_patient_time);
                 $('[name="start_time"]').val(data.start_time);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('SMS'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }


    function reload()
    {
        table.ajax.reload(null,false); //reload datatable ajax 
    }


    function save(){

        var base_url = $("#base_url").val();
        $('#btnSave').text('Sending...'); 
        $('#btnSave').attr('disabled',true);

        var url = base_url+"admin/Ajax_controller/sendSms";
        // ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data){
                if(data.status) //if success close modal and reload ajax table
                {
                    
                    $('#modal_form').modal('hide');
                     toastr.success('Success! - Sms Send Successful');
                        
                    setTimeout(function(){
                        window.location.href = window.location.href;
                    }, 2000);
                }

                $('#btnSave').text('Send'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
            },

            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error!');
                $('#btnSave').text('Send'); 
                $('#btnSave').attr('disabled',false); 
            }
        });
    }


    // birth_date convirt
    'use strict';
    $(document).ready(function(){
        $("#old").on('keyup',function(){
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

