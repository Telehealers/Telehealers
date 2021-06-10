<script type="text/javascript">
  function addActive(x, currentFocus) {

    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x, currentFocus);

    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/

    x[currentFocus].classList.add("autocomplete-active");
  }

  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = x.length - 1; i >= 0; i--) {
      x[i].classList.remove("autocomplete-active");
    }
  }

  function loadName() {
    'use strict';
    var patient_id = document.getElementById('p_id').value;

    if (patient_id != '') {
      $.ajax({

        'url': '<?php echo base_url(); ?>' + 'admin/Ajax_controller/load_patient_info/' + patient_id.trim(),
        'type': 'GET',
        'dataType': 'JSON',
        'success': function(data) {
          //$(".had").hide();
          document.getElementById("ptname").textContent = data.patient_name;
          document.getElementById("ptage").textContent = data.age;
          document.getElementById("ptsex").textContent = data.sex;
          document.getElementById("ptid").textContent = data.patient_id;
          document.getElementsByName("patient_id")[0].value = data.patient_id;



        }
      });
    } else {
      $(".had").show();
      $(".p_name").hide();
    };
  }
  
  /** A function to add autoComplete function to all medicine box.
   * similar implementation can be used elsewhere too.
   * input medicineNameID {String}: Id of HTML div with `name="md_name[]"`.
   * input medicineValueID {String}: If of HTML div with `name="medicine_id[]"`.
   * input apiURL {String}
   * NOTE: IDs(Inputs) must start with '#'.
   * NOTE: Call this function after your HTML target element is pushed to the page ie 
   *    something like `$(wrapper).append(myHTML)`.
   * IMPORTANT: Use this function for autocomplete in this file.
   */
  function addAutocompleteToHTMLDiv(medicineNameID, medicineValueID, apiURL) {
    $(medicineNameID).autocomplete({
      source: apiURL,
      minLength: 2,
      select: function(event, ui) {
        $(medicineNameID).val(ui.item.label);
        $(medicineValueID).val(ui.item.value);
        return false;
      },
      focus: function(event, ui) {
        $(medicineNameID).val(ui.item.label);
        return false;
      }
    });
  }
  $(document).ready(function() {

    const getMedicineURL = 'admin/Ajax_controller/medicine_selection/';
    var base_url = $('#base_url').val();
    var maxField = 50;
    var addButton = $('.add_button');
    var wrapper = $('.field_wrapper');

    var x = 1;
    var counter = 2;
    $(addButton).on('click', function() {
      if (x < maxField) {
        var fieldHTML = '<div id="count_' + (counter++) + '">' +
          '<div class="form-group mdcn">' +
          '<div class="col-md-3 col-xs-12">' +
          '<input type="hidden" id="medicine_value_' + x + '" class="mdcn_value" name="medicine_id[]" value="" />' +
          '<input type="text"  id="medicine_name_' + x + '" class="mdcn_name form-control" name="md_name[]" autocomplete="off" placeholder="<?php echo display('medicine_name') ?>" />' +
          '</div>' +
          '<div class="col-md-3 col-xs-10"><input type="text"  class="form-control"  placeholder="<?php echo display('medicine_comment') ?>" name="comments[]" /></div>' +
          '<a href="javascript:void(0);" class="btn btn-danger remove_button" title="Remove field"><span class="glyphicon glyphicon-trash"></span></a>' +
          '</div>' +
          '</div>';
        $(wrapper).append(fieldHTML);
        /**NOTE: Very important that below line comes after above line. */
        addAutocompleteToHTMLDiv('#medicine_name_' + x, '#medicine_value_' + x, base_url + getMedicineURL);
        x++;

      }
    });

    /** Add autocomplete to initial element. */
    addAutocompleteToHTMLDiv('#medicine_name', '#medicine_value', base_url + getMedicineURL);

    $(wrapper).on('click', '.remove_button', function(e) {
      e.preventDefault();
      $(this).parent('div').remove();
      x--;
    });

});



  //<!-- ============================================= -->
  //<!-- test info -->
  //<!-- ============================================= -->


  $(document).ready(function() {

    var base_url = $('#base_url').val();
    const getTestURL = 'admin/Ajax_controller/test_selection/';

    var maxField = 50;
    var testButton = $('.add_button1');
    var wrapper = $('.field_wrapper1');
    var counter = 2;
    var x = 1;

    $(testButton).click(function() {
      if (x < maxField) {
        var fieldHTML = '<div id="count_test' + (counter++) + '">' +
          '<div class="form-group ">' +
          '<div class="col-md-5 col-xs-12">' +
          '<input type="hidden" id="test_value_' + x + '" class="test_value" name="test_name[]" value="" />' +
          ' <input placeholder="<?php echo display('test_name') ?>" id="test_name_' + x + '" class="test_name form-control" name="te_name[]" autocomplete="off"  >' +
          ' <div id="test-box"></div>' +
          '</div>' +
          '<div class="col-md-5 col-xs-10"> <input placeholder="Description" name="test_description[]" class="form-control"  rows="2"></div>' +

          '<a href="javascript:void(0);" class="btn btn-danger remove_button" title="Remove field"><span class="glyphicon glyphicon-trash"></span></a></div>' +
          '</div>';

        $(wrapper).append(fieldHTML);
        addAutocompleteToHTMLDiv('#test_name_' + x, '#test_value_' + x, base_url + getTestURL);
        x++;
      }

    });


    addAutocompleteToHTMLDiv('#test_name', '#test_value', base_url + getTestURL);

  



    $(wrapper).on('click', '.remove_button', function(e) {
      e.preventDefault();
      $(this).parent('div').remove();
      x--;
    });
  });

  //<!-- ========================================= -->
  //<!--  advice info -->
  //<!-- ========================================= -->

  $(document).ready(function() {
    'use strict';

    var base_url = $('#base_url').val();
    const getAdviceURL = 'admin/Ajax_controller/advice_selection/';
    var maxField = 50;
    var add_advice = $('.add_advice');
    var wrapper = $('.field_wrapper2');
    var counter = 2;
    var x = 1;

    $(add_advice).click(function() {
      if (x < maxField) {
        var fieldHTML = '<div id="count_add' + (counter++) + '">' +
          '<div class="form-group ">' +
          '<div class="col-md-10 col-xs-10">' +
          '<input type="hidden" id="advice_value_' + x + '" class="advice_value" name="advice[]" value="" />' +
          '<input placeholder="Advice" id="advice_name_' + x + '" class="advice_name form-control" name="adv[]" autocomplete="off">' +
          ' <div style="position:absolute;z-index:9999;" id="advice-box"></div>' +
          '</div>' +

          '<a href="javascript:void(0);" class="btn btn-danger remove_button" title="Remove field"><span class="glyphicon glyphicon-trash"></span></a></div>' +
          '</div>';

        $(wrapper).append(fieldHTML);
        addAutocompleteToHTMLDiv('#advice_name_' + x, '#advice_value_' + x, base_url + getAdviceURL);
        x++;
      }

    });

    addAutocompleteToHTMLDiv('#advice_name', '#advice_value', base_url + getAdviceURL);

    $(wrapper).on('click', '.remove_button', function(e) {
      e.preventDefault();
      $(this).parent('div').remove();
      x--;
    });
  });
</script>