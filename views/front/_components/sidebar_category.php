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
						echo anchor( app_setting( 'url', 'shop' ), app_setting( 'name', 'shop' ) );
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
	<?=form_open( NULL, 'method="GET"' )?>
		<ul class="list-group filters">
			<li class="list-group-item">
				<?php for ( $i=0; $i < 1; $i++ ) : ?>
				<p class="filter-heading">
					<strong>Filter</strong>
				</p>
				<ul class="filter-list list-unstyled">

					<?php for ( $x=0; $x < 10; $x++ ) : ?>
					<li>
						<label>
							<?php

								$_checked = ! empty( $_GET['filter'][$i][$x] ) ? TRUE : FALSE;
								echo form_checkbox( 'filter[' . $i . '][' . $x . ']', TRUE, $_checked );

							?>
							Lorem Ipsum
						</label>
					</li>
					<?php endfor; ?>
				</ul>
				<?php endfor; ?>
			</li>
			<li class="list-group-item text-center">
				<button type="submit" class="btn btn-block btn-primary">
					Update Results
				</button>
			</li>
		</ul>
	<?=form_close()?>
</div>