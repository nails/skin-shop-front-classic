<?php

	if ( ! empty( $sidebar_filters ) ) :

		//	Build URLs for this page. The URL should not contain the pagination segment

		//	For the form
		$_form_url = site_url( preg_replace( '#/\\d+$#', '', uri_string() ) );

		// --------------------------------------------------------------------------

		//	For the links
		$_get = array();

		if ( $this->input->get_post( 'per_page' ) ) :

			$_get['per_page'] = $this->input->get_post( 'per_page' );

		endif;

		if ( $this->input->get_post( 'sort' ) ) :

			$_get['sort'] = $this->input->get_post( 'sort' );

		endif;

		$_get = http_build_query( $_get );
		$_get = $_get ? '?' . $_get : '';

		$_link_url = $_form_url . $_get;

		// --------------------------------------------------------------------------

		echo form_open( $_form_url, 'method="GET"' );

			//	Hidden fields so preferences get maintained
			if ( $this->input->get_post( 'per_page' ) ) :

				echo form_hidden( 'per_page', $this->input->get_post( 'per_page' ) );

			endif;

			if ( $this->input->get_post( 'sort' ) ) :

				echo form_hidden( 'sort', $this->input->get_post( 'sort' ) );

			endif;

			?>
			<ul class="list-group filters">
				<li class="list-group-item">
				<?php

					foreach ( $sidebar_filters AS $filter ) :

						echo '<p class="filter-heading">';
							echo '<strong>' . $filter->label . '</strong>';
						echo '</p>';
						echo '<ul class="filter-list list-unstyled">';

						foreach ( $filter->values AS $value ) :

							echo '<li>';
								echo '<label class="clearfix">';

									if ( isset( $_GET['f'][$filter->id] ) && is_array( $_GET['f'][$filter->id] ) ) :

										if ( array_search( $value->value, $_GET['f'][$filter->id] ) !== FALSE ) :

											$_checked = TRUE;

										else :

											$_checked = FALSE;

										endif;

									else :

										$_checked = FALSE;

									endif;

									echo form_checkbox( 'f[' . $filter->id . '][]', $value->value, $_checked );
									echo '<span class="filter-text">' . $value->label . '</span>';
									echo '<span class="filter-count pull-right">' . number_format( $value->product_count ) . '</span>';

								echo '</label>';
							echo '</li>';

						endforeach;

						echo '</ul>';

					endforeach;

				?>
				</li>
				<li class="list-group-item text-center">
					<p>
						<button type="submit" class="btn btn-block btn-primary">
							Update Results
						</button>
					</p>
					<p class="small">
						<?=anchor( $_link_url, 'Reset Filters' )?>
					</p>
				</li>
			</ul>
			<?php

		echo form_close();

	endif;
