(function($){
  $(function(){

    $('.sidenav').sidenav();
    $('.parallax').parallax();
    $('.modal').modal();

    $(".card .content p").text(function(index, currentText) {
	    return currentText.substr(0, 150) + ' ...';
	});
	
	$("card .card-title").text(function(index, currentText) {
	    return currentText.substr(0, 100);
	});

  }); // end of document ready
})(jQuery); // end of jQuery name space
