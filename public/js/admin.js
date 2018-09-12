$(document).ready(function() {
    $('.dropdown-button').dropdown({
          inDuration: 300,
          outDuration: 225,
          constrain_width: true, 
          hover: false, 
          gutter: 0, 
          belowOrigin: false,
          constrainWidth: false
        }
      );

    $('.collapsible').collapsible();

    $('.tooltipped').tooltip();

    $('.sidenav').sidenav();
});

// $(window).resize(function(){
//   width = $(window).width();
// });