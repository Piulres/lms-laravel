(function($){
  $(function(){

    $('.sidenav').sidenav();
    $('.parallax').parallax();
    $('.modal').modal();

 //    $(".card .card-reveal .c-desc").text(function(index, currentText) {
	//     return currentText.substr(0, 125) + ' ...';
	// });

	$(".card .card-content sup").text(function(index, currentText) {
	    return currentText.substr(0, 75) + ' ...';
	});
	
	$(".card .card-title .c-title").text(function(index, currentText) {
	    return currentText.substr(0, 45);
	});

  }); // end of document ready
})(jQuery); // end of jQuery name space
