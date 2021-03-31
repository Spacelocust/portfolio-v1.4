(function($) {
    $('.js-scroll-trigger').on('click', function() { // Au clic sur un élément
        var page = $(this).attr('href'); // Page cible
        var speed = 750; // Durée de l'animation (en ms)
        $('html, body').animate( { scrollTop: $(page).offset().top }, speed ); // Go
        return false;
    });

    //fonction affichage form ajout projet
    $('.add-btn').on('click', function(e){
        e.preventDefault()
        $( ".area-add" ).toggle( "fade", function() {
        });
    });

    //fonction affichage form modif projet
    $('.modif-btn').on('click', this ,function(e){
        e.preventDefault()
        var td = $(this).parent()
        var tr = $(td).parent()
        var nextTr = $(tr).next()
        $(nextTr).toggle( "fade", function() {
        });
    });

    // Closes responsive menu when a scroll trigger link is clicked
    $('.js-scroll-trigger').click(function() {
        $('.navbar-collapse').collapse('hide');
    });

    // Activate scrollspy to add active class to navbar items on scroll
    $('body').scrollspy({
        target: '#mainNav',
        offset: 56
    });

    // Collapse Navbar
    var navbarCollapse = function() {
        if ($("#mainNav").offset().top > 100) {
            $("#mainNav").addClass("navbar-shrink");
        } else {
            $("#mainNav").removeClass("navbar-shrink");
        }
    };
    // Collapse now if page is not at top
    navbarCollapse();
    // Collapse the navbar when page is scrolled
    $(window).scroll(navbarCollapse);
    $('#sliderProjet').hover(function() {
        $(this).carousel('pause');
    }, function() {
        $(this).carousel('cycle');
    });

    var swiper = new Swiper('.swiper-container', {
        effect: 'cube',
        grabCursor: true,
        loop: true,
        cubeEffect: {
            shadow: true,
            slideShadows: true,
            shadowOffset: 20,
            shadowScale: 0.94,
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
    });

})(jQuery); // End of use strict
window.onload = function(){
    $('.loader').fadeOut();
};
