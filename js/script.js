// remap jQuery to $
(function($){

/*
* Grid Overlay
*
*/
	$( document ).ready( function() {
		
		$( 'hmtl' ).removeClass( 'no_js' ).addClass( 'js' )
		
		//Grid Overlay Code - for development purposes.
		$( '#mtf_show_grid' ).click( function() {
				$('body').wrapInner('<div id="grid" />');
		});
		
		//
		// Simple clearing of placeholders from text inputs & textareas
		//
		$( ':input[title]' ).live( 'focus', function() {
    		if( $( this ).val() == $( this ).attr( 'title' ) )
    			$( this ).val( '' ).removeClass('empty');
    	} );
    	$( ':input[title]' ).live( 'blur', function() {
    		if( $( this ).val() == '' && $( this ).attr( 'title' ) > '' )
    			$( this ).val( $( this ).attr( 'title' ) ).addClass('empty');
		});
		$( ':input[title]' ).each( function() {
			if ( $( this ).val() == '' ) {
				$( this ).val( $( this ).attr( 'title' ) );
			}
		} );
    	$( ':textarea[title]' ).live( 'focus', function() {
    		if( $( this ).text() == $( this ).attr( 'title' ) )
    			$( this ).text( '' ).removeClass('empty');
    		
    	} );
    	$( ':textarea[title]' ).live( 'blur', function() {
    		if( $( this ).text() == '' && $( this ).attr( 'title' ) > '' )
    			$( this ).text( $( this ).attr( 'title' ) ).addClass('empty');
		});
		$( ':textarea[title]' ).each( function() {
			if ( $( this ).text() == '' ) {
				$( this ).text( $( this ).attr( 'title' ) );
			}
		} );		
		
	} );	

})(this.jQuery);