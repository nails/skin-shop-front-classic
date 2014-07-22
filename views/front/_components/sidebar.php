<ul class="sidebar col-md-3 col-md-pull-9 list-unstyled">
<?php

	echo '<hr class="hidden-md hidden-lg" />';

	if ( ! empty( $categories_nested ) ) :

		echo '<li class="widget categories clearfix">';
			echo '<h3>Categories</h3>';
			echo _shop_sidebar_nested_categories_html( $categories_nested );
		echo '</li>';

	endif;

?>
</ul>