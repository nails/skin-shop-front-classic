<?php

	echo '<ol class="breadcrumb">';

		echo '<li class="crumb home">';
			echo '<span class="fa fa-home text-muted"></span>';
			echo anchor( $shop_url, app_setting( 'name', 'shop' ) );
		echo '</li>';

		if ( ! empty( $category ) ) :

			foreach( $category->breadcrumbs AS $crumb ) :

				echo '<li class="crumb">';

					if( $crumb->id == $category->id ) :

						echo $crumb->label;

					else :

						echo anchor( $this->shop_category_model->format_url( $crumb->slug ), $crumb->label );

					endif;

				echo '</li>';

			endforeach;

		endif;

	echo '</ol>';