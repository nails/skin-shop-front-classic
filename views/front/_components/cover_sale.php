<div class="row cover sale">
	<div class="col-xs-12">
		<?php

			if ( ! empty( $sale->cover_id ) ) :

				$_url	= cdn_scale( $sale->cover_id, 1000, 500 );
				$_style	= 'style="background-image:url(' . $_url . ');background-size:cover;"';

			else :

				$_style = '';

			endif;

			echo '<div class="background sale" ' . $_style . '>';
				echo '<div class="overlay">';
					echo '<h2>' . $sale->label . '</h2>';
				echo '</div>';
			echo '</div>';

			// --------------------------------------------------------------------------

			//	Prepare the breadcrumbs
			$_crumbs	= array();

			$_crumbs[]	= array(
				'id'	=> NULL,
				'label'	=> 'Sales',
				'url'	=> app_setting( 'page_sale_listing', 'shop' ) ? $shop_url . 'sale' : NULL
			);

			$_crumbs[]	= array(
				'id'	=> $sale->id,
				'label'	=> $sale->label,
				'url'	=> $sale->url
			);

			$this->load->view( $skin_front->path . 'views/front/_components/browse_breadcrumb', array( 'crumbs' => $_crumbs, 'active_id' => $sale->id ) );

			// --------------------------------------------------------------------------

			if ( trim( strip_tags( $sale->description ) ) ) :

				echo '<div class="description">';
					echo $sale->description;
				echo '</div>';

			endif;

		?>
	</div>
</div>