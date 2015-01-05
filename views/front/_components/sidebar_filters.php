<?php

	if (!empty($sidebar_filters)) {

		//	Build URLs for this page. The URL should not contain the pagination segment

		//	For the form
		$form_url = site_url(preg_replace('#/\\d+$#', '', uri_string()));

		// --------------------------------------------------------------------------

		//	For the links
		$get = array();

		if ($this->input->get_post('per_page')) {

			$get['per_page'] = $this->input->get_post('per_page');
		}

		if ($this->input->get_post('sort')) {

			$get['sort'] = $this->input->get_post('sort');
		}

		$get = http_build_query($get);
		$get = $get ? '?' . $get : '';

		$link_url = $form_url . $get;

		// --------------------------------------------------------------------------

		echo form_open($form_url, 'method="GET"');

			//	Hidden fields so preferences get maintained
			if ($this->input->get_post('per_page')) {

				echo form_hidden('per_page', $this->input->get_post('per_page'));
			}

			if ($this->input->get_post('sort')) {

				echo form_hidden('sort', $this->input->get_post('sort'));
			}

			?>
			<ul class="list-group filters">
				<li class="list-group-item">
				<?php

					foreach ($sidebar_filters as $filter) {

						echo '<p class="filter-heading">';
							echo '<strong>' . $filter->label . '</strong>';
						echo '</p>';
						echo '<ul class="filter-list list-unstyled">';

						foreach ($filter->values AS $value) {

							echo '<li>';
								echo '<label class="clearfix">';

									if (isset($GET['f'][$filter->id]) && is_array($GET['f'][$filter->id])) {

										if (array_search($value->value, $GET['f'][$filter->id]) !== false) {

											$checked = true;

										} else {

											$checked = false;
										}

									} else {

										$checked = false;
									}

									echo form_checkbox('f[' . $filter->id . '][]', $value->value, $checked);
									echo '<span class="filter-text">' . $value->label . '</span>';
									echo '<span class="filter-count pull-right">';
										echo number_format($value->product_count);
									echo '</span>';

								echo '</label>';
							echo '</li>';
						}

						echo '</ul>';
					}

				?>
				</li>
				<li class="list-group-item text-center">
					<p>
						<button type="submit" class="btn btn-block btn-primary">
							Update Results
						</button>
					</p>
					<p class="small">
						<?=anchor($link_url, 'Reset Filters')?>
					</p>
				</li>
			</ul>
			<?php

		echo form_close();
	}
