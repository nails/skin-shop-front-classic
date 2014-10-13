<div class="row cover category">
	<div class="col-xs-12">
		<?php

			if ( ! empty( $category->cover_id ) ) :

				$_url	= cdn_scale( $category->cover_id, 1000, 500 );
				$_style	= 'style="background-image:url(' . $_url . ');background-size:cover;"';

			else :

				$_style = '';

			endif;

			echo '<div class="background category" ' . $_style . '>';
				echo '<div class="overlay">';
					echo '<h2>' . $category->label . '</h2>';
				echo '</div>';
			echo '</div>';

			// --------------------------------------------------------------------------

			//	Prepare the breadcrumbs
			$_crumbs = array();

			foreach( $category->breadcrumbs AS $crumb ) :

				$_crumbs[] = array(
					'id'	=> $crumb->id,
					'label'	=> $crumb->label,
					'url'	=> $this->shop_category_model->format_url( $crumb->slug )
				);

			endforeach;

			$this->load->view( $skin_front->path . 'views/front/_components/browse_breadcrumb', array( 'crumbs' => $_crumbs, 'active_id' => $category->id ) );

			// --------------------------------------------------------------------------

			if ( trim( strip_tags( $category->description ) ) ) :

				echo '<div class="description">';
					echo $category->description;
				echo '</div>';

			endif;

		?>
	</div>
</div>