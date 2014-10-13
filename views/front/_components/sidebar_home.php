<hr class="hidden-md hidden-lg" />
<div class="sidebar-home col-md-3 col-md-pull-9">
	<ul class="list-group">
	<?php

		if ( ! empty( $categories ) ) :

			echo '<li class="list-group-item">';
				echo '<h3 class="list-group-item-heading">Categories</h3>';
				echo '<ul class="list-unstyled rsaquo-list">';

					foreach( $categories AS $category ) :

						if ( app_setting( 'hide_empty_categories', 'shop-' . $skin_front->slug ) && empty( $category->product_count ) ) :

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

						if ( app_setting( 'hide_empty_brands', 'shop-' . $skin_front->slug ) && empty( $brand->product_count ) ) :

							continue;

						endif;

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

						if ( app_setting( 'hide_empty_ranges', 'shop-' . $skin_front->slug ) && empty( $range->product_count ) ) :

							continue;

						endif;

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

						if ( app_setting( 'hide_empty_collections', 'shop-' . $skin_front->slug ) && empty( $collection->product_count ) ) :

							continue;

						endif;

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