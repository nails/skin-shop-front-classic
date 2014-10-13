<div class="row cover collection">
	<div class="col-xs-12">
		<?php

			if ( ! empty( $collection->cover_id ) ) :

				$_url	= cdn_scale( $collection->cover_id, 1000, 500 );
				$_style	= 'style="background-image:url(' . $_url . ');background-size:cover;"';

			else :

				$_style = '';

			endif;

			echo '<div class="background collection" ' . $_style . '>';
				echo '<div class="overlay">';
					echo '<h2>' . $collection->label . '</h2>';
				echo '</div>';
			echo '</div>';

			// --------------------------------------------------------------------------

			//	Prepare the breadcrumbs
			$_crumbs	= array();

			$_crumbs[]	= array(
				'id'	=> NULL,
				'label'	=> 'Collections',
				'url'	=> app_setting( 'page_collection_listing', 'shop' ) ? $shop_url . 'collection' : NULL
			);

			$_crumbs[]	= array(
				'id'	=> $collection->id,
				'label'	=> $collection->label,
				'url'	=> $collection->url
			);

			$this->load->view( $skin_front->path . 'views/front/_components/browse_breadcrumb', array( 'crumbs' => $_crumbs, 'active_id' => $collection->id ) );

			// --------------------------------------------------------------------------

			if ( trim( strip_tags( $collection->description ) ) ) :

				echo '<div class="description">';
					echo $collection->description;
				echo '</div>';

			endif;

		?>
	</div>
</div>