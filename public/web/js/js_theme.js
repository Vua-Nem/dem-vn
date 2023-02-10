jQuery(document).ready(function () {
    $('.canvas-menu').click(function () {
        $('body').addClass('show-canvas-mneu')
    });


    $(".w3-button").click(function () {
        $(".w3-button").removeClass("active");
        $(this).addClass("active");
    });
    $('.page-1').click(function () {
        $('.w3-button1').addClass('active');
        $("body").scrollTop(0);
        $('button:not(.w3-button1)').removeClass('active');
        $('div:not(.w3-button1)').removeClass('active');
    })
    $('.page-2').click(function () {
        $('.w3-button2').addClass('active');
        $("body").scrollTop(0);
        $('button:not(.w3-button2)').removeClass('active');
        $('div:not(.w3-button2)').removeClass('active');
    })
    $('.page-3').click(function () {
        $('.w3-button3').addClass('active');
        $("body").scrollTop(0);
        $('button:not(.w3-button3)').removeClass('active');
        $('div:not(.w3-button3)').removeClass('active');
    })
    $('.page-4').click(function () {
        $('.w3-button4').addClass('active');
        $("body").scrollTop(0);
        $('button:not(.w3-button4)').removeClass('active');
        $('div:not(.w3-button4)').removeClass('active');
    })
    $('.page-5').click(function () {
        $('.w3-button5').addClass('active');
        $("body").scrollTop(0);
        $('button:not(.w3-button5)').removeClass('active');
        $('div:not(.w3-button5)').removeClass('active');
    })
    $('.page-6').click(function () {
        $('.w3-button6').addClass('active');
        $("body").scrollTop(0);
        $('button:not(.w3-button6)').removeClass('active');
        $('div:not(.w3-button6)').removeClass('active');
    })
    var hashes = window.location.href.slice(window.location.href.indexOf('#') + 0);
    var tab1 = $(".w3-button1").attr('data1');
    var tab2 = $(".w3-button2").attr('data2');
    var tab3 = $(".w3-button3").attr('data3');
    var tab4 = $(".w3-button4").attr('data4');
    var tab5 = $(".w3-button5").attr('data5');
    var tab6 = $(".w3-button6").attr('data6');
    if (tab1 == hashes) {
        $('.w3-button1').addClass('active');
        $('button:not(.w3-button1)').removeClass('active');
        $('div:not(.w3-button1)').removeClass('active');
    }
    if (tab2 == hashes) {
        $('.w3-button2').addClass('active')
        $('button:not(.w3-button2)').removeClass('active');
        $('div:not(.w3-button2)').removeClass('active');
    }
    if (tab3 == hashes) {
        $('.w3-button3').addClass('active')
        $('button:not(.w3-button3)').removeClass('active');
        $('div:not(.w3-button3)').removeClass('active');
    }
    if (tab4 == hashes) {
        $('.w3-button4').addClass('active')
        $('button:not(.w3-button4)').removeClass('active');
        $('div:not(.w3-button4)').removeClass('active');
    }
    if (tab5 == hashes) {
        $('.w3-button5').addClass('active')
        $('button:not(.w3-button5)').removeClass('active');
        $('div:not(.w3-button5)').removeClass('active');
    }
    if (tab6 == hashes) {
        $('.w3-button6').addClass('active')
        $('button:not(.w3-button6)').removeClass('active');
        $('div:not(.w3-button6)').removeClass('active');
    }
    $(window).scroll(function () {
        var scrolled = $(window).scrollTop();
        if (scrolled > 1000) $('.go-top').fadeIn('slow');
        if (scrolled < 1000) $('.go-top').fadeOut('slow');
    });

    $('.go-top').click(function () {
        $("html, body").animate({
            scrollTop: "0"
        }, 500);
    });

    $('.show-content').click(function () {
        $('.checkout-right').toggleClass('show-info')
    })
    $('.close-canvas').click(function () {
        $('body').removeClass('show-canvas-mneu')
    })
    jQuery('.review-section').slick({
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 5,
        arrows: false,
        slidesToScroll: 5,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }

        ]
    });
    $('.carousel-slide').slick({
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 5,
        slidesToScroll: 5,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }

        ]
    });
    $('#mainCarousel').slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false
    });
    $('.product-choose').click(function () {
        $(this).find('ul').toggleClass('active');
    })
    $('#product-buy li').click(function () {
        if (!$(this).hasClass('disabled')) {
            var nameProductBuy = $(this).data("key");
            $("#product-buy .title-select span").text($(this).text());
            initFeatureProducts(nameProductBuy, 1);
            $("#product-buy li").removeClass('active');
            $(this).addClass('active');

            $("#product-compare li").removeClass('disabled');
            $("#product-compare li[data-key='" + nameProductBuy + "']").addClass('disabled');

            $("[class*='review-section']").removeClass('active');
            $(".testimonialCarousel-" + nameProductBuy).addClass('active');
        }
    })

    $('#product-compare li').click(function () {
        if (!$(this).hasClass('disabled')) {
            var nameProductCompare = $(this).data("key");
            $("#product-compare .title-select span").text($(this).text());
            initFeatureProducts(nameProductCompare, 2);
            $("#product-compare li").removeClass('active');
            $(this).addClass('active');
            $("#product-buy li").removeClass('disabled');
            $("#product-buy li[data-key='" + nameProductCompare + "']").addClass('disabled');
        }
    });
    $("#compare-pages").each(function () {
        window.addEventListener("scroll", (event) => {
            let positionElement = jQuery(".image-product").position().top;
            let scroll = $(window).scrollTop();
            if (scroll >= positionElement) {
                $(".top-bar").fadeIn(300);
            } else {
                $(".top-bar").fadeOut(300);
            }
        });
    });
    $('.items-product').slick({
        dots: false,
        infinite: true,
        autoplay: true,
        speed: 200,
        slidesToShow: 2,
        slidesToScroll: 2,
        prevArrow: '<img class="lazyload slick-prev" data-src="web/newImage/home/prev_icon.svg" alt="" />',
        nextArrow: '<img class="lazyload slick-next" data-src="web/newImage/home/next_icon.svg" alt="" />',
    });
});

//Countdown
function CountDownTimer(dt, id, start_hour) {
    var end = dt.replaceAll("-", "/");
    end = new Date(end);

    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;
    var timer, timeStart;
    var countDownTime = start_hour * 3600000;

    if ((localStorage.getItem("timeStart") == null) || ((new Date(localStorage.getItem("timeStart")) - new Date()) > countDownTime)) {
        localStorage.setItem("timeStart", new Date());
    } else {
        timeStart = localStorage.getItem("timeStart");
    }

    function showRemaining() {
        var now = new Date();
        var distance = end - now;
        var timeSpent = now - new Date(timeStart);

        if (timeSpent < start_hour * 3600000) {
            countDownTime = start_hour * 3600000 - timeSpent;
        }

        if (countDownTime > 0 && countDownTime < distance) {
            countDownTime = countDownTime - 1000;
            distance = countDownTime;
        }
        if (distance <= 0) {
            clearInterval(timer);
            $('.count-down.' + id).hide();
            return;
        }

        var days = Math.floor(distance / _day);
        var hours = Math.floor((distance % _day) / _hour);
        var minutes = Math.floor((distance % _hour) / _minute);
        var seconds = Math.floor((distance % _minute) / _second);

        $('#' + id + ' .day .num-time').text(days < 10 ? "0" + days : days);
        $('#' + id + ' .hours .num-time').text(hours < 10 ? "0" + hours : hours);
        $('#' + id + ' .minutes .num-time').text(minutes < 10 ? "0" + minutes : minutes);
        $('#' + id + ' .seconds .num-time').text(seconds < 10 ? "0" + seconds : seconds);
    }

    timer = setInterval(showRemaining, 1000);

}
