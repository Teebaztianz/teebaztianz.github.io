jQuery(document).ready(function() {
	/* Menu */
	if( jQuery(window).width() > 767) {
	   jQuery('.nav li.dropdown').hover(function() {
		   jQuery(this).addClass('open');
	   }, function() {
		   jQuery(this).removeClass('open');
	   }); 
	   
	   jQuery('.nav li.dropdown-menu').hover(function() {
		   jQuery(this).addClass('open');
	   }, function() {
		   jQuery(this).removeClass('open');
	   }); 
	}
	
	jQuery('.nav li.dropdown').find('i').each(function(){
		jQuery(this).on('click', function(){
			if( jQuery(window).width() < 768) {
				jQuery(this).parent().next().slideToggle();
			}
			return false;
		});
	});
	
	/* Animation */
	 //new WOW().init();
	 
});
	/* Menu */
	
jQuery(document).ready(function() {
	/* Slider */
	var swiper = new Swiper('.home-slider', {
		nextButton: '.slider-next',
        prevButton: '.slider-prev',
        slidesPerView: '1',
		spaceBetween: 10,
		autoplay:4000,
		//loop:true
    });
   
	/* Slider */
	
	/* Latest Porduct */
	var swiper = new Swiper('.sale-products', {
		nextButton: '.home-sale-next',
        prevButton: '.home-sale-prev',
        slidesPerView: '5',
		spaceBetween: 10,
		autoplay:3000,
		//loop:true,
		breakpoints: {
            1024: {
                slidesPerView: 4,
                spaceBetween: 10
            },
            768: {
                slidesPerView: 4,
                spaceBetween: 10
            },
            640: {
                slidesPerView: 2,
                spaceBetween: 10
            },
            320: {
                slidesPerView: 1,
                spaceBetween: 10
            }
        }
    });
	/*  Latest Porduct */
	
	/* Collection Porduct */
	var swiper = new Swiper('.collect-products', {
		nextButton: '.home-collect-next',
        prevButton: '.home-collect-prev',
        slidesPerView: '3',
		spaceBetween: 10,
		autoplay:3500,
		//loop:true,
		breakpoints: {
            1024: {
                slidesPerView: 3,
                spaceBetween: 10
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 10
            },
            640: {
                slidesPerView: 2,
                spaceBetween: 10
            },
            320: {
                slidesPerView: 1,
                spaceBetween: 10
            }
        }
    });
	/*  Collection Porduct */
 });
 
	//sticky header
jQuery(document).ready(function() {
		jQuery(window).scroll(function () {
			if( jQuery(window).width() < 481) {
				if (jQuery(this).scrollTop() > 100) {
					jQuery('.header1').addClass('sticky-header');
				}else {
					jQuery('.header1').removeClass('sticky-header');
				}
			}else{
				if (jQuery(this).scrollTop() > 150) {
					jQuery('.header1').addClass('sticky-header');
				}else {
					jQuery('.header1').removeClass('sticky-header');
				}
			}
		});
		
	
});
	

	/* For Scoll Up */
	 var amountScrolled = 300;
		jQuery(window).scroll(function() {
			if ( jQuery(window).scrollTop() > amountScrolled ) {
				jQuery('a.scroll-up').fadeIn('slow');
			} else {
				jQuery('a.scroll-up').fadeOut('slow');
			}
		});
		jQuery('a.scroll-up').click(function() {
			jQuery('html, body').animate({
				scrollTop: 100
			}, 700);
			return false;
		});	
		
	/* for scroll arrow */
	 var amountScrolled = 300;

	jQuery(window).scroll(function() {
		if ( jQuery(window).scrollTop() > amountScrolled ) {
			jQuery('a.scroll-top').fadeIn('slow');
		} else {
			jQuery('a.scroll-top').fadeOut('slow');
		}
	});

	jQuery('a.scroll-top').click(function() {
		jQuery('html, body').animate({
			scrollTop: 100
		}, 700);
		return false;
	});