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

    $('.tooltipped').tooltip();

    $('.sidenav').sidenav();

    $('select').formSelect();

    $('.shuffle-tabs').tabs({
      swipeable : false,
    });
});


// $(window).resize(function(){
//   width = $(window).width();
// });