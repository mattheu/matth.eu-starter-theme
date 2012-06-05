<?php


	$grid[] = array(
		'break-point' => 'default',
		'unit' => 'px',
		'col_count' => 12,
		'col_width' => 50,
		'gutter' => 10,
		'col_padding' => 10
	);
	$grid[] = array(
			'break-point' => 'max-width: 1020px',
			'unit' => 'px',
			'col_count' => 12,
			'col_width' => 40,
			'gutter' => 10,
			'col_padding' => 5
	);
	$grid[] = array(
			'break-point' => 'max-width: 740px',
			'total-width' => 90,
			'unit' => '%',
			'col_count' => 6,
			'col_width' => 12.666666667,
			'gutter' => 2,
			'col_padding' => 1
	);
	$grid[] = array(
			'break-point' => 'max-width: 480px',
			'total-width' => 95,
			'unit' => '%',
			'col_count' => 2,
			'col_width' => 12.666666667,
			'gutter' => 2,
			'col_padding' => 1
	);

?>

/**
 *	Grid Overlay
 *
 *	Note that grid.js is required to actually create this.
 *	Adjust this so that it fits the current grid layout.
 */

	#grid_overlay	  						{ position: fixed; left: 50%; top: 0; height: 100%; overflow: hidden; background: rgba(255,0,0,0.2);  pointer-events:none; z-index: 99999; }
	#grid_overlay div 						{ float: left; height: 100%; border-left: 0 solid rgba(255,0,0,0.1); border-right: 0 solid rgba(255,0,0,0.1);  margin-left: 0;  margin-right: 0; }

	#grid_overlay div:first-child			{ border-left: none; none; margin-left: 0; }
	#grid_overlay div:last-child			{ border-right: none; none; margin-right: 0; }
	
	#grid_overlay div span					{ display: block; height: 100%; background: rgba(255,0,0,0.15); border-right: 1px solid rgba(0,0,0,0.18); border-left: 1px solid rgba(0,0,0,0.18); }
	#grid_close								{ position: absolute; top: 0.75em; right: 10px; background: #FFF; border: 1px solid #000; padding: 0.375em 10px; opacity: 0.5; pointer-events: auto;  }

	.admin-bar #grid_close					{ margin-top: 28px; }
	#grid_close:hover						{ opacity: 1; text-decoration: none; }

	<?php foreach ( $grid as $break ) : ?>

		<?php

			$col_count = $break['col_count'];
			$col_width = $break['col_width'];
			$gutter    = $break['gutter'] + ( 2 * $break['col_padding'] );
			$unit      = $break['unit'];

			$total_width = ( ( empty( $break['total-width' ] ) ) ) ? ( $col_width + $gutter ) * $col_count : $break['total-width' ];

		?>

		<?php if ( 'default' != $break['break-point'] ) : ?>
		
 		    @media all and ( <?php echo $break['break-point']; ?> ) {
		
		<?php endif; ?>

			<?php if ( 'px' == $break['unit'] ) : ?>

				#grid_overlay {
					width: <?php echo $total_width . $unit; ?>;
					padding: 0 <?php echo ( $gutter / 2 ) . $unit; ?>;
					margin-left: -<?php echo ( ( $total_width + $gutter ) / 2 ) . $unit; ?>;
				}
				
				#grid_overlay div {
					width: <?php echo ( $col_width + $gutter ) . $unit; ?>;
					border-width: 0 <?php echo ( 0 != $break['col_padding'] ) ? ( $break['gutter'] / 2 ) : 0; ?>px; 
					margin: 0 -<?php echo ( 0 != $break['col_padding'] ) ? ( $break['gutter'] / 2 ) : 0; ?>px;
					
				}
				
				#grid_overlay div span {
					display: block;
					margin: 0 <?php echo ( $gutter / 2 ) . $unit; ?>;

				}

			<?php elseif ( '%' == $break['unit'] ) : ?>
		
				#grid_overlay {
					width: <?php echo $total_width . $unit; ?>;
					padding: 0;
					margin-left: <?php echo ( ( 100 - $total_width ) / 2 ) . $unit; ?>;
					left: 0;
				}
				
				#grid_overlay div {
					width: <?php echo ( $col_width + $gutter ) . $unit; ?>;
					border-width: 0; 
					margin: 0;
				}
				
				#grid_overlay div span {
					display: block;
					margin: 0 <?php echo ( ( $gutter / 2 ) / ( ( ( $col_width + $gutter ) ) / 100 ) ) . $unit; ?>;
				}

			<?php endif; ?>

		<?php if ( 'default' != $break['break-point'] ) : ?>
		
			}
		
		<?php endif; ?>

	<?php
		endforeach;
	?>