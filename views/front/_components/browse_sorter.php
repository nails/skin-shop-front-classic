<div class="product-sort panel panel-default">
	<div class="mask">
		<span class="ion-refreshing"></span>
	</div>
	<div class="panel-body small">
	<?php

		echo form_open( NULL, 'method="GET"' );

			echo '<div class="pull-left">';

				$_options			= array();
				$_options['5']		= '5';
				$_options['10']		= '10';
				$_options['25']		= '25';
				$_options['50']		= '50';
				$_options['100']	= '100';
				$_options['all']	= 'All';

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