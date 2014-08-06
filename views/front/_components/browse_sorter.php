<div class="product-sort panel panel-default">
	<div class="mask">
		<span class="fa fa-refresh fa-spin"></span>
	</div>
	<div class="panel-body small">
	<?php

		echo form_open( NULL, 'method="GET"' );

			//	Maintain any other get params
			$_get = array_filter( (array) $this->input->get() );

			unset( $_get['perpage'] );
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
				$_options['10']		= '10';
				$_options['25']		= '25';
				$_options['50']		= '50';
				$_options['100']	= '100';

				echo form_dropdown( 'perpage', $_options, $product_sort->perpage );

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