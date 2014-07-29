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
									<?php

										echo anchor( app_setting( 'url', 'shop' ) . 'basket/decrement?variant_id=' . $item->variant_id, '<span class="ion-minus-circled"></span>', 'class="pull-left"' );

										echo number_format( $item->quantity );

										echo anchor( app_setting( 'url', 'shop' ) . 'basket/increment?variant_id=' . $item->variant_id, '<span class="ion-plus-circled"></span>', 'class="pull-right"' );

									?>
									</td>
									<td class="vertical-align-middle text-center">
										<?=$item->variant->price->price->user_formatted->value_ex_tax?>
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
							<?php if ( ! empty( $basket->totals->user->item ) ) : ?>
							<tr>
								<th colspan="2" class="text-right">Sub Total</th>
								<th class="text-center"><?=$basket->totals->user_formatted->item?></th>
							</tr>
							<?php endif; ?>

							<?php if ( ! empty( $basket->totals->user->shipping ) ) : ?>
							<tr>
								<th colspan="2" class="text-right">Shipping</th>
								<th class="text-center"><?=$basket->totals->user_formatted->shipping?></th>
							</tr>
							<?php endif; ?>

							<?php if ( ! empty( $basket->totals->user->tax ) ) : ?>
							<tr>
								<th colspan="2" class="text-right">Tax</th>
								<th class="text-center"><?=$basket->totals->user_formatted->tax?></th>
							</tr>
							<?php endif; ?>

							<tr>
								<th colspan="2" class="text-right">Total</th>
								<th class="text-center"><?=$basket->totals->user_formatted->grand?></th>
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