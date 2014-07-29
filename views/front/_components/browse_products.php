<div class="products col-md-9 col-md-push-3 ">
<?php

	if ( ! empty( $category ) ) :

		echo '<h3 class="products-label text-center hidden-md hidden-lg">' . $category->label . '</h3>';
		echo '<h3 class="products-label hidden-xs hidden-sm">' . $category->label . '</h3>';
		echo '<ol class="breadcrumb">';

			echo '<li>';
				echo anchor( app_setting( 'url', 'shop' ), app_setting( 'name', 'shop' ) );
			echo '</li>';

			foreach( $category->breadcrumbs AS $crumb ) :

				echo '<li>';

					if( $crumb->id == $category->id ) :

						echo $crumb->label;

					else :

						echo anchor( $this->shop_category_model->format_url( $crumb->slug ), $crumb->label );

					endif;

				echo '</li>';

			endforeach;
		echo '</ol>';

	else :

		echo '<h3 class="products-label text-center hidden-md hidden-lg">' . app_setting( 'name', 'shop' ) . '</h3>';
		echo '<h3 class="products-label hidden-xs hidden-sm">' . app_setting( 'name', 'shop' ) . '</h3>';

	endif;

	if ( ! empty( $products ) ) :

		$_products_per_row	= array();
		$_class				= array();
		$_counter			= 0;
		$_row_open			= FALSE;

		$_products_per_row['lg']	= 4;
		$_products_per_row['md']	= 4;
		$_products_per_row['sm']	= 2;
		$_products_per_row['xs']	= 1;

		foreach ( $_products_per_row AS $breakpoint => $value ) :

			$_class[] = 'col-' . $breakpoint . '-' . floor( APP_BOOTSTRAP_GRID / $value );

		endforeach;

		foreach ( $products AS $product ) :

			if ( empty( $_row_open ) ) :

				$_row_open = TRUE;
				echo '<div class="row">';

			endif;

			echo '<div class="product ' . implode( ' ', $_class ) . '">';

				if ( $product->featured_img ) :

					$_url = cdn_thumb( $product->featured_img, 800, 800 );

				else :

					$_url = cdn_placeholder( 250, 250 );

				endif;

				echo '<div class="product-image">';
					echo anchor( $product->url, img( array( 'src' => $_url, 'class' => 'img-responsive img-thumbnail center-block' ) ) );
				echo '</div>';

				echo '<p>' . anchor( $product->url, $product->label ) . '</p>';
				echo '<p>';
					echo '<span class="badge">' . $product->price->user_formatted->price_string . '</span>';
				echo '</p>';
				echo '<hr class="hidden-sm hidden-md hidden-lg" />';
			echo '</div>';


			if ( $_counter%$_products_per_row['lg'] == $_products_per_row['lg']-1 ) :

				$_row_open = FALSE;
				echo '</div>';

			endif;

			$_counter++;

		endforeach;

		if ( ! empty( $_row_open ) ) :

			$_row_open = FALSE;
			echo '</div>';

		endif;

	else :

		echo 'No products found';

	endif;

?>
</div>