<div class="row cover range">
	<div class="col-xs-12">
		<?php

			if ( ! empty( $range->cover_id ) ) :

				$_url	= cdn_scale( $range->cover_id, 1000, 500 );
				$_style	= 'style="background-image:url(' . $_url . ');background-size:cover;"';

			else :

				$_style = '';

			endif;

			echo '<div class="background range" ' . $_style . '>';
				echo '<div class="overlay">';
					echo '<h2>' . $range->label . '</h2>';
				echo '</div>';
			echo '</div>';

			// --------------------------------------------------------------------------

			//	Prepare the breadcrumbs
			$_crumbs	= array();

			$_crumbs[]	= array(
				'id'	=> NULL,
				'label'	=> 'Ranges',
				'url'	=> app_setting( 'page_range_listing', 'shop' ) ? $shop_url . 'range' : NULL
			);

			$_crumbs[]	= array(
				'id'	=> $range->id,
				'label'	=> $range->label,
				'url'	=> $range->url
			);

			$this->load->view( $skin->path . 'views/front/_components/browse_breadcrumb', array( 'crumbs' => $_crumbs, 'active_id' => $range->id ) );

			// --------------------------------------------------------------------------

			if ( trim( strip_tags( $range->description ) ) ) :

				echo '<div class="description">';
					echo $range->description;
				echo '</div>';

			endif;

		?>
	</div>
</div>