<div class="nails-shop-skin-front-classic browse range">
	<div class="row">
		<div class="col-md-12">
			<h1><?=$shop_name . ': Ranges'?></h1>
			<?php

				//	Prepare the breadcrumbs
				$_crumbs	= array();

				$_crumbs[]	= array(
					'id'	=> NULL,
					'label'	=> 'Ranges',
					'url'	=> $shop_url . 'range'
				);

				$this->load->view( $skin_front->path . 'views/front/_components/browse_breadcrumb', array( 'crumbs' => $_crumbs, 'active_id' => NULL ) );

			?>
		</div>
	</div>
	<?php

		if ( ! empty( $ranges ) ) :

			$_per_row	= 2;
			$_counter	= 0;
			$_row_open	= FALSE;

			foreach ( $ranges AS $range ) :

				if ( empty( $_row_open ) ) :

					$_row_open = TRUE;
					echo '<div class="row">';

				endif;

				$_background = $range->cover_id ? 'style="background-image: url(' . cdn_thumb( $range->cover_id, 800, 800 ) . ')"' : '';

				echo '<div class="col-sm-6">';
					echo '<div class="panel panel-default range" ' . $_background . '>';
						echo '<div class="panel-body small">';
							echo '<div class="mask"></div>';
							echo '<p><strong>' . anchor( $range->url, $range->label ) . '</strong></p>';
							echo $range->seo_description ? '<p>' . $range->seo_description . '</p>' : '';
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
					echo '<p>No Ranges were found.</p>';
				echo '</div>';
			echo '</div>';

		endif;

	?>
</div>