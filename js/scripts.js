
// Detect input placeholder support.
// See http://diveintohtml5.org/detect.html#input-placeholder
// When using modernizr - use <code> if (Modernizr.input.placeholder) </code>
function supports_input_placeholder() {
	var i = document.createElement('input');
	return 'placeholder' in i;
}

// remap jQuery to $
(function($){

/*
* Grid Overlay
*
*/
	$( document ).ready( function() {
		
		$( 'hmtl' ).removeClass( 'no_js' ).addClass( 'js' )
		
		//Grid Overlay Code - for development purposes.
		//To Do - nice to have shortcut key maybe? To avoid having footer link. 
		$( '#show_grid, #grid_overlay' ).live( 'click', function( e ) {
				e.preventDefault();
				var gridOverlay = '<div id="grid_overlay"><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div>';
				if( ! $('#grid_overlay').length ) {
					$('body').prepend( gridOverlay );
				} else {
					$('#grid_overlay').remove();
				}
		});
		
		
		/**
		 *
		 *	Fake HTML5 Placeholder attribute support for older browsers.
		 *
		 */
		if( supports_input_placeholder() ) {
		
			$('[placeholder]').focus(function() {
			var input = $(this);
				if (input.val() == input.attr('placeholder')) {
					input.val('');
					input.removeClass('placeholder');
				}
			}).blur(function() {
				var input = $(this);
				if (input.val() == '' || input.val() == input.attr('placeholder')) {
					input.addClass('placeholder');
					input.val(input.attr('placeholder'));
				}
			}).blur();		
			
			$('[placeholder]').parents('form').submit(function() {
				$(this).find('[placeholder]').each(function() {
					var input = $(this);
					if (input.val() == input.attr('placeholder')) {
						input.val('');
					}
				})
			});
			
		}
		
		//Fancybox for all links to images.
		//Required Scripts  & Styles are enqueued from functions.php
		$( 'a[href*=".jpg"], a[href*=".png"], a[href*=".gif"]' ).fancybox();
		
	} );	

})(this.jQuery);