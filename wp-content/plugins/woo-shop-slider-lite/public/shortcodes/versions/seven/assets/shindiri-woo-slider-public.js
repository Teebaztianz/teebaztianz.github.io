/*
* Slider version 7 public scripts
*/
(function ($) {
    
    'use strict';
    
    $(window).load(function () {
        
        // Init every slider
        shindiriWooSliderInitVersionSeven();
        
    });
    
    var ShWooResizetimeout;
    
    if ( shindiri_woo_slider_7_data.is_mobile ) {
        $(window).on( "orientationchange", function( event ) { 
            // Reinit on orjentation chage
            setTimeout(function(){
                shindiriWooSliderInitVersionSeven();
            }, 350);
        });
    } else {
        $(window).on('resize', function(){
            var resizeFinished = false;
            clearTimeout(ShWooResizetimeout);

            // ReInit on resize but prevent multiple resize requests
            ShWooResizetimeout = setTimeout(function(){
                shindiriWooSliderInitVersionSeven();
            }, 350);
        });
    }
    
    function shindiriWooSliderInitVersionSeven() {
        $('.shindiri-woo-slider-shortcode-version-seven .shindiri-woo-slider-slider').each(function(){

            var thisSlider = $(this);

            var sliderSelector = '.' + thisSlider.data('selector');
            var sliderTransition = thisSlider.data('transition');
            var sliderLazyLoad = thisSlider.data('lazy-load');
            var sliderPreloadImages = false;
            var autoplayTimeout = thisSlider.data('autoplay'); // 0 for disabled autoplay
            var numberOfSlides = $(sliderSelector).find('.sh_ws-swiper-slide').length;
            var sliderSlidesPerView = 3;
            
            var sliderWrapper = $(sliderSelector).find('.sh_ws-swiper-wrapper');
            var sliderSwiperContainer = sliderWrapper.parents('.sh_ws-swiper-container');
            var sliderWrapperWidth = sliderWrapper.width();
            var sliderWrapperSize = 'sh-ws-large';
            
            // Add class for container width to set intern css properties
            setTimeout(function(){
                if ( sliderWrapperWidth > 991 && sliderWrapperWidth < 1251 ) {
                    sliderWrapperSize = 'sh-ws-medium';
                }

                if ( sliderWrapperWidth <= 991 ) {
                    sliderWrapperSize = 'sh-ws-small';
                }

                sliderSwiperContainer.addClass(sliderWrapperSize);
            }, 100);
            
            if ( ! sliderLazyLoad ) {
                // Setting depends from lazy loading. Lazy need to be false
                sliderPreloadImages = true;
            }
            
            // If number of slides less than 3 show 1 slide per view. Required for slidre to work with 3 slides as designed
            if ( numberOfSlides < 4 ) {
                sliderSlidesPerView = 1;
            }

            // Init swiper
            $(sliderSelector).swiperShWooSlider( {
                slideClass: 'sh_ws-swiper-slide',
                wrapperClass: 'sh_ws-swiper-wrapper',
                nextButton: sliderSelector + ' .shindiri-woo-slider-button-next',
                prevButton: sliderSelector + ' .shindiri-woo-slider-button-prev',
                paginationClickable: true,
                slidesPerView: sliderSlidesPerView,
                direction: 'horizontal',
                centeredSlides: true,
                watchSlidesVisibility: true,
                keyboardControl: false,
                mousewheelControl: false,
                speed: 400,
                loop: true,
                loopedSlides: numberOfSlides,
                spaceBetween: 0,
                onInit: function(swiper){
                    
                    // Swipe once and make this active slide bigger
                    if ( autoplayTimeout == 0 ) {
                        // There is conflict with autoplay so it must run only if autoplay disabled
                        swiper.slideTo(1);
                    }
                    sliderWrapper.addClass('sh_ws-enlarge-actve-slide');
                    
                    // Start, stop autoplay on hover if enabled
                    if ( autoplayTimeout != 0 ) {
                        $(sliderSelector).hover(function(){
                            swiper.stopAutoplay();
                        }, function(){
                            swiper.startAutoplay();
                        });
                    }
                },
                // Preloading of all images
                preloadImages: sliderPreloadImages,
                // Lazy loading
                lazyLoading: sliderLazyLoad,
                lazyLoadingInPrevNext: false,
                // Slider transition
                effect: sliderTransition,
                autoplay: autoplayTimeout,
                coverflow: {
                    rotate: 50,
                    stretch: 0,
                    depth: 100,
                    modifier: 1,
                    slideShadows : false
                }
                
            }); 
        });
    }
    
})(jQuery);
