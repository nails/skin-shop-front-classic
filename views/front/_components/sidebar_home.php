<hr class="hidden-md hidden-lg" />
<div class="sidebar-home col-md-3 col-md-pull-9">
	<ul class="list-group">
	<?php

		if ( ! empty( $categories ) ) :

			echo '<li class="list-group-item">';
				echo '<h3 class="list-group-item-heading">Categories</h3>';
				echo '<ul class="list-unstyled rsaquo-list">';

					foreach( $categories AS $category ) :

						if ( app_setting( 'hide_empty_categories', 'shop-' . $skin->slug ) && empty( $category->product_count ) ) :

							continue;

						endif;

						echo '<li>';
							echo anchor( $category->url, $category->label );
						echo '</li>';

					endforeach;

				echo '</ul>';
			echo '</li>';

		endif;

		if ( ! empty( $brands ) ) :

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

		endif;

		if ( ! empty( $ranges ) ) :

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

		endif;

		if ( ! empty( $collections ) ) :

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

		endif;

	?>
	</ul>
</div>