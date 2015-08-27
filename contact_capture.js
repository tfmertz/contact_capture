// Simple jQuery function that monitors a form for abandonment
// Requires jQuery!

$.fn.watchForAbandon = function( required_fields ) {
  //check if we have parameters
  if( required_fields !== undefined ) {
    console.log("We have input!");
  } else {
    console.log("No Required fields.");
  }

  $(this).submit(function() {
    alert("Submitted!");
  });

  $(window).bind('beforeunload', function() {

    console.log("Did things");
  });

};
