<hr class="hidden-md hidden-lg" />
<ul class="sidebar-home col-md-3 col-md-pull-9 list-group">
<?php

	echo '<li class="list-group-item">';
		echo '<h3 class="list-group-item-heading">Categories</h3>';
		echo '<ul class="list-unstyled rsaquo-list">';

			foreach( $categories AS $category ) :

				echo '<li>';
					echo anchor( $category->url, $category->label );
				echo '</li>';

			endforeach;

		echo '</ul>';
	echo '</li>';

	echo '<li class="list-group-item">';
		echo '<h3 class="list-group-item-heading">Brands</h3>';
		echo '<ul class="list-unstyled rsaquo-list">';

			foreach( $brands AS $brand ) :

				echo '<li>';
					echo anchor( $brand->url, $brand->label );
				echo '</li>';

			endforeach;

		echo '</ul>';
	echo '</li>';

	echo '<li class="list-group-item">';
		echo '<h3 class="list-group-item-heading">Ranges</h3>';
		echo '<ul class="list-unstyled rsaquo-list">';

			foreach( $ranges AS $range ) :

				echo '<li>';
					echo anchor( $range->url, $range->label );
				echo '</li>';

			endforeach;

		echo '</ul>';
	echo '</li>';

	echo '<li class="list-group-item">';
		echo '<h3 class="list-group-item-heading">Collections</h3>';
		echo '<ul class="list-unstyled rsaquo-list">';

			foreach( $collections AS $collection ) :

				echo '<li>';
					echo anchor( $collection->url, $collection->label );
				echo '</li>';

			endforeach;

		echo '</ul>';
	echo '</li>';

?>
</ul>