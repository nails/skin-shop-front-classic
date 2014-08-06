	<div class="product col-xs-12">
<?php

	echo '<div class="product-label">';
		echo '<h3 class="text-center hidden-md hidden-lg">';
			echo $product->label;
		echo '</h3>';

		echo '<h3 class="hidden-xs hidden-sm">';
			echo $product->label;
		echo '</h3>';
	echo '</div>';

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

				$_featured_img['thumb']	= $skin->url . 'assets/img/product-no-image.png';

			endif;

			// --------------------------------------------------------------------------

			//	Gallery
			$_gallery = array();
			foreach ( $product->gallery AS $object_id ) :

				$_gallery[] = array(
					'url'	=> cdn_serve( $object_id ),
					'thumb'	=> cdn_thumb( $object_id, 800, 800 )
				);

			endforeach;

			// --------------------------------------------------------------------------

			//	Extra small and Small breakpoints
			echo '<div class="hidden-md hidden-lg clearfix">';

				echo '<div class="row featured-image-xs-sm">';

					if ( $_gallery ) :

						echo '<div class="col-xs-9">';

					else :

						echo '<div class="col-xs-12">';

					endif;

						if ( ! empty( $_featured_img['url'] ) ) :

							echo '<a href="' . $_featured_img['url'] . '" class="featured-img-link">';

						endif;

						echo img( array( 'src' => $_featured_img['thumb'], 'class' => 'img-responsive img-thumbnail featured-img-img' ) );

						if ( ! empty( $_featured_img['url'] ) ) :

							echo '</a>';

						endif;

					echo '</div>';

					if ( $_gallery ) :
					echo '<div class="gallery-scroll gallery-xs-sm">';

						foreach ( $_gallery AS $item ) :

							echo '<div class="text-center gallery-item">';

							if ( ! empty( $item['url'] ) ) :

								echo '<a href="' . $item['url'] . '" class="gallery-link">';

							endif;

							echo img( array( 'src' => $item['thumb'], 'class' => 'center-block img-responsive img-thumbnail gallery-img' ) );

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
			echo '<div class="hidden-sm hidden-xs clearfix">';

				echo '<div class="text-center featured-image-md-lg">';

					if ( ! empty( $_featured_img['url'] ) ) :

						echo '<a href="' . $_featured_img['url'] . '" class="featured-img-link" target="_blank">';

					endif;

					echo img( array( 'src' => $_featured_img['thumb'], 'class' => 'img-responsive img-thumbnail featured-img-img' ) );

					if ( ! empty( $_featured_img['url'] ) ) :

						echo '</a>';

					endif;

				echo '</div>';

				echo '<div class="row text-center gallery-md-lg">';
				foreach ( $_gallery AS $item ) :

					echo '<div class="col-md-4 col-lg-4 gallery-item">';
					if ( ! empty( $item['url'] ) ) :

						echo '<a href="' . $item['url'] . '" class="gallery-link" target="_blank">';

					endif;

					echo img( array( 'src' => $item['thumb'], 'class' => 'img-responsive img-thumbnail gallery-img' ) );

					if ( ! empty( $item['url'] ) ) :

						echo '</a>';

					endif;
					echo '</div>';

				endforeach;
				echo '</div>';

			echo '</div>';

			// --------------------------------------------------------------------------

			//	Tags
			if ( ! empty( $product->tags ) ) :

				echo '<hr />';
				echo '<h4>Tags</h4>';
				echo '<ul class="list-inline">';

				foreach( $product->tags AS $tag ) :

					echo '<li>';
						echo anchor( $this->shop_tag_model->format_url( $tag->slug ), '<span class="badge">' . $tag->label . '</span>' );
					echo '</li>';

				endforeach;

				echo '</ul>';

			endif;

			// --------------------------------------------------------------------------

			//	Categories
			if ( ! empty( $product->categories ) ) :

				echo '<hr />';
				echo '<h4>Categories</h4>';
				echo '<ul class="list-unstyled">';

				foreach( $product->categories AS $category ) :

					echo '<li>';
						echo anchor( $this->shop_category_model->format_url( $category->slug ), $category->label );
					echo '</li>';

				endforeach;

				echo '</ul>';

			endif;

			// --------------------------------------------------------------------------

			//	Brands
			if ( ! empty( $product->brands ) ) :

				echo '<hr />';
				echo '<h4>Brands</h4>';
				echo '<ul class="list-unstyled">';

				foreach( $product->brands AS $brand ) :

					echo '<li>';
						echo anchor( $this->shop_brand_model->format_url( $brand->slug ), $brand->label );
					echo '</li>';

				endforeach;

				echo '</ul>';

			endif;

			// --------------------------------------------------------------------------

			//	Ranges
			if ( ! empty( $product->collections ) ) :

				echo '<hr />';
				echo '<h4>Collections</h4>';
				echo '<ul class="list-unstyled">';

				foreach( $product->collections AS $collection ) :

					echo '<li>';
						echo anchor( $this->shop_collection_model->format_url( $collection->slug ), $collection->label );
					echo '</li>';

				endforeach;

				echo '</ul>';

			endif;

			// --------------------------------------------------------------------------

			//	Ranges
			if ( ! empty( $product->ranges ) ) :

				echo '<hr />';
				echo '<h4>Ranges</h4>';
				echo '<ul class="list-unstyled">';

				foreach( $product->ranges AS $range ) :

					echo '<li>';
						echo anchor( $this->shop_range_model->format_url( $range->slug ), $range->label );
					echo '</li>';

				endforeach;

				echo '</ul>';

			endif;

		echo '</div>';

		// --------------------------------------------------------------------------

		//	Right hand column
		echo '<div class="col-md-8">';

			//	Description
			echo '<div class="product-description">';
				echo $product->description;
			echo '</div>';

			// --------------------------------------------------------------------------

			//	Variants
			echo '<div class="well well-sm">';

				echo '<table class="table table-variants">';
					echo '<thead>';
						echo '<tr>';
							echo '<th class="col-xs-6">Item</th>';
							echo '<th class="col-xs-3">Price</th>';
							echo '<th class="col-xs-3">Quantity</th>';
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
										echo '<p>' . $variant->label . '</p>';
									echo '</td>';
									echo '<td>';

										if ( app_setting( 'price_exclude_tax', 'shop' ) ) :

											//	Product prices include taxes
											echo '<p>';
												echo $variant->price->price->user_formatted->value;
											echo '</p>';

											if ( ! app_setting( 'omit_variant_tax_pricing', 'shop-' . $skin->slug ) && $variant->price->price->user->value != $variant->price->price->user->value_inc_tax ) :

												echo '<p class="text-muted">';
													echo '<small>';
														echo '<em>Inc. Tax: ' . $variant->price->price->user_formatted->value_inc_tax . '</em>';
													echo '</small>';
												echo '</p>';

											endif;

										else :

											echo '<p>';
												echo $variant->price->price->user_formatted->value;
											echo '</p>';

											if ( ! app_setting( 'omit_variant_tax_pricing', 'shop-' . $skin->slug ) && $variant->price->price->user->value != $variant->price->price->user->value_ex_tax ) :

												echo '<p class="text-muted">';
													echo '<small>';
														echo '<em>Ex. Tax: ' . $variant->price->price->user_formatted->value_ex_tax . '</em>';
													echo '</small>';
												echo '</p>';

											endif;

										endif;

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
												echo $this->shop_basket_model->get_variant_quantity( $variant->id );
												echo anchor( app_setting( 'url', 'shop' ) . 'basket', 'View Basket', 'class="btn btn-xs btn-success pull-right btn-basket"' );
												echo form_submit( 'submit', 'Remove', 'class="btn btn-xs btn-danger pull-right btn-remove"' );
											echo form_close();

										endif;

									echo '</td>';

								break;

								case 'TO_ORDER' :

									echo '<td>';
										echo '<p>' . $variant->label . '</p>';
										echo '<p class="text-muted">';
											echo '<small>';
												echo '<em>Lead time: ' . $variant->lead_time . '</em>';
											echo '</small>';
										echo '</p>';
									echo '</td>';
									echo '<td>';

										if ( app_setting( 'price_exclude_tax', 'shop' ) ) :

											//	Product prices include taxes
											echo '<p>';
												echo $variant->price->price->user_formatted->value;
											echo '</p>';

											if ( ! app_setting( 'omit_variant_tax_pricing', 'shop-' . $skin->slug ) && $variant->price->price->user->value != $variant->price->price->user->value_inc_tax ) :

												echo '<p class="text-muted">';
													echo '<small>';
														echo '<em>Inc. Tax: ' . $variant->price->price->user_formatted->value_inc_tax . '</em>';
													echo '</small>';
												echo '</p>';

											endif;

										else :

											echo '<p>';
												echo $variant->price->price->user_formatted->value;
											echo '</p>';

											if ( ! app_setting( 'omit_variant_tax_pricing', 'shop-' . $skin->slug ) && $variant->price->price->user->value != $variant->price->price->user->value_ex_tax ) :

												echo '<p class="text-muted">';
													echo '<small>';
														echo '<em>Ex. Tax: ' . $variant->price->price->user_formatted->value_ex_tax . '</em>';
													echo '</small>';
												echo '</p>';

											endif;

										endif;

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
												echo $this->shop_basket_model->get_variant_quantity( $variant->id );
												echo anchor( app_setting( 'url', 'shop' ) . 'basket', 'View Basket', 'class="btn btn-xs btn-success pull-right btn-basket"' );
												echo form_submit( 'submit', 'Remove', 'class="btn btn-xs btn-danger pull-right btn-remove"' );
											echo form_close();

										endif;

									echo '</td>';

								break;

								case 'OUT_OF_STOCK' :

									echo '<td>';
										echo '<p><strike>' . $variant->label . '</strike></p>';
									echo '</td>';
									echo '<td>';
										echo '<p><strike>' . $variant->price->price->user_formatted->value . '</strike></p>';
									echo '</td>';
									echo '<td>';
										echo '<p>';
											echo '<em>Out of Stock!</em>';
											echo anchor( app_setting( 'url', 'shop' ) . 'notify/' . $variant->id, 'Notify Me', 'class="btn btn-xs btn-default pull-right fancybox" data-width="750" data-height="350" data-fancybox-type="iframe"' );
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
			if ( ! empty( $product->attributes ) ) :

				echo '<table class="table table-bordered table-striped product-attributes">';
					echo '<thead>';
						echo '<tr>';
							echo '<th>Attribute</th>';
							echo '<th>Value</th>';
						echo '</tr>';
					echo '</thead>';
					echo '<tbody>';

						foreach ( $product->attributes AS $attribute ) :

							echo '<tr>';
								echo '<td>' . $attribute->label . '</td>';
								echo '<td>' . $attribute->value . '</td>';
							echo '</tr>';

						endforeach;

					echo '</tbody>';

				echo '</table>';

			endif;

			// --------------------------------------------------------------------------

			/**
			 * TODOMarkup here because I think it looks OK and can be used when product
			 * reviews get implemented (if they get implemented)
			 */
			if ( ! empty( $product_reviews ) ) :

				//	Reviews
				echo '<div class="product-reviews">';

					echo '<hr />';
					echo '<h4>Customer Reviews</h4>';

					foreach( $product_reviews AS $review ) :

						echo '<div class="well">';
							echo '<div class="row">';
								echo '<div class="col-xs-2">';

									if ( $review->user->profile_img ) :

										$_url = cdn_thumb( $review->user->profile_img, 250, 250 );

									else :

										$_url = cdn_blank_avatar( 250, 250, $review->user->gender );

									endif;

									echo img( array( 'src' => $_url, 'class="img-responsive img-thumbnail img-circle"' ) );

								echo '</div>';
								echo '<div class="col-xs-10">';
									echo '<h5>' . $review->user->first_name . ' ' . $review->user->last_name . '</h5>';
									echo '<p>';

										foreach ( $reviw->stars AS $star ) :

											if ( $star->is_half ) :

												echo '<span class="fa fa-star-half"></span>';

											else :

												echo '<span class="fa fa-star></span>';

											endif;

										endforeach;

									echo '</p>';
									echo '<hr />';
									echo auto_typography( $review->body );
									echo '<p>';
										echo '<small>';
											echo '<em>' . user_datetime( $review->created ) . '</em>';
										echo '</small>';
									echo '</p>';
								echo '</div>';
							echo '</div>';
						echo '</div>';

					endforeach;

				echo '</div>';

			endif;

		echo '</div>';

	echo '</div>';

?>
</div>