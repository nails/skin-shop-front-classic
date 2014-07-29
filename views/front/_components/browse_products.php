<div class="product-browser row">
	<div class="col-xs-12">
	<?php

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

			// --------------------------------------------------------------------------

			$this->load->view( $skin->path . 'views/front/_components/browse_sorter' );

			// --------------------------------------------------------------------------

			foreach ( $products AS $product ) :

				if ( empty( $_row_open ) ) :

					$_row_open = TRUE;
					echo '<div class="row">';

				endif;

				echo '<div class="product ' . implode( ' ', $_class ) . '">';

					if ( $product->featured_img ) :

						$_url = cdn_thumb( $product->featured_img, 800, 800 );

					else :

						$_url = $skin->url . 'assets/img/product-no-image.png';

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

			// --------------------------------------------------------------------------

			echo '<hr />';
			$this->load->view( $skin->path . 'views/front/_components/browse_sorter' );
			$this->load->view( $skin->path . 'views/front/_components/browse_pagination' );

		else :

			echo 'No products found';

		endif;

	?>
	</div>
</div>