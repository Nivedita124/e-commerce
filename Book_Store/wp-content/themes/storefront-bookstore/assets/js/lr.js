jQuery(document).ready(function(){

    jQuery("li.category").hover(function(){
        jQuery('#'+this.id + ' .cat-content').css('background-color','#00000033');
        jQuery('#'+this.id + ' #img').css('transform','scale(2.2)');
        jQuery('#'+this.id + ' #img').css('transition','transform 0.9s');
        jQuery('#'+this.id + ' #btn_info').css('display','block');
        jQuery('#'+this.id + ' p').css('color','white');
        jQuery('#'+this.id + ' h3').css('color','white');
    }, 

    function(){
        jQuery('#'+this.id + ' .cat-content').css('background-color','transparent');
        jQuery('#'+this.id + ' #img').css('transform','scale(1)');
        jQuery('#'+this.id + ' #img').css('transition','transform 0.9s');
        jQuery('#'+this.id + ' #btn_info').css('display','none');
        jQuery('#'+this.id + ' p').css('color','#6d6d6d');
        jQuery('#'+this.id + ' h3').css('color','black');
    });

    /*---------------title and description assign middle position------*/
    var imageWidth = jQuery('.category_banner_image').width();
    var imageHeight = jQuery('.category_banner_image').height();
    console.log(imageHeight);
    console.log(imageWidth);
    var headerWidth = jQuery('.woocommerce-products-header').width();
    var headerHeight = jQuery('.woocommerce-products-header').height();

    console.log(headerWidth);
    console.log(headerHeight);

    var position = (imageWidth/2)-(headerWidth/2);
    var top = (imageHeight/2)-(headerHeight/2);
    var leftPosition = position + 'px';
    var rightPosition = position + 'px';
    var topPosition = top + 'px';

    jQuery('.woocommerce-products-header').css('left',leftPosition);
    jQuery('.woocommerce-products-header').css('right',rightPosition);
    jQuery('.woocommerce-products-header').css('top', topPosition);

    /*---------------use this for upper banner------*/
    jQuery('.content-area').before( $( "img.category_banner_image, .woocommerce-products-header" ) );
    jQuery( "img.category_banner_image, .woocommerce-products-header" ).wrapAll( "<div class='banner'></div>" );

    // Repeat demo content
    var $body = $('body');
    var $box = $('.box');

    for (var i = 0; i < 20; i++) {
        $box.clone().appendTo($body);
    }

    // Helper function for add element box list in WOW
    WOW.prototype.addBox = function(element) {
        this.boxes.push(element);
    };

    // Init WOW.js and get instance
    var wow = new WOW();
    wow.init();

    // Attach scrollSpy to .wow elements for detect view exit events,
    // then reset elements and add again for animation
    $('.wow').on('scrollSpy:exit', function() {
        $(this).css({
            'visibility': 'hidden',
            'animation-name': 'none'
        }).removeClass('animated');
        wow.addBox(this);
    }).scrollSpy();


    //hide and show reviews section
    jQuery('.woocommerce-tabs ul').click(function() {
        jQuery('.woocommerce-Tabs-panel .woocommerce-Reviews').toggle("fast");
    });

    /*-------------------update size and price---------*/
    $(document).on('change', '.variation-radios input', function() {
        $('select[name="'+$(this).attr('name')+'"]').val($(this).val()).trigger('change');
    });


    var windowWidth = $('#section-1 .homepage-template-section-content').width();
    var height = (windowWidth/1600)*900;
    $('#section-1 .homepage-template-section-content').css('height', height+'px');

    $(window).resize(function(){

        $('#section-1 .homepage-template-section-content').each(function(){

            var windowWidth = $('#section-1 .homepage-template-section-content').width();
            var height = (windowWidth/1600)*900;
            $('#section-1 .homepage-template-section-content').css('height', height+'px');
      
        });

    });

    //hamburger-menu
    $('.hamberger-btn').click(function()
    {

        $('.aws-container').hide();
        $('.mobile-dropdown-menu').slideToggle("fast");
        $('.hamberger-btn i').toggle();
        $('#menu-item-13759 .fa-search').show();
        $('#menu-item-13759 .fa-times-circle').hide();
        $('#menu-item-13759 p').text('SEARCH');
        //$('.hamberger-btn .fa-bars').toggle();

    });

    //search-bar
    $('#lr-utility-menu #menu-item-13759').click(function(){

        $('.mobile-dropdown-menu').hide();        
        $('.hamberger-btn .fa-times-circle').hide();
        $('.hamberger-btn .fa-bars').show();

        if( $('#lr-utility-menu #menu-item-13759 p').text() == 'SEARCH')
        {
            $('#lr-utility-menu #menu-item-13759 p').text('CLOSE');
        }
        else
        {
            $('#lr-utility-menu #menu-item-13759 p').text('SEARCH');
        }
        
        $('#lr-utility-menu #menu-item-13759 i').toggle();
        $('.aws-container').toggle();


    });

    //toggle more-details
    $(".more-details").hide();

    $(".atc-wrapper").click(function()
    {
        
        if( $('.atc-wrapper-text').text() == 'More Details')
        {
            $('.atc-wrapper-text').text('Hide Details');
        }
        else
        {
            $('.atc-wrapper-text').text('More Details');
        }
        
        $('.atc-wrapper i').toggle();
        $(".more-details").slideToggle("slow");
        
    });

});
