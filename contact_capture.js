// Simple jQuery function that monitors a form for abandonment
// Requires jQuery!

$.fn.watchForAbandon = function( required_fields ) {
  // vars for if user submitted the form and developer gave valid parameters
  var isSubmitted = false;
  var haveParams = false;
  var $form = $(this);

  //if we are given an array greater than 0 in length we have parameters
  if( typeof required_fields === 'object' && required_fields.length > 0 ) {
    haveParams = true;
    //check that all values in array are strings
    for( var i = 0; i < required_fields.length; i++ ) {
      //if not we don't have valid params
      if(typeof required_fields[i] !== 'string') {
        haveParams = false;
        break;
      }
    }
    if(haveParams)
      console.log("We have required fields!");
  } else {
    console.log("No Required fields.");
  }

  //listener to check if we submitted the form
  $form.submit(function() {
    //if we submitted we don't need to do our abandonment stuff
    isSubmitted = true;
  });

  //before the page closes
  $(window).bind('beforeunload', function() {
    //if the form wasn't submitted
    if( ! isSubmitted ) {

      var form_array = $form.serializeArray();
      $.ajax({
        method: "POST",
        contentType: "application/json; charset=utf-8",
        url: "contact_capture_mail.php",
        data: JSON.stringify(form_array),
      });
    }
  });
  //for chaining
  return this;
};
