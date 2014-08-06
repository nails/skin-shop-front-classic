<div class="nails-skin-shop-classic basket">
	<div class="row">
		<div class="col-xs-12">
		<?php

			if ( ! empty( $basket->items ) ) :

				?>
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th class="col-xs-6 col-sm-8">Product</th>
								<th class="col-xs-3 col-sm-2 text-center">Quantity</th>
								<th class="col-xs-3 col-sm-2 text-center">Unit Price</th>
							</tr>
						</thead>
						<tbody>
						<?php

							foreach ( $basket->items AS $item ) :

								?>
								<tr>
									<td class="vertical-align-middle">
										<?php

											if ( ! empty( $item->variant->featured_img ) ) :

												$_featured_img = $item->variant->featured_img;

											elseif ( ! empty( $item->product->featured_img ) ) :

												$_featured_img = $item->product->featured_img;

											else :

												$_featured_img = FALSE;

											endif;

											if ( $_featured_img ) :

												echo '<div class="col-xs-2 hidden-xs hidden-sm">';

													$_url = cdn_thumb( $_featured_img, 250, 250 );
													echo img( array( 'src' => $_url, 'class' => 'img-thumbnail' ) );

												echo '</div>';
												echo '<div class="col-sm-12 col-md-10">';

											else :

												echo '<div class="col-sm-12">';

											endif;

											echo anchor( $item->product->url, '<strong>' . $item->product_label . '</strong>' );

											?>
											<br />
											<em><?=$item->variant_label?></em>
											<br />
											<small class="text-muted">
												<em><?=$item->variant_sku?></em>
											</small>
										</div>

									</td>
									<td class="vertical-align-middle text-center">
										<div class="row">
										<?php

											echo '<div class="col-xs-4">';
											echo anchor( app_setting( 'url', 'shop' ) . 'basket/decrement?variant_id=' . $item->variant_id, '<span class="fa fa-minus-circle fa-lg text-muted"></span>', 'class="pull-right"' );
											echo '</div>';

											echo '<div class="col-xs-4">';
											echo '<span class="variant-quantity-' . $item->variant_id . '">';
												echo number_format( $item->quantity );
											echo '</span>';
											echo '</div>';

											echo '<div class="col-xs-4">';
											echo anchor( app_setting( 'url', 'shop' ) . 'basket/increment?variant_id=' . $item->variant_id, '<span class="fa fa-plus-circle fa-lg text-muted"></span>', 'class="pull-left"' );
											echo '</div>';

										?>
										</div>
									</td>
									<td class="vertical-align-middle text-center">
									<?php

										if ( app_setting( 'price_exclude_tax', 'shop' ) ) :

											echo '<span class="variant-unit-price-ex-tax-' . $item->variant_id . '">';
												echo $item->variant->price->price->user_formatted->value_ex_tax;
											echo '</span>';

											if ( ! app_setting( 'omit_variant_tax_pricing', 'shop-' . $skin->slug ) && $item->variant->price->price->user->value_tax > 0 ) :

												echo '<br />';
												echo '<small class="text-muted">';
													echo '<span class="variant-unit-price-inc-tax-' . $item->variant_id . '">';
														echo $item->variant->price->price->user_formatted->value_inc_tax;
													echo '</span>';
													echo ' inc. tax';
												echo '</small>';

											endif;

										else :

											echo '<span class="variant-unit-price-inc-tax-' . $item->variant_id . '">';
												echo $item->variant->price->price->user_formatted->value_inc_tax;
											echo '</span>';

											if ( ! app_setting( 'omit_variant_tax_pricing', 'shop-' . $skin->slug ) && $item->variant->price->price->user->value_tax > 0 ) :

												echo '<br />';
												echo '<small class="text-muted">';
													echo '<span class="variant-unit-price-ex-tax-' . $item->variant_id . '">';
														echo $item->variant->price->price->user_formatted->value_ex_tax;
													echo '</span>';
													echo ' ex. tax';
												echo '</small>';

											endif;

										endif;

									?>
									</td>
								</tr>
								<?php

							endforeach;

						?>
						</tbody>
						<tfoot>
							<tr>
								<th colspan="3"></th>
							</tr>

							<!-- Item Total -->
							<tr class="basket-total-item" <?=empty( $basket->totals->user->item ) ? 'style="display:none"' : '' ?>>
								<th colspan="2" class="text-right">
									Sub Total
								</th>
								<th class="text-center value">
									<?=$basket->totals->user_formatted->item?>
								</th>
							</tr>

							<!-- Shipping Total -->
							<tr class="basket-total-shipping" <?=empty( $basket->totals->user->shipping ) ? 'style="display:none"' : '' ?>>
								<th colspan="2" class="text-right">
									Shipping
								</th>
								<th class="text-center value">
									<?=$basket->totals->user_formatted->shipping?>
								</th>
							</tr>

							<!-- Tax Total -->
							<tr class="basket-total-tax" <?=empty( $basket->totals->user->tax ) ? 'style="display:none"' : '' ?>>
								<th colspan="2" class="text-right">
								<?php

									if ( app_setting( 'price_exclude_tax', 'shop' ) ) :

										echo 'Tax';

									else :

										echo 'Tax (included)';

									endif;

								?>
								</th>
								<th class="text-center value">
								<?php

									echo $basket->totals->user_formatted->tax;

								?>
								</th>
							</tr>

							<!-- Grand Total -->
							<tr class="basket-total-grand" <?=empty( $basket->totals->user->grand ) ? 'style="display:none"' : '' ?>>
								<th colspan="2" class="text-right">
									Total
								</th>
								<th class="text-center value">
									<?=$basket->totals->user_formatted->grand?>
								</th>
							</tr>
						</tfoot>
					</table>
				</div>
				<hr />
				<div class="row">
					<div class="col-xs-12">
						<div class="well well-sm">
							<?=form_open( app_setting( 'url', 'shop' ) . 'basket/add_voucher', 'class="add-voucher"' )?>
							<div class="row">
								<div class="col-sm-10">
									<?=form_input( 'voucher', '', 'placeholder="Enter your promotional voucher, if you have one." class="form-control"' )?>
								</div>
								<div class="col-sm-2">
									<button type="submit" class="btn btn-primary btn-block">
										Add Voucher
									</button>
								</div>
							</div>
							<?=form_close()?>
						</div>
					</div>
				</div>
				<hr />
				<p class="text-center">
					<?=anchor( app_setting( 'url', 'shop' ) . 'checkout', 'Checkout Now', 'class="btn btn-lg btn-success"' )?>
				</p>
				<?php

			else :

				?>
				<p class="text-center">
					Your basket is empty.
				</p>
				<?php


			endif;

		?>
		</div>
	</div>
</div>