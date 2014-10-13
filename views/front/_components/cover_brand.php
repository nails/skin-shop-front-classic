<div class="row cover category">
	<div class="col-xs-12">
		<?php

			if ( ! empty( $brand->cover_id ) ) :

				$_url	= cdn_scale( $brand->cover_id, 1000, 500 );
				$_style	= 'style="background-image:url(' . $_url . ');background-size:cover;"';

			else :

				$_style = '';

			endif;

			echo '<div class="background brand" ' . $_style . '>';
				echo '<div class="overlay">';
					echo '<h2>' . $brand->label . '</h2>';
				echo '</div>';
			echo '</div>';

			// --------------------------------------------------------------------------

			//	Prepare the breadcrumbs
			$_crumbs	= array();

			$_crumbs[]	= array(
				'id'	=> NULL,
				'label'	=> 'Brands',
				'url'	=> app_setting( 'page_brand_listing', 'shop' ) ? $shop_url . 'brand' : NULL
			);

			$_crumbs[]	= array(
				'id'	=> $brand->id,
				'label'	=> $brand->label,
				'url'	=> $brand->url
			);

			$this->load->view( $skin_front->path . 'views/front/_components/browse_breadcrumb', array( 'crumbs' => $_crumbs, 'active_id' => $brand->id ) );

			// --------------------------------------------------------------------------

			if ( trim( strip_tags( $brand->description ) ) ) :

				echo '<div class="description">';
					echo $brand->description;
				echo '</div>';

			endif;

		?>
	</div>
</div>