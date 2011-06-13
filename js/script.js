// remap jQuery to $
(function($){

/*
* Grid Overlay
*
*/
	$( document ).ready( function() {
		
		$('#show_grid').click( function() {
				$('body').wrapInner('<div id="grid" />');
		});
		
	} );	

})(this.jQuery);