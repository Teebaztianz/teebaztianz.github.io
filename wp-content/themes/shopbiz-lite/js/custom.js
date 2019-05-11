//------------------------------------------
  //Slider
//------------------------------------------
jQuery(document).ready(function() {
 
  jQuery("#ta-slider").owlCarousel({
   
      navigation : true, // Show next and prev buttons
      slideSpeed : 100,
      pagination : true,
      paginationSpeed : 400,
      singleItem:true,
      video:true,
      autoPlay : true,
      transitionStyle : "backSlide",
      navigationText: [
      "<i class='fa fa-angle-left'></i>",
      "<i class='fa fa-angle-right'></i>"
      ]
    });
  
});
    
//------------------------------------------
    //scroll-top
//------------------------------------------
  jQuery(".ti_scroll").hide();   
    jQuery(function () {
        jQuery(window).scroll(function () {
            if (jQuery(this).scrollTop() > 500) {
                jQuery('.ti_scroll').fadeIn();
            } else {
                jQuery('.ti_scroll').fadeOut();
            }
        });     
        jQuery('a.ti_scroll').click(function () {
            jQuery('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    }); 