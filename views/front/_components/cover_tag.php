<div class="row cover tag">
	<div class="col-xs-12">
		<?php

			if (!empty($tag->cover_id)) {

				$url	= cdn_scale($tag->cover_id, 1000, 500);
				$style	= 'style="background-image:url(' . $url . ');background-size:cover;"';

			} else {

				$style = '';
			}

			echo '<div class="background tag" ' . $style . '>';
				echo '<div class="overlay">';
					echo '<h2>' . $tag->label . '</h2>';
				echo '</div>';
			echo '</div>';

			// --------------------------------------------------------------------------

			//	Prepare the breadcrumbs
			$crumbs	= array();

			$crumbs[]	= array(
				'id'	=> NULL,
				'label'	=> 'Tags',
				'url'	=> app_setting('page_tag_listing', 'shop') ? $shop_url . 'tag' : NULL
			);

			$crumbs[]	= array(
				'id'	=> $tag->id,
				'label'	=> $tag->label,
				'url'	=> $tag->url
			);

			$view = $skin_front->path . 'views/front/_components/browse_breadcrumb';
			$data = array('crumbs' => $crumbs, 'active_id' => $tag->id);
			$this->load->view($view, $data);

			// --------------------------------------------------------------------------

			if (trim(strip_tags($tag->description))) {

				echo '<div class="description">';
					echo $tag->description;
				echo '</div>';
			}

		?>
	</div>
</div>