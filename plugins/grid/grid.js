
$( document ).ready( function($) {

		/**
		 *	Dev Grid Overlay
		 *
		 *	'Show Grid' button added to the admin bar.
		 *	should be styled in the theme stylesheet.
		 */

		var button = $( '<li id="wp-admin-bar-show-grid" class=" hide-no-js"><a class="ab-item" tabindex="10" href="#">Show Grid</a></li>' );
		button.appendTo( $('#wp-admin-bar-top-secondary') );

		$( '#wp-admin-bar-show-grid a, .show-grid' ).live( 'click', function( e ) {
				e.preventDefault();
				var gridOverlay = '<div id="grid_overlay"><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div><div><span></span></div></div>';
				if( ! $('#grid_overlay').length ) {
					$('body').append( gridOverlay );
				} else {
					$('#grid_overlay').remove();
				}
		});

});