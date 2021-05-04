
        // load patient name
        'use strict';
        function load_patient_id(){          
            var pat_id = document.getElementById('pat_id').value;
            var base_url = $("#base_url").val();
            if (pat_id!='') {            
                $.ajax({ 
                    'url': base_url + 'admin/Ajax_controller/get_patinet_id/'+pat_id.trim(),
                    'type': 'GET', //the way you want to send data to your URL
                    'data': {'pat_id': pat_id },
                    'success': function(data) { 
                        var container = $(".p_id");
                        if(data==0){
                            container.html("<div class='text-success'><span class='glyphicon glyphicon-ok'></span> Your id is available</div>");
                            $('input[type=submit]').prop('disabled', false);
                        }else{ 
                            container.html(data);
                            $('input[type=submit]').prop('disabled', true);
                        }
                    }
                });
            };
        }


       // validation
       'use strict';
        function validateForm() {
            var patient_id = document.forms["app_form"]["patient_id"].value;
            var date = document.forms["app_form"]["date"].value;
            var sequence = document.forms["app_form"]["sequence"].value;
            var venue_id = document.forms["app_form"]["venue_id"].value;
            if (patient_id && date && sequence && venue_id == null || patient_id && date && sequence && venue_id  == "") {
                alert("Fild must be filled out");
                return false;
            }
        }

        // load patient name
        'use strict';
        function loadName(){          
           var patient_id = $('#patient_id').val();
           var base_url = $("#base_url").val();
            if (patient_id!='') {
                $('input[type=submit]').prop('disabled', true);
                $.ajax({ 
                    'url': base_url + 'admin/Ajax_controller/get_patinet_name/'+patient_id.trim(),
                    'type': 'GET', //the way you want to send data to your URL
                    'data': {'patient_id': patient_id },
                    'success': function(data) { 
                        var container = $(".p_name");
                        if(data==0){
                            container.html("Didn't match. Please Enter Your Valid Id.");
                        }else{ 
                            container.html(data);
                            $('input[type=submit]').prop('disabled', false);
                        }
                    }
                });
            };
        }

        // load load schedul
        'use strict';
        function loadSchedul(){
            //alert('hello3...');
            var venue_id = $('#venue_id').val();

			var doctor_id = $('#doctor_id').val();
			
            var date     = $('.datepicker3').val();
				
            var base_url = $("#base_url").val();
			
            //alert(doctor_id);
			
            if (venue_id!='') {
                $.ajax({ 
                    'url': base_url + 'admin/Ajax_controller/get_schedul/'+venue_id+'/'+date+'/'+doctor_id,
                    'type': 'GET', 
                    'data': {'patient_id': venue_id },
                    'success': function(data) {
                        var container = $(".schedul1");
                        container.html(data);
                    }
                    });
                };
        } 

        // myBooking sequence
        'use strict';
        function myBooking(data){
           var id = $("#t_" + data).text();
           document.getElementById("msg_c").innerHTML = "<div style=' color:green; font-size:20px;'> You Selected " +id +" </div>";
           document.getElementById('serial_no').value = id;        
        } 

        // load slider
        'use strict';
        function view_slider(id){ 
            var base_url = $("#base_url").val();
            $.ajax({
                url : base_url+"Welcome/slider_by_id/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('#title').html(data.heading);
                    $('#details').html(data.details);
                    $('#pic').html('<img src="' + data.picture + '" class="img-responsive" />');
                    $('#modal_form').modal('show'); 
                  
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        'use strict';
        function view_post(id){
            var base_url = $("#base_url").val();
            //Ajax Load data from ajax
            $.ajax({
                url : base_url+"Welcome/post_by_id/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('#title').html(data.title);
                    $('#details').html(data.details);
                    $('#pic').html('<img src="' + data.picture + '" />');
                    $('#modal_form').modal('show'); 
                  
                },

                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data');
                }
            });
        }

     