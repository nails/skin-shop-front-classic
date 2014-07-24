<div class="group-shop basket">
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
								<div class="col-xs-2 hidden-xs">
									<img src="<?=cdn_scale( 1, 250, 250 )?>" class="img-thumbnail" style="margin-right:1em;" />
								</div>
								<div class="col-sm-10">
									<a href="#">
										<strong><?=$item->product_label?></strong>
									</a>
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
							<td class="vertical-align-middle text-center">£XXX.XX</td>
						</tr>
						<?php

					endforeach;

				?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="3"></th>
					</tr>
					<tr>
						<th colspan="2" class="text-right">Shipping</th>
						<th class="text-center">£XXX.XX</th>
					</tr>
					<tr>
						<th colspan="2" class="text-right">TAX</th>
						<th class="text-center">£XXX.XX</th>
					</tr>
					<tr>
						<th colspan="2" class="text-right">Total</th>
						<th class="text-center">£XXX.XX</th>
					</tr>
				</tfoot>
			</table>
		</div>
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