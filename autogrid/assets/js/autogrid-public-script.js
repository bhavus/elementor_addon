jQuery(document).ready(function($){
	
    /* $(document).on("click",".gfield--type-submit .gform-button", function(){
        setTimeout(function(){
            if( $(".gfield_validation_message").length > 0 || $(".gform_validation_errors").length > 0){
                //$(".gfield_validation_message,.gform_validation_errors").remove();
            }
        },5000);
    }); */
    
	if($( window ).width() < 1025 && ! $('.grid-slider .elementor-grid').hasClass('slick-slider') ){
        grid_slider();
    }else{
        unset_grid_slider();
    }
	
    $( window ).resize(function() {
        if($( window ).width() < 1025 && ! $('.grid-slider .elementor-grid').hasClass('slick-slider') ){
            grid_slider();
        }else if($( window ).width() > 1024) {
            unset_grid_slider();
        }
    });
	
    if( $(".single-post-author-container .e-con-inner").children().length < 1 ){
        $(".single-post-author-container").remove();
    }

    if( $(".post-author-name-container").children().length < 1 ){
        $(".post-author-name-container").remove();
    }
	
    if( $('body').hasClass('single-post') ){
		sticky_social_icon();
        jQuery(document).on('scroll',window, function(){
            sticky_social_icon();
        });
    }
	
});

function sticky_social_icon(){
	var content_height = jQuery('.elementor-location-single .elementor-element:first-child').height();
	var header_height = jQuery('.elementor-location-header').height();
	var top_height = jQuery(window).scrollTop();
	var total_height = content_height - 150;
	
	if(top_height > total_height - 130) {
		jQuery('body.single-post .a2a_vertical_style').css({"position":"absolute","top":total_height});
	}else{
		jQuery('body.single-post .a2a_vertical_style').css({"position":"fixed","top":120});
	}
}

function unset_grid_slider(){
    if( jQuery('.grid-slider .elementor-grid').hasClass('slick-slider') ){
        jQuery('.grid-slider .elementor-grid').slick('unslick');
    }
}

function grid_slider(){
    jQuery('.grid-slider .elementor-grid').slick({
        infinite: true,
        slidesToShow: 2,
		dots: true,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 2000,
		adaptiveHeight: true,
        responsive: [
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
}