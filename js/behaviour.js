// remap jQuery to $
(function($){

/*
* Grid Overlay
*
*/
	$( document ).ready( function() {
		
		/**
		 *	Dev Grid Overlay
		 *
		 *	'Show Grid' button added to the admin bar.
		 *	should be styled in the theme stylesheet.
		 */
		$( '#wp-admin-bar-show-grid a, .show-grid' ).live( 'click', function( e ) {
				e.preventDefault();
				var gridOverlay = '<div id="grid_overlay"><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div></div>';
				if( ! $('#grid_overlay').length ) {
					$('body').append( gridOverlay );
				} else {
					$('#grid_overlay').remove();
				}
		});
		
		
		/**
		 *	Fake HTML5 Placeholder attribute support for older browsers.
		 */
		if( ! document.createElement('input') ) {
		
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
		
		//Fancybox etc can be applied to all links that point directly to image files.
		if( typeof $.fancybox == 'function' ) {
			$( 'a[href*=".jpg"], a[href*=".jpeg"], a[href*=".png"], a[href*=".gif"]' ).fancybox({
				'titlePosition'	: 'inside'
			});
		}	
		
	} );	

})(this.jQuery);


