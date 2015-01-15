<div class="nails-shop-skin-front-classic browse collection">
	<div class="row">
		<div class="col-md-12">
			<h1><?=$shop_name . ': Collections'?></h1>
			<?php

				//	Prepare the breadcrumbs
				$_crumbs	= array();

				$_crumbs[]	= array(
					'id'	=> NULL,
					'label'	=> 'Collections',
					'url'	=> $shop_url . 'collection'
				);

				$this->load->view( $skin_front->path . 'views/front/_components/browse_breadcrumb', array( 'crumbs' => $_crumbs, 'active_id' => NULL ) );

			?>
		</div>
	</div>
	<?php

		if ( ! empty( $collections ) ) :

			$_per_row	= 2;
			$_counter	= 0;
			$_row_open	= FALSE;

			foreach ( $collections as $collection ) :

				if ( empty( $_row_open ) ) :

					$_row_open = TRUE;
					echo '<div class="row">';

				endif;

				$_background = $collection->cover_id ? 'style="background-image: url(' . cdn_thumb( $collection->cover_id, 800, 800 ) . ')"' : '';

				echo '<div class="col-sm-6">';
					echo '<div class="panel panel-default collection" ' . $_background . '>';
						echo '<div class="panel-body small">';
							echo '<div class="mask"></div>';
							echo '<p><strong>' . anchor( $collection->url, $collection->label ) . '</strong></p>';
							echo $collection->seo_description ? '<p>' . $collection->seo_description . '</p>' : '';
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
					echo '<p>No Collections were found.</p>';
				echo '</div>';
			echo '</div>';

		endif;

	?>
</div>