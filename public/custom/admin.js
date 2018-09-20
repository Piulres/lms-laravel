$(document).ready(function() {
    $('.dropdown-button').dropdown({
          inDuration: 300,
          outDuration: 225,
          hover: false, 
          gutter: 0, 
          belowOrigin: false,
          constrainWidth: false
        }
      );

    $('.collapsible').collapsible();

    $('.material-tooltip').remove();

    $('.sidenav').sidenav();

    $('select').formSelect();

    $('.shuffle-tabs').tabs({
      swipeable : false,
    });

    $('.datepicker').datepicker({
      format: 'dd/mm/yyyy'
    });

});


// $(window).resize(function(){
//   width = $(window).width();
// });