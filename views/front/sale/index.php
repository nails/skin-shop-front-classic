<div class="nails-shop-skin-front-classic browse sale">
	<div class="row">
		<div class="col-md-12">
			<h1><?=$shop_name . ': Sales'?></h1>
			<?php

				//	Prepare the breadcrumbs
				$_crumbs	= array();

				$_crumbs[]	= array(
					'id'	=> NULL,
					'label'	=> 'Sales',
					'url'	=> $shop_url . 'sale'
				);

				$this->load->view( $skin_front->path . 'views/front/_components/browse_breadcrumb', array( 'crumbs' => $_crumbs, 'active_id' => NULL ) );

			?>
		</div>
	</div>
	<?php

		if ( ! empty( $sales ) ) :

			$_per_row	= 2;
			$_counter	= 0;
			$_row_open	= FALSE;

			foreach ( $sales AS $sale ) :

				if ( empty( $_row_open ) ) :

					$_row_open = TRUE;
					echo '<div class="row">';

				endif;

				$_background = $sale->cover_id ? 'style="background-image: url(' . cdn_thumb( $sale->cover_id, 800, 800 ) . ')"' : '';

				echo '<div class="col-sm-6">';
					echo '<div class="panel panel-default sale" ' . $_background . '>';
						echo '<div class="panel-body small">';
							echo '<div class="mask"></div>';
							echo '<p><strong>' . anchor( $sale->url, $sale->label ) . '</strong></p>';
							echo $sale->seo_description ? '<p>' . $sale->seo_description . '</p>' : '';
						echo '</div>';
					echo '</div>';
				echo '</div>';

				if ( $_counter % $_per_row == $_per_row-1 ) :

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

			echo '<div class="row">';
				echo '<div class="col-md-12">';
					echo '<p>No Sales were found.</p>';
				echo '</div>';
			echo '</div>';

		endif;

	?>
</div>