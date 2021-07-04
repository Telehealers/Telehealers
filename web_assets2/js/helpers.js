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