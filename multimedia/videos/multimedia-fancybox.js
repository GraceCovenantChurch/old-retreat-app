$(document).ready(function() {

    $('.fancybox-media')
	.attr('rel', 'media-gallery')
	.fancybox({
	    openEffect : 'none',
	    closeEffect : 'none',
	    prevEffect : 'none',
	    nextEffect : 'none',

	    arrows : false,
	    helpers : {
		media : {},
		buttons : {}
	    }
	});

//    $('.fancybox-media').fancybox({
//	openEffect  : 'none',
//	closeEffect : 'none',
//	helpers : {
//	    media : {}
//	}
//    });
});