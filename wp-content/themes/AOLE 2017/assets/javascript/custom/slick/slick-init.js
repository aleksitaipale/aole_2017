jQuery(document).ready(function($){

	$('.pilots-carousel').slick({
		dots: true,
		infinite: false,
		speed: 300,
		slidesToShow: 3,
		slidesToScroll: 3,
		mobileFirst: true,
		responsive:[
		{
			breakpoint: 1024, 
			settings: {
				slidesToShow: 3, 
				slidesToScroll: 3
			}
		},
		{
			breakpoint: 640, 
			settings: { 
				slidesToShow: 2, 
				slidesToScroll: 2
			}
		},
		{
			breakpoint: 0, 
			settings: {
				slidesToShow: 1, 
				slidesToScroll: 1
			}
		}

		]
	});
	
});