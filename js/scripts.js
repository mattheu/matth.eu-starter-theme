// remap jQuery to $
(function($){

/*
* Grid Overlay
*
*/
	$( document ).ready( function() {
		
		$( 'html' ).removeClass( 'no-js' ).addClass( 'js' )
		
		/**
		 *	Grid Overlay Code
		 *
		 *	Added to the menu bar for development purposes.
		 */
		
		//Should we add this with PHP so that we can control who actually sees it?
		//$( '<li id="wp-admin-bar-show-grid" class=""><a class="ab-item" id="show-grid"  href="#">Show Grid</a></li>' ).appendTo( $( '#wp-admin-bar-top-secondary' ) );
		
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
		 *
		 *	Fake HTML5 Placeholder attribute support for older browsers.
		 *
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