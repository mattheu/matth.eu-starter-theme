<?php

add_action( 'wp_footer', function() {

	if ( ! current_user_can( 'manage_options' ) )
		return;

	?>

	<!-- <div id="grid-overlay-toggle" style="position: fixed; top: 10px; right: 10px; ">
		<button id="tpp-grid-overlay-on" style="display: none;" class="btn">Show Grid</button>
		<button id="tpp-grid-overlay-off" style="display: none;" class="btn">Hide Grid</button>
	</div> -->

	<div id="grid-overlay" style="display:none;">
		<div class="wrap">
		<div class="row show-grid">
			<div class="grid-1"><div class="grid-content"></div></div><div class="grid-1"><div class="grid-content"></div></div><div class="grid-1"><div class="grid-content"></div></div><div class="grid-1"><div class="grid-content"></div></div><div class="grid-1"><div class="grid-content"></div></div><div class="grid-1"><div class="grid-content"></div></div><div class="grid-1"><div class="grid-content"></div></div><div class="grid-1"><div class="grid-content"></div></div><div class="grid-1"><div class="grid-content"></div></div><div class="grid-1"><div class="grid-content"></div></div><div class="grid-1"><div class="grid-content"></div></div><div class="grid-1"><div class="grid-content"></div></div>
		</div>

		<div id="baseline-grid">
			<div class="baseline-grid-row"></div>
		</div>

		</div>
	</div>

	<script type="text/javascript" >
	
		var mphGridOverlay = {

			overlay : document.getElementById('grid-overlay'),
			button  : document.createElement('a'),
			
			buttonTextOff  : 'Show Grid',
			buttonTextOn  : 'Hide Grid',

			insertButton : function() {
				var button = this.button,
				    adminBarContainer = document.getElementById( 'wp-admin-bar-top-secondary' ),
				    li = document.createElement( 'li' );

				if ( 'null' === typeof( adminBarContainer ) )
					return;

				button.setAttribute( 'href', '#');
				button.setAttribute('class', 'ab-item' );

				button.appendChild( document.createTextNode( this.buttonTextOff ) );
				li.appendChild( button );
				adminBarContainer.appendChild( li );
				li.style.width = button.offsetWidth + 'px';
			},

			toggleDisplay : function(e,el) {
				this.overlay.style.display = ( this.overlay.style.display === 'block' ) ? 'none' : 'block';
				this.button.innerHTML = '';
				this.button.appendChild( 
					document.createTextNode( ( this.overlay.style.display === 'block' ) ? this.buttonTextOff : this.buttonTextOn ) 
				);
			},

			/**
			 * Add baseline rows until the screen is filled.
			 * @return {[type]} [description]
			 */
			baselineFillRows : function() {

				var baseLineGrid    = document.getElementById('baseline-grid'),
					baseLineGridRow = baseLineGrid.getElementsByTagName('div');

				// Get height.
				this.overlay.style.display='block';
				var baseLineGridRowHeight = baseLineGridRow[0].clientHeight;
				this.overlay.style.display='none';

				baseLineGrid.innerHTML = '';

				for ( var i = 0; i < ( window.innerHeight / baseLineGridRowHeight ); i++ ) {
					var newEl = document.createElement( 'div');
					newEl.setAttribute('class', 'baseline-grid-row' );
					baseLineGrid.appendChild( newEl );
				}

			},

			init : function() {
				
				var self = this;
				self.overlay.style.display = 'none';
				self.insertButton();
				self.button.addEventListener( 'click', function(e) { self.toggleDisplay.call( self, e, this ) } );
				
				this.baselineFillRows();
			}

		}

		jQuery(document).ready( function() {

			mphGridOverlay.init();

		} );
		

		// new function() {

		// 	var gridOverlay    = document.getElementById('grid-overlay'),
		// 	    gridOverlayOn  = document.getElementById('tpp-grid-overlay-on'),
		// 	    gridOverlayOff = document.getElementById('tpp-grid-overlay-off');

	 //   		gridOverlayOn.style.display='block';
		// 	gridOverlayOff.style.display='none';

		// 	gridOverlayOn.addEventListener( 'click', function(){
		// 		gridOverlay.style.display='block';
		// 		gridOverlayOn.style.display='none';
		// 		gridOverlayOff.style.display='block';
		// 	});

		// 	gridOverlayOff.addEventListener( 'click', function(){
		// 		gridOverlay.style.display='none';
		// 		gridOverlayOn.style.display='block';
		// 		gridOverlayOff.style.display='none';
		// 	} );

		// 	// Baseline
		// 	var baseLineGrid = document.getElementById('baseline-grid');
		// 	var baseLineGridRow = baseLineGrid.getElementsByTagName('div');

		// 	var fillRows = function() {

		// 		// Get height.
		// 		gridOverlay.style.display='block';
		// 		var baseLineGridRowHeight = baseLineGridRow[0].clientHeight;
		// 		gridOverlay.style.display='none';

		// 		baseLineGrid.innerHTML = '';

		// 		for ( var i = 0; i < ( window.innerHeight / baseLineGridRowHeight ); i++ ) {
		// 			var newEl = document.createElement( 'div');
		// 			console.log( newEl );
		// 			newEl.setAttribute('class', 'baseline-grid-row' );
		// 			baseLineGrid.appendChild( newEl );
		// 		}

		// 	}

		// 	fillRows();

		// }

	</script>

	<?php

}, 20 );

add_action( 'wp_footer', function() {

	return;

	?>

	<div id="grid-demo" class="wrap" style="display:block;">

		<div class="row show-grid">
			<div class="grid-1"><div class="grid-content">1</div></div>
			<div class="grid-1"><div class="grid-content">1</div></div>
			<div class="grid-1"><div class="grid-content">1</div></div>
			<div class="grid-1"><div class="grid-content">1</div></div>
			<div class="grid-1"><div class="grid-content">1</div></div>
			<div class="grid-1"><div class="grid-content">1</div></div>
			<div class="grid-1"><div class="grid-content">1</div></div>
			<div class="grid-1"><div class="grid-content">1</div></div>
			<div class="grid-1"><div class="grid-content">1</div></div>
			<div class="grid-1"><div class="grid-content">1</div></div>
			<div class="grid-1"><div class="grid-content">1</div></div>
			<div class="grid-1"><div class="grid-content">1</div></div>
		</div>
		<div class="row show-grid">
			<div class="grid-2"><div class="grid-content">2</div></div>
			<div class="grid-2"><div class="grid-content">2</div></div>
			<div class="grid-2"><div class="grid-content">2</div></div>
			<div class="grid-6"><div class="grid-content">6</div></div>
		</div>
		<div class="row show-grid">
			<div class="grid-3"><div class="grid-content">3</div></div>
			<div class="grid-4"><div class="grid-content">4</div></div>
			<div class="grid-5"><div class="grid-content">5</div></div>
		</div>
		<div class="row show-grid">
			<div class="grid-8"><div class="grid-content">8</div></div>
			<div class="grid-4"><div class="grid-content">4</div></div>
		</div>
		<div class="row show-grid">
			<div class="grid-7"><div class="grid-content">7</div></div>
			<div class="grid-5"><div class="grid-content">5</div></div>
		</div>
		<div class="row show-grid">
			<div class="grid-9"><div class="grid-content">9</div></div>
			<div class="grid-3"><div class="grid-content">3</div></div>
		</div>
		<div class="row show-grid">
			<div class="grid-12"><div class="grid-content">12</div></div>
		</div>

		<div class="row show-grid">
			<div class="grid-8">
				<div class="row show-grid">
					<div class="grid-8"><div class="grid-content">8</div></div>
					<div class="grid-1"><div class="grid-content">1</div></div><div class="grid-2"><div class="grid-content">2</div></div><div class="grid-3"><div class="grid-content">3</div></div><div class="grid-1"><div class="grid-content">1</div></div><div class="grid-1"><div class="grid-content">1</div></div>
				</div>
			</div>
			<div class="grid-4">
				<div class="row show-grid">
					<div class="grid-4"><div class="grid-content">4</div></div>
					<div class="grid-1"><div class="grid-content">1</div></div><div class="grid-1"><div class="grid-content">1</div></div><div class="grid-2"><div class="grid-content">2</div></div>
				</div>
			</div>
		</div>

		<div class="row show-grid">
			<div class="grid-8">
				<div class="row show-grid">
					<div class="grid-8"><div class="grid-content">8</div></div>
					<div class="grid-1">
						<div class="row show-grid">
							<div class="grid-1"><div class="grid-content">1</div></div>
							<div class="grid-1"><div class="grid-content">1</div></div>
						</div>
					</div>
					<div class="grid-4">
						<div class="row show-grid">
							<div class="grid-4"><div class="grid-content">4</div></div>
							<div class="grid-2"><div class="grid-content">2</div></div>
							<div class="grid-2"><div class="grid-content">2</div></div>
						</div>
					</div>
					<div class="grid-3">
						<div class="row show-grid">
							<div class="grid-3"><div class="grid-content">3</div></div>
							<div class="grid-1"><div class="grid-content">1</div></div>
							<div class="grid-2"><div class="grid-content">2</div></div>
						</div>
					</div>
				</div>
			</div>
			<div class="grid-4">
				<div class="grid48"><div class="grid-content">4</div></div>
				<div class="row show-grid">
					<div class="grid-1"><div class="grid-content">1</div></div>
					<div class="grid-3"><div class="grid-content">3</div></div>
					<div class="grid-4">
						<div class="row show-grid">
							<div class="grid-2"><div class="grid-content">2</div></div>
							<div class="grid-2"><div class="grid-content">2</div></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php

} );
