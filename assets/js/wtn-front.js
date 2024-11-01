(function(window, $) {

    // USE STRICT
    "use strict";

    var wtnClass = $(".wtn-news-ticker")[0];
    var wtnFeatured = document.getElementById('wtn-featured-id');

    if (wtnClass != null) {
        var rtl = wtnClass.getAttribute('data-rtl-type');
        var speed = wtnClass.getAttribute('data-speed');
        //alert(speed);

        $('.wtn-news-ticker-marquee').AcmeTicker({
            type: 'marquee',
            direction: (rtl == 'rtl' ? 'right' : 'left'),
            speed: speed
        });

        $('.wtn-news-ticker-horizontal').AcmeTicker({
            type: 'horizontal',
            direction: (rtl == 'rtl' ? 'left' : 'right'),
            speed: parseInt(speed)
        });

        $('.wtn-news-ticker-typewriter').AcmeTicker({
            type: 'typewriter',
            direction: 'left',
            speed: speed
        });

        $('.wtn-news-ticker-vertical').AcmeTicker({
            type: 'vertical',
            direction: 'down',
            speed: parseInt(speed)
        });
    }

    if (wtnFeatured != null) {
        $('.featured').slick({
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            infinite: true,
            autoplaySpeed: 3000,
            cssEase: 'ease',
            dots: false,
            dotsClass: 'slick-dots',
            pauseOnHover: true,
            arrows: true,
            prevArrow: '<button type="button" data-role="none" class="slick-prev">Previous</button>',
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: false
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
            ],
        });
    }

})(window, jQuery);