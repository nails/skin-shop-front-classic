<div class="sidebar-filter col-md-3 col-md-pull-9 hidden-xs hidden-sm">
	<ul class="list-group">
		<li class="list-group-item">
			<?php

				echo '<p>';
					echo '<strong>Categories</strong>';
				echo '</p>';

				$_indent = 0;

				echo '<ul class="list-unstyled rsaquo-list category-nav">';

					//	Home first
					echo '<li class="level-' . $_indent . '">';
						echo anchor( $shop_url, app_setting( 'name', 'shop' ) );
					echo '</li>';

					$_indent++;

					foreach ( $category->breadcrumbs AS $crumb ) :

						if ( $crumb->id == $category->id ) :

							echo '<li class="level-' . $_indent . ' current">';
								echo '<strong>' . $crumb->label . '</strong>';
							echo '</li>';

						else :

							echo '<li class="level-' . $_indent . '">';
								echo anchor( $this->shop_category_model->format_url( $crumb->slug ),$crumb->label );
							echo '</li>';

						endif;

						$_indent++;

					endforeach;

					foreach ( $category->children AS $crumb ) :

						echo '<li class="level-' . $_indent . '">';
							echo anchor( $this->shop_category_model->format_url( $crumb->slug ), $crumb->label );
						echo '</li>';

					endforeach;

					//	Bring the indent back down a level
					$_indent--;

					foreach ( $category_siblings AS $crumb ) :

						echo '<li class="level-' . $_indent . '">';
							echo anchor( $this->shop_category_model->format_url( $crumb->slug ), $crumb->label );
						echo '</li>';

					endforeach;

				echo '</ul>';

			?>
		</li>
	</ul>
	<?php

		$this->load->view( $skin->path . 'views/front/_components/sidebar_filters' );

	?>
</div>