jQuery(document).ready(function()
{
	var photoDivHeight = jQuery("div.woocommerce-product-gallery__image").height();
	var totalSlides = jQuery("figure.woocommerce-product-gallery__slide").children().size();
	var totalHeight = photoDivHeight*totalSlides;
	jQuery("figure.woocommerce-product-gallery__slide").css("height", totalHeight + "px");
	jQuery("figure div.woocommerce-product-gallery__image").css("height", this.photoDivHeight);
	jQuery(".woocommerce-product-gallery .flex-viewport").css("height", this.photoDivHeight);

	var showed_box = 0;

	jQuery("span.previous").click(function()
	{
		showed_box += -photoDivHeight;
		console.log(showed_box);

		        if(showed_box < -totalHeight)
		            showed_box = 0;

		        jQuery('figure.woocommerce-product-gallery__slide').css("transform","translateY("+showed_box+"px)");
		        jQuery('figure.woocommerce-product-gallery__slide').css("transition-duration","0.5s");
	});

	jQuery("span.next").click(function()
	{
		showed_box += photoDivHeight;
		console.log(showed_box);

		        if(showed_box > 0)
		            showed_box = -totalHeight;

		         jQuery('figure.woocommerce-product-gallert__slide').css("transform","translateY("+showed_box+"px)");
		         jQuery('figure.woocommerce-product-gallert__slide').css("transition-duration","0.5s");
	});
});