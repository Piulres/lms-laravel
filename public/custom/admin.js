$(document).ready(function() {

    // $('table.vertical-scroll').wrap('div');
    $('.btn-toggle-menu').on('click', function(e) {
       $('body').toggleClass('yay-hide');
    });

    // if($(window).width() < 768) {
    //     $('body').addClass('yay-hide');
    //     $('aside.yaybar').removeClass('yay-hide-to-small yay-shrink');
    //     $('aside.yaybar').addClass('yay-overlay');
    // } else {
    //     $('body').removeClass('yay-hide');
    //     $('aside.yaybar').addClass('yay-hide-to-small yay-shrink');
    //     $('aside.yaybar').removeClass('yay-overlay');
    // }

    // $( window ).resize(function() {
    //     if($(window).width() < 768) {
    //         $('body').addClass('yay-hide');
    //         $('aside.yaybar').removeClass('yay-hide-to-small yay-shrink');
    //         $('aside.yaybar').addClass('yay-overlay');
    //     } else {
    //         $('body').removeClass('yay-hide');
    //         $('aside.yaybar').addClass('yay-hide-to-small yay-shrink');
    //         $('aside.yaybar').removeClass('yay-overlay');
    //     }
    // });

    $('.toggle-view a').on('click', function(e) {
      e.preventDefault();
      var view = $(this).attr('id');
      $('.toggle-view a').removeClass('active');
      $(this).addClass('active');
      if(view === 'list-view') {
        $('#view').removeClass('grid-view');
        $('#view').addClass('list-view');
      } else {
        $('#view').addClass('grid-view');
        $('#view').removeClass('list-view');
      }
    })

    $('.expand').on('click', function(e) {
      e.preventDefault();

      $(this).parent().parent().parent().parent().find('.expand-contain').slideToggle();
      $(this).parent().parent().parent().parent().toggleClass('expanded');
    })

});

function msgSuccess(msg) {
    M.toast({
        html: msg,
        classes: 'success',
        activationPercent: 0.5,
    });
}


(function() {
    var body = document.body,
        dropArea = document.querySelector( '.drop-area' ),
        droppableArr = [], dropAreaTimeout;

    // initialize droppables
    [].slice.call( document.querySelectorAll( '.drop-area .drop-area__item' )).forEach( function( el ) {
        droppableArr.push( new Droppable( el, {
            onDrop : function( instance, draggableEl ) {
                // show checkmark inside the droppabe element
                classie.add( instance.el, 'drop-feedback' );
                clearTimeout( instance.checkmarkTimeout );
                instance.checkmarkTimeout = setTimeout( function() { 
                    classie.remove( instance.el, 'drop-feedback' );
                }, 800 );
                // ...
            }
        } ) );
    } );

    // initialize draggable(s)
    [].slice.call(document.querySelectorAll( '#view .drag-me' )).forEach( function( el ) {
        new Draggable( el, droppableArr, {
            draggabilly : { containment: document.body },
            onStart : function() {
                
                // add class 'drag-active' to body
                classie.add( body, 'drag-active' );
                // clear timeout: dropAreaTimeout (toggle drop area)
                clearTimeout( dropAreaTimeout );
                // show dropArea
                classie.add( dropArea, 'show' );
            },
            onEnd : function( wasDropped ) {
                var afterDropFn = function() {
                    // hide dropArea
                    classie.remove( dropArea, 'show' );
                    // remove class 'drag-active' from body
                    classie.remove( body, 'drag-active' );
                };

                if( !wasDropped ) {
                    afterDropFn();
                }
                else {
                    // after some time hide drop area and remove class 'drag-active' from body
                    clearTimeout( dropAreaTimeout );
                    dropAreaTimeout = setTimeout( afterDropFn, 400 );

                    $.ajax({
                        type: "POST",
                        url: '/admin/lessons/create',
                        success: function( data ) {
                            console.log(data);
                            msgSuccess('Mensagem de Sucesso');
                        }

                    });

                }
            }
        } );
    } );
})();



// $(window).resize(function(){
//   width = $(window).width();
// });