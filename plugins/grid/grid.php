<?php


	$grid = array(

		0 => array(
			'break-point' => 'default',
			'unit' => 'px',
			'col_count' = 12,
			'col_width' = 60,
			'gutter' = 20
		),
		1 => array(
			'break-point' => '1020',
			'unit' => 'px',
			'col_count' = 12,
			'col_width' = 40,
			'gutter' = 20
		),
		2 => array(
			'break-point' => '720',
			'unit' => '%',
			'col_count' = 4,
			'col_width' = 60,
			'gutter' = 20
		)

	);





?>

/**
 *	Grid Overlay
 *
 *	Note that grid.js is required to actually create this.
 *	Adjust this so that it fits the current grid layout.
 */

	#grid_overlay	  						{ position: fixed; left: 50%; top: 0; height: 100%; overflow: hidden; background: rgba(255,0,0,0.2);  pointer-events:none;  }
	#grid_overlay div 						{ float: left; height: 100%; border-left: 1px solid rgba(0,0,0,0.1); margin-left: -1px; }
	#grid_overlay div:first-child			{ border: none; margin: 0; }
	#grid_overlay div span					{ display: block; height: 100%; background: rgba(255,0,0,0.15); border-right: 1px solid rgba(0,0,0,0.18); border-left: 1px solid rgba(0,0,0,0.18); }
	#grid_close								{ position: absolute; top: 0.75em; right: 10px; background: #FFF; border: 1px solid #000; padding: 0.375em 10px; opacity: 0.5; pointer-events: auto;  }

	.admin-bar #grid_close					{ margin-top: 28px; }
	#grid_close:hover						{ opacity: 1; text-decoration: none; }

	<?php
		foreach( $grid as $break ) :

		$col_count = $break['col_count' ];
		$total_width = ( $col_width + $gutter ) * $col_count;

	?>

		<?php if( 'default' != $break['break-point'] ) : ?>
 			@media all and (max-width: <?php echo $break['break-point']) {
		<?php endif; ?>

		#grid_overlay { width: <?php echo $total_width; ?>px; padding: 0 <?php echo $gutter / 2; ?>px;  margin-left: -<?php echo ( $total_width + $gutter ) / 2;?>px; }
		#grid_overlay div 						{ width: <?php echo $col_width + $gutter; ?>px; }
		#grid_overlay div span					{ display: block; margin: 0 <?php echo $gutter / 2; ?>px; }

		<?php if( 'default' != $break['break-point'] ) : ?>

		<?php endif; ?>

	<?php
		endforeach;
	?>