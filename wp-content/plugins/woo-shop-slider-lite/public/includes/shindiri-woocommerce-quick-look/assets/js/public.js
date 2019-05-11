/**
 * Shindiri Woocommerce quick view scripts
 */
(function ($) {
    
    'use strict';

    // Init quick view
    $(document).on('click', '.sh-ws-quick-look', function () {
        
        // Add loader on click
        $('body').append(shindiri_woocommerce_quick_view_js_data.loader);

        $.fn.prettyPhoto({
            social_tools: false, /* html or false to disable */
            theme: 'shindiri_woocommerce_quick_look', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
            opacity: 0.4,
            modal: false, /* If set to true, only the close button will close the window */
            horizontal_padding: 0, /* The padding on each side of the picture */
            changepicturecallback: function () {
                
                var quickViewContainer = $('.shindiri-product-quick-view');
                
                // Init swiper slider 
                setTimeout(function(){
                    
                    $('.shindiri-product-quick-view .sh_ws-swiper-container').swiperShWooSlider( {
                        slideClass: 'sh_ws-swiper-slide',
                        wrapperClass: 'sh_ws-swiper-wrapper',
                        slidesPerView: 1,
                        spaceBetween: 0,
                        loop: false,
                        nextButton: '.shindiri-product-quick-view .sh-pqv-button-next',
                        prevButton: '.shindiri-product-quick-view .sh-pqv-button-prev'
                        
                    });
                    
                    // Get custom color selected by user
                    var customColor = $('.sh-pqv-quick-view-container').data('color');
                    
                    // Add button background color for simple product (generated from woocommerce template)
                    if ( $('.shindiri-product-quick-view').hasClass('sh-pqv-typography') && customColor == undefined ) {
                        quickViewContainer.find('.sh-pqv-quantity').find('.add_to_cart_button').attr('style', 'background-color: #c9a46b !important');;
                    } else {
                        // Set background color only if user selected any color
                        if ( customColor != undefined ) {
                            quickViewContainer.find('.sh-pqv-quantity').find('.add_to_cart_button').attr('style', 'background-color: ' + customColor + ' !important');
                        }
                    }
                    
                    // Set buttons hover for slider arrows for custom color
                    if ( customColor != undefined ) {
                        $('.shindiri-product-quick-view .sh-pqv-button-next, .shindiri-product-quick-view .sh-pqv-button-prev').hover(function(){
                            $(this).find('.sh-ws-arrow-wrapper').attr('style', 'background-color: ' + customColor + ' !important');
                        }, function(){
                            $(this).find('.sh-ws-arrow-wrapper').css('background-color', '');
                        });

                        // Set buttons hover for input arrows for custom color
                        $('.shindiri-product-quick-view input.sh-pqv-plus, .shindiri-product-quick-view input.sh-pqv-minus').hover(function(){
                            $(this).attr('style', 'color: ' + customColor + ' !important');
                        }, function(){
                            $(this).css('color', '');
                        });
                    }
                    
                }, 150);
                
                // Add plus and minus quatity buttons
                shindiriAddQuantityInputButtons();
                
                // Hide loader
                $('.sh-pqv-loader').fadeOut(400, function(){
                    // Show quick view content
                    $('.shindiri-product-quick-view').addClass('sh-pqv-show-quick-view');
                    // Remove loader
                    $('.sh-pqv-loader').remove();
                });
                
            }/* Called everytime an item is shown/changed */
        });

        // Init quick view modal
        $.prettyPhoto.open($(this).data('view'));

        return false;
    });
    
    // Add plus and minus button to add to cart button
    function shindiriAddQuantityInputButtons() {
    
        var buttonsWrapper = $('.shindiri-product-quick-view .quantity');
        
        if ( buttonsWrapper.hasClass('buttons_added') ) {
            buttonsWrapper.removeClass('buttons_added').find('input.minus, input.plus').remove();
        }
    
        buttonsWrapper
        .addClass('buttons_added')
        .append('<input type="button" value="&#xf0d8;" class="sh-pqv-plus" />')
        .append('<input type="button" value="&#xf0dd;" class="sh-pqv-minus" />');

        // Add quantity to ajax add to cart link
        $(document).on('input change', '.sh-pqv-add-to-cart-form input.qty', function(){
            $(this).parents('.sh-pqv-add-to-cart-form').find('.add_to_cart_button').attr('data-quantity', $(this).val());
        });
        
        // Hide add to cart button after ajax and show view cart button
        $(document).on('click', '.sh-pqv-add-to-cart-form .add_to_cart_button', function(){
            var form = $(this).parents('.sh-pqv-add-to-cart-form');
            var quantity = form.find('.quantity.buttons_added');
            var addToCartButton = $(this);
            
            setTimeout(function(){
                quantity.fadeOut(500);
                addToCartButton.fadeOut(500, function(){
                    
                    // View cart button
                    var added_to_cart = form.find('.added_to_cart');
                    
                    added_to_cart.fadeIn(500);
                    
                    // Fix for WooCommerce view cart button custom background color that appear after product is added to cart
                    var customColor = $('.sh-pqv-quick-view-container').data('color');
                    // Set background color only if user selected any color
                    if ( customColor != undefined ) {
                        added_to_cart.attr( 'style', 'display: inline; background: ' + customColor + ' !important');
                    }
                    
                });
            }, 1000);
        });
        
        // wooComerce
        $('.sh-pqv-plus, .sh-pqv-minus').on('click', function () {

            // Get values
            var $qty = $(this).closest('.quantity').find('.qty'),
                currentVal = parseFloat($qty.val()),
                max = parseFloat($qty.attr('max')),
                min = parseFloat($qty.attr('min')),
                step = $qty.attr('step');

            // Format values
            if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
            if (max === '' || max === 'NaN') max = '';
            if (min === '' || min === 'NaN') min = 0;
            if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = 1;

            // Change the value
            if ($(this).is('.sh-pqv-plus')) {

                if (max && ( max == currentVal || currentVal > max )) {
                    $qty.val(max);
                } else {
                    $qty.val(currentVal + parseFloat(step));
                }

            } else {

                if (min && ( min == currentVal || currentVal < min )) {
                    $qty.val(min);
                } else if (currentVal > 0) {
                    $qty.val(currentVal - parseFloat(step));
                }

            }

            // Trigger change event
            $qty.trigger('change');
        });
    }

})(jQuery);