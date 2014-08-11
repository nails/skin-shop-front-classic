<div class="nails-skin-shop-classic browse brand single">
	<?php

		$this->load->view( $skin->path . 'views/front/_components/cover_brand' );

		echo '<div class="row">';

			echo '<div class="col-md-9 col-md-push-3">';

				$this->load->view( $skin->path . 'views/front/_components/browse_products' );

			echo '</div>';

			$this->load->view( $skin->path . 'views/front/_components/sidebar_brand' );

		echo '</div>';

	?>
</div>