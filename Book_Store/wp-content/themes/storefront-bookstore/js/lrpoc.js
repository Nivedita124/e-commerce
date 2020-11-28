$(document).ready(function(){
		
		
 	

		//console.log($('.product-display').height());
    $(".preview").on("click", function()
    {
	  	$(".selected").css("opacity",0.5);
	  	$(".selected").css("border","none");
	  	$(".active").removeClass("active");
        $(".selected").removeClass("selected");
        $(this).addClass("selected");
        $(this).css("opacity", 1);
        $(this).css({"border-color": "#333", "border-width":"2px","border-style":"solid"});
        var j = $(this).index();
        
			$(".woocommerce-viewport div").eq(j).addClass("active");
			var h = 0;
			for (var i = 0; i < j; i++)
			{
				h = h + $('.woocommerce-viewport div').eq(i).height();
			}
			var viewport = $(".woocommerce-wrapper div").eq(j).children().height();
			$('.woocommerce-viewport').css("transform","translateY("+ -h +"px)");
			$('.woocommerce-viewport').css("transition-duration","0.5s");
			//$('.woocommerce-viewport').css("height",viewport);
    });


		    


    
});