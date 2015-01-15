<div class="nails-shop-skin-front-classic browse brand">
	<div class="row">
		<div class="col-md-12">
			<h1><?=$shop_name . ': Brands'?></h1>
			<?php

				//	Prepare the breadcrumbs
				$_crumbs	= array();

				$_crumbs[]	= array(
					'id'	=> NULL,
					'label'	=> 'Brands',
					'url'	=> $shop_url . 'brand'
				);

				$this->load->view( $skin_front->path . 'views/front/_components/browse_breadcrumb', array( 'crumbs' => $_crumbs, 'active_id' => NULL ) );

			?>
		</div>
	</div>
	<?php

		if ( ! empty( $brands ) ) :

			$_per_row	= 2;
			$_counter	= 0;
			$_row_open	= FALSE;

			foreach ( $brands as $brand ) :

				if ( empty( $_row_open ) ) :

					$_row_open = TRUE;
					echo '<div class="row">';

				endif;

				$_background = $brand->cover_id ? 'style="background-image: url(' . cdn_thumb( $brand->cover_id, 800, 800 ) . ')"' : '';

				echo '<div class="col-sm-6">';
					echo '<div class="panel panel-default brand" ' . $_background . '>';
						echo '<div class="panel-body small">';
							echo '<div class="mask"></div>';
							echo '<p><strong>' . anchor( $brand->url, $brand->label ) . '</strong></p>';
							echo $brand->seo_description ? '<p>' . $brand->seo_description . '</p>' : '';
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
					echo '<p>No Brands were found.</p>';
				echo '</div>';
			echo '</div>';

		endif;

	?>
</div>