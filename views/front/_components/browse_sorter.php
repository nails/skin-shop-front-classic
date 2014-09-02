<div class="product-sort panel panel-default">
	<div class="mask">
		<span class="fa fa-refresh fa-spin"></span>
	</div>
	<div class="panel-body small">
	<?php

		//	Build the URL, remove any pagination malarky
		$_url = site_url( preg_replace( '#/\\d+$#', '', uri_string() ) );

		echo form_open( $_url, 'method="GET"' );

			//	Maintain any other get params
			$_get = array_filter( (array) $this->input->get() );

			unset( $_get['per_page'] );
			unset( $_get['sort'] );

			$_get = http_build_query( $_get );
			$_get = explode( '&', $_get );

			foreach ( $_get AS $param ) :

				$_param = explode( '=', $param );

				if ( count( $_param ) == 2 ) :

					echo form_hidden( urldecode( $_param[0] ), urldecode( $_param[1] ) );

				endif;

			endforeach;

			// --------------------------------------------------------------------------

			echo '<div class="pull-left">';

				$_options			= array();
				$_options['20']		= '20';
				$_options['40']		= '40';
				$_options['80']		= '80';
				$_options['100']	= '100';
				$_options['all']	= 'All';

				echo form_dropdown( 'per_page', $_options, $product_pagination->per_page );

			echo '&nbsp;&nbsp;per page';
			echo '</div>';

			echo '<div class="pull-right">';
				echo 'Sort by&nbsp;&nbsp;';

				$_options					= array();
				$_options['recent']			= 'Recently Added';
				$_options['price-low-high']	= 'Price: Low to High';
				$_options['price-high-low']	= 'Price: High to Low';
				$_options['a-z']			= 'A to Z';

				echo form_dropdown( 'sort', $_options, $product_sort->sort );

				echo '<noscript>';
					echo '<button type="submit" class="btn btn-primary btn-xs" style="margin-left:0.5em">';
						echo 'Apply';
					echo '</button>';
				echo '</noscript>';
			echo '</div>';

		echo form_close();
	?>
	</div>
</div>