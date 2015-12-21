    (function($){
    $(document).ready(function() {

        
        
        
        
        
        $('.products-module .products').addClass('owl-carousel');

        $('.products-module .products').owlCarousel({
            items: 5,
            itemsTablet: [770,3],
            itemsMobile : [480,1],
            navigation: true,
            navigationText : false,
            pagination: false,
            afterInit : function(elem){
                $('.products-module .woocommerce:not(.compare-button)').css('height', 'auto').css('overflow', 'visible');
            }
        });
        
          
        $('.parallax').each(function(){
           $(this).parallax("50%", 0.1);
        });

                
        
    });
    })(jQuery);
     /*2015-12-17 11:14*//* JS Generator Execution Time: 3.0994415283203E-5 seconds */