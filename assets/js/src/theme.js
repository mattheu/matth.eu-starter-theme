// remap jQuery to $
(function($){

	$( document ).ready( function() {

		// Seriously there's no way to add a class to this?!?!
		$('#commentform #submit').addClass('btn');

		// Large Gallery Flexslider
		$('.gallery-size-large').addClass( 'flexslider' ).flexslider({
			animation: "slide",
			selector: ".row > .gallery-item"
		});

		// Fitvids.
		$('body').fitVids();

	} );


})(this.jQuery);


