var isTablets = window.matchMedia("only screen and (max-width: 768px)");
$(document).ready(function(){
    
    // table of content
    var $toc = $('.toc-wrapper');
    if ($toc.height()) {
        $toc.pushpin({
            top: $toc.offset().top ,
            //offset: $('header').height()
        });
    }

    // back to top
    var $back_to_top = $('.back-to-top');
    $back_to_top.hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $back_to_top.fadeIn();
        } else {
            $back_to_top.fadeOut();
        }
    });
    // scroll body to 0px on click
    $back_to_top.on('click', function (e) {
        e.preventDefault();
        $('body,html').animate({
            scrollTop: 0
        }, 800);
    });

    $('#searchsubmit').on('click', function(e) {
        if (!$('.input-search').val()) e.preventDefault();
    });

    // slider home page
    setSlideShowSwiper();

});
function init() {
    if (!isTablets.matches) {
        window.addEventListener('scroll', function(e){
            var distanceY = window.pageYOffset || document.documentElement.scrollTop,
                shrinkOn = 100,
                $nav = $(".nav-bar-nl");
            if (distanceY > shrinkOn) {
                $nav.addClass("smaller");
            } else {
                if ($nav.hasClass("smaller")) {
                    $nav.removeClass("smaller");
                }
            }
        });
    }
}
window.onload = init();

function setSlideShowSwiper() 
{
    var activeSlide = 0;
    galleryThumbs = new Swiper('.gallery-thumbs', {
        direction: 'vertical',
        centeredSlides: true,
        slidesPerView: 'auto',
        slideToClickedSlide: true,
        mousewheelControl: false,
        initialSlide:activeSlide
    });

    galleryTop = new Swiper('.gallery-top', {
        autoplay: 4000,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        grabCursor: true,
        initialSlide:activeSlide
    });
      
    galleryTop.params.control = galleryThumbs;
    galleryThumbs.params.control = galleryTop;
}