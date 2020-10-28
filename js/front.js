$(function () {
    // ================================================
    //  NAVBAR BEHAVIOR
    // ================================================
    $(window).on('scroll load', function () {
        if ($(window).scrollTop() > 300) {
            $('.navbar').addClass('active');
            $('#head-nav').addClass('show');
        } else {
            $('#head-nav').removeClass('show');
            $('.navbar').removeClass('active');
        }
    });

    // ================================================
    // Preventing URL update on navigation link click
    // ================================================
    $('.link-scroll').on('click', function (e) {
        var anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $(anchor.attr('href')).offset().top
        }, 1000);
        e.preventDefault();

        $('.navbar-collapse.collapse').toggleClass('show');
    });


    // ================================================
    // Scroll Spy
    // ================================================
    $('body').scrollspy({
        target: '#navbarSupportedContent',
        offset: 80
    });

});

