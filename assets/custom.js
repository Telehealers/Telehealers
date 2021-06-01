$(document).ready(function () {

'use strict';

$(".se-pre-con").fadeOut("slow");

//summernote
$('#summernote').summernote({
    height: 300, // set editor height
    minHeight: null, // set minimum height of editor
    maxHeight: null, // set maximum height of editor
    focus: true                  // set focus to editable area after initializing summernote
});

// tiemt picker
   $('#basic_example_1').timepicker();
    
   $('#basic_example_2').timepicker();

//date picker
    $(".datepicker1").datepicker(
        {
            dateFormat: 'yy-mm-dd',
            showMonths: true,
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0"
    });


    $(".datepicker2").datepicker({dateFormat: 'yy-mm-dd'});

    $(".datepicker3").datepicker(
    {
    showOtherMonths: true,
    selectOtherMonths: true,
    dateFormat: 'yy-mm-dd',
    minDate: 0,
	
    });

 
});


    // patient information print
    function printContent(el){
        'use strict';
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }


	


$(document).ready(function(){
        
    'use strict';

    $("#age").on('keyup',function(){

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

	


    $("#old").on('keyup',function(){

            var base_url = $('#base_url').val();
            var age = (this.value);
            var url = base_url + 'admin/Ajax_controller/age_to_birthdate/'+age;
         
          
           if(age !==''){
            $.ajax({
                'url': base_url + 'admin/Ajax_controller/age_to_birthdate/'+age,
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


function js_value(str)
{
    'use strict';
    var teamplate_name = $("#t_" + str).text();
    var teamplate = $("#td_" + str).text();
    $("#id").val(str);
    $("#template_name").val(teamplate_name);
    $("#teamplate").val(teamplate);
    $(".tit").text('SMS Template Setup');
    $("#MyForm").attr("action", 'template_edit');
    $(".sav_btn").text('Update');
}


// load patient name
function load_patient_id(){  
    'use strict'; 
    var base_url = $("#base_url").val();       
    var patient_id = document.getElementById('patient_id').value;
    if (patient_id!='') {
        
        $.ajax({ 
            'url': base_url + 'admin/Ajax_controller/get_patinet_id/'+patient_id.trim(),
            'type': 'GET', //the way you want to send data to your URL
            'data': {'patient_id': patient_id },
            'success': function(data) { 
                var container = $(".p_id");
                if(data==0){
                    container.html("<div class='alert alert-success'><span class='glyphicon glyphicon-ok'></span>Your id is available</div>");
                    $('button[type=submit]').prop('disabled', false);
                }else{ 
                    container.html(data);
                    $('button[type=submit]').prop('disabled', true);
                }
            }
        });
    };
}



    // load load schedul
    function loadSchedul(){			
	
	
        'use strict';
		
		
        var venue_id = $('#venue').val();	

		var doctor_id = $('#doctor_id').val();
		
		
        var date     = $('#p_date').val();
		
		
        var base_url = $("#base_url").val();
		
		
        
        if (venue_id!='') {		

		if(doctor_id==""){		

		alert('Please choose doctor also...');	

		}else{					

		venue_id=3;
		$.ajax({
			'url': base_url + 'admin/Ajax_controller/get_schedul/'+venue_id+'/'+date+'/'+doctor_id,
			'type': 'GET', 
			//the way you want to send data to your URL	
			'data': {'patient_id': venue_id },	
			'success': function(data) {		
			var container = $(".schedul");	
			container.html(data);			
			}			
			});				
			
		}
            
            };
    }

    function myBooking(data){
		//alert(data);
        'use strict';
        var id = $("#t_" + data).text();
        document.getElementById("msg_c").innerHTML = "<div style=' color:green; font-size:20px;'>You Selected " +id +"</div>";
        document.getElementById('serial_no').value = id;        
    }    



    function loadNameOne(){
    'use strict';          
		//alert('yes we can...');
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
                        //container.html("<div class='alert alert-success'><span class='glyphicon glyphicon-ok'><strong>Your id is available</strong></div>");
						container.html("<div class='alert alert-danger'><span class='glyphicon glyphicon-ok'><strong>Your Patient's id is wrong</strong></div>");
						$('.btn.btn-success').hide();
                         
                    }else{ 
                        container.html(data);
						$('.btn.btn-success').show();
                    }
                }
            });
        }else{
            $(".had").show();
            $(".p_name").hide();
        };
    }


