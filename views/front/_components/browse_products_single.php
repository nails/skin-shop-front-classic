<?php

	if ( $product->featured_img ) :

		$_url = cdn_thumb( $product->featured_img, 800, 800 );

	else :

		$_url = $skin->url . 'assets/img/product-no-image.png';

	endif;

	echo '<div class="product-image">';
		echo anchor( $product->url, img( array( 'src' => $_url, 'class' => 'img-responsive img-thumbnail center-block' ) ) );

		if ( count( $product->variations ) > 1 ) :

			if ( app_setting( 'browse_product_ribbon_mode', 'shop-' . $skin->slug ) == 'corner' ) :

				echo '<div class="ribbon corner">';
					echo '<div class="ribbon-wrapper">';
						echo '<div class="ribbon-text">' . count( $product->variations ) . ' options' . '</div>';
					echo '</div>';
				echo '</div>';

			else :

				echo '<div class="ribbon horizontal">';
					echo count( $product->variations ) . ' options available';
				echo '</div>';

			endif;

		endif;

	echo '</div>';

	echo '<p>' . anchor( $product->url, $product->label ) . '</p>';
	echo '<p>';
		echo '<span class="badge">' . $product->price->user_formatted->price_string . '</span>';
	echo '</p>';
	echo '<hr class="hidden-sm hidden-md hidden-lg" />';