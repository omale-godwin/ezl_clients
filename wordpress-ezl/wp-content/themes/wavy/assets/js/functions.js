document.addEventListener("DOMContentLoaded", function () {
    const config = {
        threshold: 0.5
    };
    var lazyImages = [].slice.call( document.querySelectorAll(".lazy, [data-lazy='true']") );

    if ("IntersectionObserver" in window) {
        let lazyImageObserver = new IntersectionObserver(function (entries, observer) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    let lazyImage = entry.target;
                    lazyImage.src = lazyImage.dataset.src;
                    lazyImage.removeAttribute("data-src");
                    lazyImage.classList.add("loaded");
                    lazyImageObserver.unobserve(lazyImage);
                }
            });
        }, config);
        lazyImages.forEach(function (lazyImage) {
            lazyImageObserver.observe(lazyImage);
        });
    } else {
        // Fallback for browsers that do not support IntersectionObserver
    }
});


(function($){
	/* All Images Loaded */
	$(window).on('load', function(){

        // Sticky elements
        if( $('#header').hasClass('enable-sticky') ){
            var header_height = $('#header div.menu-wrapper').outerHeight();
            $('#header').height( header_height );
        }

        $(window).on('resize', function() {
            if( $('#header').hasClass('enable-sticky') ){
                var header_height = $('#header div.menu-wrapper').outerHeight();
                $('#header').height( header_height );
            }
        });

        var referenceElement = document.getElementById('header');
        var header = document.getElementById('header');
        var backToTopButton = document.getElementById('back-to-top');
        
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (!entry.isIntersecting) {
                    backToTopButton.classList.add('visible');
                    if( $('#header').hasClass('enable-sticky') ){
                        header.toggleAttribute('data-stuck', true);
                    }                    
                } else {
                    backToTopButton.classList.remove('visible');
                    header.toggleAttribute('data-stuck', false);
                }
            });
        }, {
            threshold: [1],
            rootMargin: '300px 0px 0px 0px'
        });
        
        observer.observe(referenceElement);

	});
	/* Dom Loaded */
	$(document).ready(function($){

        $('[data-aos]').addClass('aos-animate');

        // Safari mobile fix
        $('.main-nav ul.menu li.menu-item-has-children').attr('onClick', '');

        // Last submenu fix
        $('#header nav ul.menu > li.menu-item-has-children:last').addClass('last-menu-item');

        // Enable HTML5 form validation
        $('#commentform').removeAttr('novalidate');

        $('a.scrollto').on('click', function(e){
            var target = $(this).attr('href');
            var offset = $(target).offset().top;
            $('html, body').animate({scrollTop: offset}, 500);
            e.preventDefault();
        });

        // Single Post copy button
        
        $(".permalink .copy").on('click', function(){
            $("#copy-link").select();
            document.execCommand('copy');
        });

        // Ajax Views counter
        if( $('body').hasClass('single-post') && $('#single').data('post-id') ){
            var post_id = parseInt( $('#single').data('post-id') );
            $.ajax({
                type: 'post',
                url: ajax_var.url,
                data: { action: 'epcl_views_counter', nonce: ajax_var.nonce, post_id: post_id },
                success: function(count){

                }
            });
        }

		/* Global */

		// Open mobile menu        

        $('#header div.menu-mobile').on('click', function(){
			$('body').toggleClass('menu-open');
        });
        $('.menu-overlay').on('click', function(){
			$('body').removeClass('menu-open');
        });

		$('#back-to-top').click(function(event) {
			event.preventDefault();
			$('html, body').animate({scrollTop: 0}, 500);
			return false;
		});

        epcl_load_slick_sliders();	

		/* Global Lightbox */

        var mfp_close_markup = '<span title="%title%" class="mfp-close">&times;</span>';
        var mfp_arrow_markup = '<span class="mfp-arrow mfp-arrow-%dir%"><svg class="icon ularge"><use xlink:href="'+ajax_var.assets_folder+'/images/svg-icons.svg#%dir%-arrow"></use></svg></span>';

		$('.lightbox').magnificPopup({
			mainClass: 'my-mfp-zoom-in',
			removalDelay: 300,
			closeMarkup: mfp_close_markup,
			fixedContentPos: true
        });

        $('.main-nav .lightbox, .epcl-search-button').magnificPopup({
			mainClass: 'my-mfp-zoom-in box-bg-color',
			removalDelay: 300,
			closeMarkup: mfp_close_markup,
            fixedContentPos: true,
            closeBtnInside: false,
            callbacks: {
                beforeOpen: function(item) {
                    setTimeout(function() { $('#search-lightbox form #s').focus() }, 500);
                },
            },
        });

        // Global: related galleries

        $('.epcl-gallery').each(function() {
            var elem = $(this);
            elem.find('ul').magnificPopup({
                type: 'image',
                gallery:{
                    enabled: true,
                    arrowMarkup: mfp_arrow_markup,
                    tCounter: '%curr% / %total%'
                },
                delegate: 'a',
                mainClass: 'my-mfp-zoom-in',
                removalDelay: 300,
                closeMarkup: mfp_close_markup
            });
        });

        // Gutenberg Gallery with lightbox
        $('.wp-block-gallery, .widget_media_gallery, .woocommerce-product-gallery').each(function() {
            var elem = $(this);
            elem.magnificPopup({
                type: 'image',
                gallery:{
                    enabled: true,
                    arrowMarkup: mfp_arrow_markup,
                    tCounter: '%curr% / %total%'
                },
                delegate: "a[href*='.jpg'],a[href*='.png'],a[href*='.gif'],a[href*='.jpeg'],a[href*='.webp']",
                mainClass: 'my-mfp-zoom-in',
                removalDelay: 300,
                closeMarkup: mfp_close_markup,
                image: {
                    titleSrc: function(item) {
                        return item.el.parent().find('figcaption').text();
                    }
                }
            });
        });

        // Gutenberg Single Image with lightbox
        $(".wp-block-image").not('.wp-block-gallery .wp-block-image').magnificPopup({
            type: 'image',
            gallery:{
                enabled: false,
                arrowMarkup: mfp_arrow_markup,
                tCounter: '%curr% / %total%'
            },
            delegate: "a[href*='.jpg'],a[href*='.png'],a[href*='.gif'],a[href*='.jpeg'],a[href*='.webp']",
            mainClass: 'my-mfp-zoom-in',
            removalDelay: 300,
            closeMarkup: mfp_close_markup,
            image: {
                titleSrc: function(item) {
                    return item.el.parent().find('figcaption').text();
                }
            }
        });

        // Custom Ajax Scripts
        if( $('#epcl-ajax-scripts').length > 0){
            $('#epcl-ajax-scripts > div').each(function( index ) {
                var script_src = $(this).data('src');
                var script_cache = parseInt( $(this).data('cache') );
                if ( script_cache == 0 ) script_cache = false;
                else script_cache = true;
                var script_timeout = parseInt( $(this).data('timeout') );

                if( script_timeout > 0 ){
                    setTimeout( function(){
                        $.ajax({
                            url: script_src,
                            dataType: 'script',
                            async: true,
                            cache: script_cache
                        });
                    }, script_timeout );
                }else{
                    $.ajax({
                        url: script_src,
                        dataType: 'script',
                        async: true,
                        cache: script_cache
                    });
                }

            });
        }

        // Prism Loaded by ajax
        if( ($('pre[class]').length > 0 || $('code[class]').length > 0) && $('body').hasClass('enable-optimization') ){
            $.ajax({
                url: ajax_var.assets_folder+'/js/prism.min.js',
                dataType: 'script',
                async: false,
                cache: true,
            });
        }

        // Demo
        $('.epcl-demo-tool .link').on('click', function(e){
            var body_class = $(this).data('class');
            $('body').toggleClass( body_class );
            $(this).toggleClass('active');
            if( $('body').hasClass('disable-custom-colors') ){
                $('.epcl-category-overlay').hide();
            }else{
                $('.epcl-category-overlay').show();
            }
            if( $('body').hasClass('disable-decorations') ){
                $('.epcl-waves-page').hide();
            }else{
                $('.epcl-waves-page').show();
            }
            e.preventDefault();
        });
        $(' .epcl-demo-tool input[type=color]').on('input', function(e){
            var value = e.target.value;
            var data_class = $(this).data('class');
            var data_target = String( $(this).data('target') );
            var data_attr = String( $(this).data('attr') );
            if( data_class !== 'undefined' && data_attr !== 'undefined') {
                $(data_class).css(data_attr, value);
            } else {
                $(":root").css({
                    [data_target]: value
                });                
            }    
        });

	});

    function epcl_load_slick_sliders(){
        $('.epcl-slider').each(function(index, el) {
            
            var parent = $(this);
            var element = parent.find('.slick-slider');
            var rtl = false;
            if( parseInt( element.data('rtl') ) > 0 ){
                rtl = true;
            }
            var epcl_slider = element.slick({
                lazyLoad: 'progressive',
                cssEase: 'ease',
                fade: true,
                arrows: true,
                infinite: true,
                dots: true,
                autoplay: false,
                speed: 600,
                rtl: rtl,
                slidesToShow: 1,
                responsive: [
                    {
                        breakpoint: 1025,
                        settings: {
                            arrows: true,
                            dots: false
                        }
                    },
                ]
            });
            
            epcl_slider.on('beforeChange', function(event, slick, currentSlide, nextSlide){
                var elem = parent.find('.slider-index .item[data-index="'+nextSlide+'"]');
                if( !elem.hasClass('active') ){
                    parent.find('.slider-index .active .toggle').stop().slideUp('700ms');
                    parent.find('.slider-index .active').removeClass('active');
                    elem.addClass('active');
                    elem.find('.toggle').stop().slideDown('700ms');
                    
                }
            });
            $('.epcl-slider .slider-index .item[data-index="0"]').addClass('active').find('.toggle').slideDown('fast');
            parent.find('.slider-index .item').on('mouseenter', function(){
                var index = $(this).data('index');
                epcl_slider.slick('slickGoTo', index);
                var elem = $(this);
                if( !elem.hasClass('active') ){
                    parent.find('.slider-index .active .toggle').stop().slideUp('700ms');
                    parent.find('.slider-index .active').removeClass('active');
                    elem.addClass('active');
                    elem.find('.toggle').stop().slideDown('700ms');
                    
                }            
            });
    
        });

        // Gallery Post Format

        $('.post-format-gallery .slick-slider').each(function(){
            var rtl = false;
            if( parseInt( $(this).data('rtl') ) > 0 ){
                rtl = true;
            }
            $(this).slick({
                cssEase: 'ease',
                fade: true,
                arrows: true,
                infinite: true,
                dots: false,
                autoplay: false,
                speed: 600,
                slidesToShow: 1,
                slidesToScroll: 1,
                rtl: rtl,
            });
        });  
        
        // Widget: Category Slider
        $('.widget_epcl_category_slider .epcl-carousel').each(function(index, el) {
            var slides_to_show = parseInt( $(this).data('show') );
            var rtl = false;
            if( parseInt( $(this).data('rtl') ) > 0 ){
                rtl = true;
            }
            $(this).slick({
                lazyLoad: 'progressive',
                cssEase: 'ease',
                fade: true,
                arrows: true,
                infinite: true,
                dots: false,
                autoplay: false,
                speed: 600,
                slidesToShow: slides_to_show,
                slidesToScroll: slides_to_show,
                rtl: rtl,
            });
        });

        // Module: carousel

        $('.epcl-posts-carousel').each(function(index, el) {
            var slides_to_show = parseInt( $(this).data('show') );
            var rtl = false;
            if( parseInt( $(this).data('rtl') ) > 0 ){
                rtl = true;
            }
            $(this).slick({
                lazyLoad: 'progressive',
                cssEase: 'ease',
                fade: false,
                arrows: true,
                infinite: true,
                dots: true,
                autoplay: false,
                speed: 600,
                slidesToShow: slides_to_show,
                slidesToScroll: slides_to_show,
                rtl: rtl,
                responsive: [
                    {
                        breakpoint: 1700,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4
                        }
                    },
                    {
                        breakpoint: 1500,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3
                        }
                    },
                    {
                        breakpoint: 1025,
                        settings: {
                            arrows: false,
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            arrows: false,
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                ]
            });
        });
        
        // Module: Popular Categories
        $('.epcl-popular-categories .slick-slider').each(function(index, el) {
            var slides_to_show = parseInt( $(this).data('show') );
            var rtl = false;
            if( parseInt( $(this).data('rtl') ) > 0 ){
                rtl = true;
            }            
            $(this).slick({
                cssEase: 'ease',
                fade: false,
                arrows: true,
                infinite: true,
                dots: false,
                autoplay: false,
                speed: 600,
                rtl: rtl,
                slidesToShow: slides_to_show,
                slidesToScroll: slides_to_show,
                responsive: [,
                    {
                        breakpoint: 1700,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4
                        }
                    },
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3
                        }
                    },
                    {
                        breakpoint: 980,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                ]
            });
        });
    }

})(jQuery);

(function() {
    var supportsPassive = eventListenerOptionsSupported();  

    if (supportsPassive) {
      var addEvent = EventTarget.prototype.addEventListener;
      overwriteAddEvent(addEvent);
    }

    function overwriteAddEvent(superMethod) {
      var defaultOptions = {
        passive: true,
        capture: false
      };

      EventTarget.prototype.addEventListener = function(type, listener, options) {
        var usesListenerOptions = typeof options === 'object';
        var useCapture = usesListenerOptions ? options.capture : options;
        options = usesListenerOptions ? options : {};
        if( type == 'touchstart' || type == 'touchmove'){
            options.passive = options.passive !== undefined ? options.passive : defaultOptions.passive;
        }        
        options.capture = useCapture !== undefined ? useCapture : defaultOptions.capture;

        superMethod.call(this, type, listener, options);
      };
    }

    function eventListenerOptionsSupported() {
      var supported = false;
      try {
        var opts = Object.defineProperty({}, 'passive', {
          get: function() {
            supported = true;
          }
        });
        window.addEventListener("test", null, opts);
      } catch (e) {}

      return supported;
    }

  })();

