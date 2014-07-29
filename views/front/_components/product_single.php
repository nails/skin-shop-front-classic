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
			echo '<div class="hidden-md hidden-lg clearfix">';

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
			echo '<div class="hidden-sm hidden-xs clearfix">';

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

										if ( app_setting( 'price_exclude_tax', 'shop' ) ) :

											//	Product prices include taxes
											echo '<p style="margin-bottom:0;">';
												echo $variant->price->price->user_formatted->value;
											echo '</p>';

											if ( $variant->price->price->user->value != $variant->price->price->user->value_inc_tax ) :

												echo '<p style="margin-bottom:0;" class="small">';
													echo '<em>Inc-Tax: ' . $variant->price->price->user_formatted->value_inc_tax . '</em>';
												echo '</p>';

											endif;

										else :

											echo '<p style="margin-bottom:0;">';
												echo $variant->price->price->user_formatted->value;
											echo '</p>';

											if ( $variant->price->price->user->value != $variant->price->price->user->value_ex_tax ) :

												echo '<p style="margin-bottom:0;" class="small">';
													echo '<em>Ex-Tax: ' . $variant->price->price->user_formatted->value_ex_tax . '</em>';
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
												echo anchor( app_setting( 'url', 'shop' ) . 'basket', 'Checkout', 'class="btn btn-xs btn-success pull-right"' );
												echo form_submit( 'submit', 'Remove', 'class="btn btn-xs btn-danger pull-right" style="margin-right:0.5em;"' );
											echo form_close();

										endif;

									echo '</td>';

								break;

								case 'TO_ORDER' :

									echo '<td>';
										echo '<p style="margin-bottom:0;">' . $variant->label . '</p>';
										echo '<p style="margin-bottom:0;" class="small">';
											echo '<em>Lead time: ' . $variant->lead_time . '</em>';
										echo '</p>';
									echo '</td>';
									echo '<td>';

										if ( app_setting( 'price_exclude_tax', 'shop' ) ) :

											//	Product prices include taxes
											echo '<p style="margin-bottom:0;">';
												echo $variant->price->price->user_formatted->value;
											echo '</p>';

											if ( $variant->price->price->user->value != $variant->price->price->user->value_inc_tax ) :

												echo '<p style="margin-bottom:0;" class="small">';
													echo '<em>Inc-Tax: ' . $variant->price->price->user_formatted->value_inc_tax . '</em>';
												echo '</p>';

											endif;

										else :

											echo '<p style="margin-bottom:0;">';
												echo $variant->price->price->user_formatted->value;
											echo '</p>';

											if ( $variant->price->price->user->value != $variant->price->price->user->value_ex_tax ) :

												echo '<p style="margin-bottom:0;" class="small">';
													echo '<em>Ex-Tax: ' . $variant->price->price->user_formatted->value_ex_tax . '</em>';
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
												echo anchor( app_setting( 'url', 'shop' ) . 'basket', 'Checkout', 'class="btn btn-xs btn-success pull-right"' );
												echo form_submit( 'submit', 'Remove', 'class="btn btn-xs btn-danger pull-right" style="margin-right:0.5em;"' );
											echo form_close();

										endif;

									echo '</td>';

								break;

								case 'OUT_OF_STOCK' :

									echo '<td>';
										echo '<p style="margin-bottom:0;"><strike>' . $variant->label . '</strike></p>';
									echo '</td>';
									echo '<td>';
										echo '<p style="margin-bottom:0;"><strike>' . $variant->price->price->user_formatted->value . '</strike></p>';
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
			if ( ! empty( $product->attributes ) ) :

				echo '<table class="table table-bordered table-striped">';
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

			//	Reviews
			echo '<hr />';
			echo '<h4>Customer Reviews</h4>';
			?>
			<p class="alert alert-warning">
				<strong>TODO:</strong> Customer reviews, maybe?
			</p>
			<div class="well">
				<div class="row">
					<div class="col-xs-2">
						<img src="http://placekitten.com/250/250" class="img-responsive img-thumbnail img-circle" />
					</div>
					<div class="col-xs-10">
						<h5>Jimmy Jimmerson</h5>
						<p>
							<span class="ion-ios7-star"></span>
							<span class="ion-ios7-star"></span>
							<span class="ion-ios7-star-half"></span>
						</p>
						<hr />
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
						</p>
						<p>
							<small><em><?=user_datetime( time() )?></em></small>
						</p>
					</div>
				</div>
			</div>
			<div class="well">
				<div class="row">
					<div class="col-xs-2">
						<img src="http://placekitten.com/240/240" class="img-responsive img-thumbnail img-circle" />
					</div>
					<div class="col-xs-10">
						<h5>Sarah Screwdriver</h5>
						<p>
							<span class="ion-ios7-star"></span>
							<span class="ion-ios7-star"></span>
							<span class="ion-ios7-star-half"></span>
						</p>
						<hr />
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
						</p>
						<p>
							<small><em><?=user_datetime( time() )?></em></small>
						</p>
					</div>
				</div>
			</div>
			<?php

		echo '</div>';

	echo '</div>';

?>
</div>