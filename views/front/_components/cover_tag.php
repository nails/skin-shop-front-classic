<div class="row cover tag">
	<div class="col-xs-12">
		<?php

			if ( ! empty( $tag->cover_id ) ) :

				$_url	= cdn_scale( $tag->cover_id, 1000, 500 );
				$_style	= 'style="background-image:url(' . $_url . ');background-size:cover;"';

			else :

				$_style = '';

			endif;

			echo '<div class="background tag" ' . $_style . '>';
				echo '<div class="overlay">';
					echo '<h2>' . $tag->label . '</h2>';
				echo '</div>';
			echo '</div>';

			// --------------------------------------------------------------------------

			//	Prepare the breadcrumbs
			$_crumbs	= array();

			$_crumbs[]	= array(
				'id'	=> NULL,
				'label'	=> 'Tags',
				'url'	=> app_setting( 'page_tag_listing', 'shop' ) ? $shop_url . 'tag' : NULL
			);

			$_crumbs[]	= array(
				'id'	=> $tag->id,
				'label'	=> $tag->label,
				'url'	=> $tag->url
			);

			$this->load->view( $skin_front->path . 'views/front/_components/browse_breadcrumb', array( 'crumbs' => $_crumbs, 'active_id' => $tag->id ) );

			// --------------------------------------------------------------------------

			if ( trim( strip_tags( $tag->description ) ) ) :

				echo '<div class="description">';
					echo $tag->description;
				echo '</div>';

			endif;

		?>
	</div>
</div>