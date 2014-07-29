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

			$this->load->view( $skin->path . 'views/front/_components/browse_breadcrumb' );

			// --------------------------------------------------------------------------

			if ( trim( strip_tags( $category->description ) ) ) :

				echo '<div class="description">';
					echo $category->description;
				echo '</div>';

			endif;

		?>
	</div>
</div>