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

			$this->load->view( $skin_front->path . 'views/front/_components/browse_sorter' );

			// --------------------------------------------------------------------------

			foreach ( $products AS $product ) :

				if ( empty( $_row_open ) ) :

					$_row_open = TRUE;
					echo '<div class="row">';

				endif;

				echo '<div class="product ' . implode( ' ', $_class ) . '">';

					$this->load->view( $skin_front->path . 'views/front/_components/browse_products_single', array( 'product' => $product ) );

				echo '</div>';


				if ( $_counter % $_products_per_row['lg'] == $_products_per_row['lg'] - 1 ) :

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
			$this->load->view( $skin_front->path . 'views/front/_components/browse_sorter' );
			$this->load->view( $skin_front->path . 'views/front/_components/browse_pagination' );

		else :

			echo '<p class="alert alert-warning">';
				echo '<strong>Sorry,</strong> no products were found.';
			echo '</p>';

		endif;

	?>
	</div>
</div>