<?php get_template_part( 'header', 'head' ); ?>

<body <?php body_class(); ?>>

	<div class="wrap" >

		<header class="site-header">

			<h1 class="logo"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('site_name'); ?></a></h1>
			<div class="site-description"><?php bloginfo('description'); ?></div>

			<?php get_template_part( 'parts/nav-main' ); ?>

		</header>

<?php


		// Width of children. Gets 1 col smaller each time.
		$w0 = 100;
		$w1 = 96;
		$w2 = (5/6*100-4) / $w1 * 100;
		$w3 = (4/6*100-4) / $w2 * 100 / $w1 * 100;
		$w4 = (3/6*100-4) / $w3 * 100 / $w2 * 100 / $w1 * 100;
		$w5 = (2/6*100-4) / $w4 * 100 / $w3 * 100 / $w2 * 100 / $w1 * 100;

		// margin-left. equivalent to 1 col + 2 * padding
		$m0 = 16.66667;
		$m1 = $m0 / $w1 * 100;
		$m2 = $m0 / $w1 * 100 / $w2 * 100;
		$m3 = $m0 / $w1 * 100 / $w2 * 100 / $w3 * 100;
		$m4 = $m0 / $w1 * 100 / $w2 * 100 / $w3 * 100 / $w4 * 100;
		$m5 = $m0 / $w1 * 100 / $w2 * 100 / $w3 * 100 / $w4 * 100 / $w5 * 100;



		// margin right. equivalent to 2 * padding
		$p0 = 4;
		$p1 = $p0 / $w1 * 100;
		$p2 = $p0 / $w1 * 100 / $w2 * 100;
		$p3 = $p0 / $w1 * 100 / $w2 * 100 / $w3 * 100;
		$p4 = $p0 / $w1 * 100 / $w2 * 100 / $w3 * 100 / $w4 * 100;
		$p5 = $p0 / $w1 * 100 / $w2 * 100 / $w3 * 100 / $w4 * 100 / $w5 * 100;

		/*
		hm( $w1 );
		hm( $w2 );
		hm( $w3 );
		hm( $w4 );
		hm( $w5 );

		hm( $m1 );
		hm( $m2 );
		hm( $m3 );
		hm( $m4 );
		hm( $m5 );

		hm( $p1 );
		hm( $p2 );
		hm( $p3 );
		hm( $p4 );
		hm( $p5 );
		*/