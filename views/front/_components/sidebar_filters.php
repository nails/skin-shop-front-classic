<?php

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
				<?php for ( $i=0; $i < 2; $i++ ) : ?>
				<p class="filter-heading">
					<strong>Filter</strong>
				</p>
				<ul class="filter-list list-unstyled">

					<?php for ( $x=0; $x < 10; $x++ ) : ?>
					<li>
						<label>
							<?php

								$_checked = ! empty( $_GET['f'][$i][$x] ) ? TRUE : FALSE;
								echo form_checkbox( 'f[' . $i . '][' . $x . ']', TRUE, $_checked );

							?>
							Lorem Ipsum
						</label>
					</li>
					<?php endfor; ?>
				</ul>
				<?php endfor; ?>
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
