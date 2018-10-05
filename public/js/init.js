(function($){
  $(function(){

    $('.sidenav').sidenav();
    $('.parallax').parallax();
    $('.modal').modal();
    $('.tooltipped').tooltip();

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



  }); // end of document ready
})(jQuery); // end of jQuery name space
