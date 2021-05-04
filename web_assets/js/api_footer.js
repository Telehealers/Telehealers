            
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
        var base_url = $("#base_url").val();
        var patient_id = $('#patient_id').val();
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
    function loadSchedul(){		//alert('here2...');
        var venue_id = $('#venue_id').val();
        var date     = $('#date').val();

        var base_url = $("#base_url").val();
        
        if (venue_id!='') {
            $.ajax({ 
                'url': base_url + 'admin/Ajax_controller/get_schedul/'+venue_id+'/'+date,
                'type': 'GET', //the way you want to send data to your URL
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
       document.getElementById("msg_c").innerHTML = "<div style=' color:green; font-size:20px;'>Hai scelto " +data +"</div>";
       document.getElementById('serial_no').value = data;        
    } 

    // Wait for window load
    'use strict';
    $(window).load(function() {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");;
    });
