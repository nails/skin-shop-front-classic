<div class="product col-md-9 col-md-push-3 ">
<?php

	echo '<h3 class="text-center hidden-md hidden-lg">';
		echo $product->label;
	echo '</h3>';

	echo '<h3 class="hidden-xs hidden-sm">';
		echo $product->label;
	echo '</h3>';

	echo '<hr />';

	echo '<div class="row">';

		//	Featured Image & Gallery
		echo '<div class="col-md-4">';

			//	Featured Image
			$_featured_img = array( 'url' => '', 'thumb' => '' );

			if ( $product->featured_img ) :

				$_featured_img['url']	= cdn_serve( $product->featured_img );
				$_featured_img['thumb']	= cdn_thumb( $product->featured_img, 800, 800 );

			else :

				$_featured_img['thumb']	= cdn_placeholder( 500, 500 );

			endif;

			// --------------------------------------------------------------------------

			//	Gallery
			$_gallery = array();
			foreach ( $product->gallery AS $object_id ) :

				if ( $product->featured_img == $object_id ) :

					continue;

				endif;

				$_gallery[] = array(
					'url'	=> cdn_serve( $object_id ),
					'thumb'	=> cdn_thumb( $object_id, 250, 250 )
				);

			endforeach;

			// --------------------------------------------------------------------------

			//	Extra small and Small breakpoints
			echo '<div class="hidden-md hidden-lg">';

				echo '<div class="row" style="margin-bottom:1.5em;">';

					if ( $_gallery ) :

						echo '<div class="col-xs-9">';

					else :

						echo '<div class="col-xs-12">';

					endif;

						if ( ! empty( $_featured_img['url'] ) ) :

							echo '<a href="' . $_featured_img['url'] . '" rel="product-image-xs-sm" class="fancybox">';

						endif;

						echo img( array( 'src' => $_featured_img['thumb'], 'class' => 'img-responsive img-thumbnail' ) );

						if ( ! empty( $_featured_img['url'] ) ) :

							echo '</a>';

						endif;

					echo '</div>';

					if ( $_gallery ) :
					echo '<div class="col-xs-3" style="position: absolute;max-height: 100%;overflow: auto;right: 0;">';

						foreach ( $_gallery AS $item ) :

							echo '<div class="text-center" style="margin-bottom:0.5em;">';

							if ( ! empty( $item['url'] ) ) :

								echo '<a href="' . $item['url'] . '" rel="product-image-xs-sm" class="fancybox">';

							endif;

							echo img( array( 'src' => $item['thumb'], 'class' => 'center-block img-responsive img-thumbnail' ) );

							if ( ! empty( $item['url'] ) ) :

								echo '</a>';

							endif;

							echo '</div>';

						endforeach;

					echo '</div>';
					endif;

				echo '</div>';

			echo '</div>';

			//	Medium and Large breakpoints
			echo '<div class="hidden-sm hidden-xs">';

				echo '<div class="text-center" style="margin-bottom:1.5em;">';

					if ( ! empty( $_featured_img['url'] ) ) :

						echo '<a href="' . $_featured_img['url'] . '" rel="product-image-md-lg" class="fancybox">';

					endif;

					echo img( array( 'src' => $_featured_img['thumb'], 'class' => 'img-responsive img-thumbnail' ) );

					if ( ! empty( $_featured_img['url'] ) ) :

						echo '</a>';

					endif;

				echo '</div>';

				echo '<div class="text-center">';
				foreach ( $_gallery AS $item ) :

					echo '<div class="col-md-6 col-lg-6" style="margin-bottom:1.5em;">';
					if ( ! empty( $item['url'] ) ) :

						echo '<a href="' . $item['url'] . '" rel="product-image-md-lg" class="fancybox">';

					endif;

					echo img( array( 'src' => $item['thumb'], 'class' => 'img-responsive img-thumbnail' ) );

					if ( ! empty( $item['url'] ) ) :

						echo '</a>';

					endif;
					echo '</div>';

				endforeach;
				echo '</div>';

			echo '</div>';

		echo '</div>';

		// --------------------------------------------------------------------------

		//	Right hand column
		echo '<div class="col-md-8">';

			//	Description
			echo $product->description;

			// --------------------------------------------------------------------------

			//	Controls
			echo '<div class="well well-sm">';

				echo '<table class="table">';
					echo '<thead>';
						echo '<tr>';
							echo '<th>Item</th>';
							echo '<th>Price</th>';
							echo '<th>Quantity</th>';
						echo '</tr>';
					echo '</thead>';
					echo '<tbody>';

					foreach ( $product->variations AS $variant ) :

						echo '<tr>';

							//	Calculate quantity ranges
							$_range					= array();
							$_range['unlimited']	= array_combine(range(1,10),range(1,10));
							$_range['limited']		= array_combine(range(1,10),range(1,10));

							$_max_per_order	= $product->type->max_per_order;
							$_available		= $variant->quantity_available;

							if ( is_null( $_available ) && empty( $_max_per_order ) ) :

								//	Unlimited quantity available, with no maximum per order
								$_range = array_combine( range( 1, 10 ), range( 1, 10 ) );

							elseif ( is_null( $_available ) && ! empty( $_max_per_order ) ) :

								//	Unlimited quantity available, with maximum per order
								$_range = array_combine( range( 1, $_max_per_order ), range( 1, $_max_per_order ) );

							elseif ( is_numeric( $_available ) && ! empty( $_max_per_order ) ) :

								//	Limited quantity available, with maximum per order
								if ( $_available >= $_max_per_order ) :

									//	There are more available than the maximumper order
									$_range = array_combine( range( 1, $_max_per_order ), range( 1, $_max_per_order ) );

								else :

									//	There are fewer available than the maximum per order
									$_range = array_combine( range( 1, $_available ), range( 1, $_available ) );

								endif;

							elseif ( is_numeric( $_available ) && empty( $_max_per_order ) ) :

								//	Limited quantity available, with no maximum per order
								$_range = array_combine( range( 1, $_available ), range( 1, $_available ) );

							else :

								//	Shouldn't happen.
								$_range = array( 0 );

							endif;

							switch( $variant->stock_status ) :

								case 'IN_STOCK' :

									echo '<td>';
										echo '<p style="margin-bottom:0;">' . $variant->label . '</p>';
									echo '</td>';
									echo '<td>';
										echo '<p style="margin-bottom:0;">' . $variant->user_price_formatted->price . '</p>';
									echo '</td>';
									echo '<td>';

										if ( ! $this->shop_basket_model->is_in_basket( $variant->id ) ) :

											echo form_open( app_setting( 'url', 'shop' ) . 'basket/add', 'method="GET"' );
												echo form_hidden( 'return', $product->url );
												echo form_hidden( 'variant_id', $variant->id );
												echo form_dropdown( 'quantity', $_range );
												echo form_submit( 'submit', 'Add to Basket', 'class="btn btn-xs btn-primary pull-right"' );
											echo form_close();

										else :

											echo form_open( app_setting( 'url', 'shop' ) . 'basket/remove', 'method="GET"' );
												echo form_hidden( 'return', $product->url );
												echo form_hidden( 'variant_id', $variant->id );
												echo form_submit( 'submit', 'Remove from Basket', 'class="btn btn-xs btn-danger pull-right"' );
											echo form_close();

										endif;

									echo '</td>';

								break;

								case 'TO_ORDER' :

									echo '<td>';
										echo '<p style="margin-bottom:0;">' . $variant->label . '</p>';
										echo '<p style="margin-bottom:0;" class="small"><em>Lead time: ' . $variant->lead_time . '</em></p>';
									echo '</td>';
									echo '<td>';
										echo '<p style="margin-bottom:0;">' . $variant->user_price_formatted->price . '</p>';
									echo '</td>';
									echo '<td>';
										echo form_open( app_setting( 'url', 'shop' ) . 'basket/add', 'method="GET"' );
											echo form_hidden( 'return', $product->url );
											echo form_hidden( 'variant_id', $variant->id );
											echo form_dropdown( 'quantity', $_range );
											echo form_submit( 'submit', 'Add to Basket', 'class="btn btn-xs btn-primary pull-right"' );
										echo form_close();
									echo '</td>';

								break;

								case 'OUT_OF_STOCK' :

									echo '<td>';
										echo '<p style="margin-bottom:0;"><strike>' . $variant->label . '</strike></p>';
									echo '</td>';
									echo '<td>';
										echo '<p style="margin-bottom:0;"><strike>' . $variant->user_price_formatted->price . '</strike></p>';
									echo '</td>';
									echo '<td>';
										echo '<p style="margin-bottom:0;">';
											echo '<em>Out of Stock!</em>';
											echo anchor( app_setting( 'url', 'shop' ) . 'notify/' . $variant->id, 'Notify Me', 'class="btn btn-xs btn-default pull-right fancybox" data-fancybox-type="iframe"' );
										echo '</p>';
									echo '</td>';

								break;

							endswitch;

						echo '</tr>';

					endforeach;

					echo '</tbody>';
				echo '</table>';

			echo '</div>';

			// --------------------------------------------------------------------------

			//	Attributes
			echo '<hr />';
			echo '<h4>Attributes</h4>';
			dump($product->attributes);

			// --------------------------------------------------------------------------

			//	Brands
			echo '<hr />';
			echo '<h4>Brands</h4>';
			dump($product->brands);

			// --------------------------------------------------------------------------

			//	Categories
			echo '<hr />';
			echo '<h4>Categories</h4>';
			dump($product->categories);

			// --------------------------------------------------------------------------

			//	Collections
			echo '<hr />';
			echo '<h4>Collections</h4>';
			dump($product->collections);

			// --------------------------------------------------------------------------

			//	Ranges
			echo '<hr />';
			echo '<h4>Ranges</h4>';
			dump($product->ranges);

		echo '</div>';

	echo '</div>';

?>
</div>