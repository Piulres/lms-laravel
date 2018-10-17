(function($){
  $(function(){

    $('.sidenav').sidenav();
    $('.parallax').parallax();
    $('.modal').modal();
    
	$('ul.collapsible li:first-child').addClass('active');		
    $('.collapsible').collapsible();

 	// $(".card .card-reveal .c-desc").text(function(index, currentText) {
	//     return currentText.substr(0, 125) + ' ...';
	// });

	$(".card .card-content .c-sup").text(function(index, currentText) {
	    return currentText.substr(0, 80) + ' ...';
	});


	$('.grid').isotope({
		itemSelector: '.grid-item',
		percentPosition: true,
		masonry: {
			columnWidth: '.grid-sizer',
			gutter: '.gutter-sizer'
		}
	});

	$(document).ready(function () {
	    $(window).on("resize", function (e) {
	        checkScreenSize();
	    });

	    checkScreenSize();

	    function checkScreenSize(){
	        var newWindowWidth = $(window).width();
	        if (newWindowWidth < 481) {
	            
	        }
	        else
	        {
    			$('.tooltipped').tooltip();	            
	        }
	    }
	});

	$('.btn-mobile').on('click', function(e) {
		e.preventDefault();
		$(this).toggleClass('active');
		$('.nav').slideToggle();
	});



  }); // end of document ready
})(jQuery); // end of jQuery name space
