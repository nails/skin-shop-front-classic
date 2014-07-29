<div class="nails-skin-shop-classic browse category single">
	<div class="row">
	<?php

		echo '<div class="col-md-9 col-md-push-3">';
			$this->load->view( $skin->path . 'views/front/_components/cover_category' );
			$this->load->view( $skin->path . 'views/front/_components/browse_products' );
		echo '</div>';

		$this->load->view( $skin->path . 'views/front/_components/sidebar_category' );

	?>
	</div>
</div>