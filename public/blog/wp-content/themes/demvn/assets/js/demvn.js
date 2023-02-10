jQuery(function($) {
    $('.canvas-menu').click(function(){
        $('body').addClass('show-canvas-mneu')
    })

    $('.close-canvas').click(function(){
        $('body').removeClass('show-canvas-mneu')
    })

    $(".icon-menu").click(function() {
        $(this).toggleClass('active');
        $('.header-menu').toggleClass('active');
        $('body').toggleClass('active');
    });

    $(".has-submenu .menu-link").click(function() {
        $(this).parent().toggleClass('active')
    });

    $(".item.has-submenu").hover(function(){
        $('body').addClass('overlay-active');
    }, function(){
        $('body').removeClass('overlay-active');
    });
    $(window).scroll(function(){
        var scrolled = $(window).scrollTop();
        if (scrolled > 1000) $('.go-top').fadeIn('slow');
        if (scrolled < 1000) $('.go-top').fadeOut('slow');
      });
      
      $('.go-top').click(function () {
        $("html, body").animate({ scrollTop: "0" },  500);
      });
})