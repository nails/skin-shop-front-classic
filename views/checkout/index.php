<div class="nails-skin-shop-classic checkout">
	<?=form_open( NULL, 'id="checkout-form"')?>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="row">
				<div class="col-md-12">
					<h1>Checkout</h1>
				</div>
			</div>
			<div class="row">
			<?php

				echo  $this->user->is_logged_in() ? '<div class="col-md-12">' : '<div class="col-md-10">';

					$_intro_text = cms_render_block( 'shop_checkout_intro' );

					if ( ! empty( $_intro_text ) ) :

						echo $_intro_text;

					else :

						echo '<p>Simply complete the forms below and then click or tap the "Place Order &amp; Proceed to Payment" button.</p>';

						if ( ! $this->user->is_logged_in() ) :

							echo '<p>You are welcome to checkout as a guest, however we recommend creating an account so that you can track your order and have a quicker checkout experience next time.</p>';

						else :

							echo '<p>';
								echo 'You are currently logged in as: <strong>' . active_user( 'first_name,last_name' ) . ' (' . active_user( 'email' ) . ')</strong>. ';
								echo anchor( 'auth/logout', 'Not you?' );
							echo '</p>';

						endif;

					endif;

				echo '</div>';

				if ( ! $this->user->is_logged_in() ) :

					?>
					<div class="col-md-2 cta">
						<div class="well well-sm">
							<a href="#" class="btn btn-primary btn-sm btn-block">Login</a>
							<a href="#" class="btn btn-primary btn-sm btn-block">Register</a>
						</div>
					</div>
					<?php

				endif;

			?>
			</div>

			<div class="progress hidden" id="progress-bar">
				<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
			<hr id="progress-bar-hr" />

			<div class="panel panel-default" id="checkout-step-1">
				<div class="panel-heading">
					<h3 class="panel-title">
						Step 1 of 3: Contact &amp; Delivery Details
						<b class="validate-ok fa fa-check-circle fa-lg pull-right text-success hidden"></b>
						<b class="validate-fail fa fa-times-circle fa-lg pull-right text-danger hidden"></b>
					</h3>
				</div>
				<div class="panel-body">
					<div class="col-md-6">
						<h4>Delivery address</h4>
						<hr>
						<div role="form">
						<?php

							$_options	= array();
							$_options[] = array(
								'key'	=> 'delivery_address_line_1',
								'label'	=> 'Address Line 1'
							);
							$_options[] = array(
								'key'	=> 'delivery_address_line_2',
								'label'	=> 'Address Line 2'
							);
							$_options[] = array(
								'key'	=> 'delivery_address_town',
								'label'	=> 'City/Town'
							);
							$_options[] = array(
								'key'	=> 'delivery_address_state',
								'label'	=> 'Region/State'
							);
							$_options[] = array(
								'key'	=> 'delivery_address_postcode',
								'label'	=> 'Postal Code'
							);
							$_options[] = array(
								'key'	=> 'delivery_address_country',
								'label'	=> 'Country',
								'select' => $countries_flat
							);

							foreach ( $_options AS $opt ) :

								$_error				= form_error( $opt['key'], '<p class="help-block">', '</p>' );
								$_has_error			= $_error ? 'has-error' : '';
								$_has_feedback		= $_error ? 'has-feedback' : '';
								$_feedback_hidden	= $_has_feedback ? '' : 'hidden';
								$_active_user		= active_user( $opt['key'] );
								$_active_user		= is_string( $_active_user ) ? $_active_user : '';
								$_value				= set_value( $opt['key'], $_active_user );

								echo '<div class="form-group ' . $_has_error . ' ' . $_has_feedback . '">';
									echo '<label class="control-label" for="' . $opt['key'] . '">' . $opt['label'] . '</label>';

									if ( ! empty( $opt['select'] ) ) :

										echo '<select name="' . $opt['key'] . '" class="form-control select2" id="' . $opt['key'] . '">';
										echo '<option value="">Please Choose...</option>';
										foreach( $opt['select'] AS $value => $label ) :

											$_selected = $value == $_value ? 'selected="selected"' : '';
											echo '<option value="' . $value . '" ' . $_selected . '>' . $label .'</option>';

										endforeach;
										echo '</select>';

									else :

										echo '<input name="' . $opt['key'] . '" type="text" class="form-control" id="' . $opt['key'] . '" value="' . $_value . '">';

									endif;

									echo '<span class="glyphicon glyphicon-remove form-control-feedback ' . $_feedback_hidden . '"></span>';
									echo $_error;
								echo '</div>';

							endforeach;

						?>
						</div>
					</div>
					<div class="col-md-6">
						<h4>Contact information</h4>
						<hr>
						<div role="form">
						<?php

							$_options	= array();
							$_options[] = array(
								'key'	=> 'first_name',
								'label'	=> 'First Name'
							);
							$_options[] = array(
								'key'	=> 'last_name',
								'label'	=> 'Surname'
							);
							$_options[] = array(
								'key'	=> 'email',
								'label'	=> 'Email address'
							);
							$_options[] = array(
								'key'	=> 'telephone',
								'label'	=> 'Telephone'
							);

							foreach ( $_options AS $opt ) :

								$_error				= form_error( $opt['key'], '<p class="help-block">', '</p>' );
								$_has_error			= $_error ? 'has-error' : '';
								$_has_feedback		= $_error ? 'has-feedback' : '';
								$_feedback_hidden	= $_has_feedback ? '' : 'hidden';
								$_active_user		= active_user( $opt['key'] );
								$_active_user		= is_string( $_active_user ) ? $_active_user : '';
								$_value				= set_value( $opt['key'], $_active_user );

								echo '<div class="form-group ' . $_has_error . ' ' . $_has_feedback . '">';
									echo '<label class="control-label" for="' . $opt['key'] . '">' . $opt['label'] . '</label>';
									echo '<input name="' . $opt['key'] . '" type="text" class="form-control" id="' . $opt['key'] . '" value="' . $_value . '">';
									echo '<span class="glyphicon glyphicon-remove form-control-feedback ' . $_feedback_hidden . '"></span>';
									echo $_error;
								echo '</div>';

							endforeach;

						?>
						</div>
					</div>
				</div>
				<div class="panel-footer hidden">
					<button class="btn action-continue btn-primary btn-success pull-right">Continue</button>
					<div class="clearfix"></div>
				</div>
			</div>

			<div class="panel panel-default" id="checkout-step-2">
				<div class="panel-heading">
					<h3 class="panel-title">
						Step 2 of 3: Billing Details
						<b class="validate-ok fa fa-check-circle fa-lg pull-right text-success hidden"></b>
						<b class="validate-fail fa fa-times-circle fa-lg pull-right text-danger hidden"></b>
					</h3>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
						<h4>Billing address</h4>
						<hr>
						<label>
							<input name="same_billing_address" type="checkbox" checked="checked" id="same-billing-address">
							My billing address is the same as my delivery address
						</label>

						<div class="row billing-address" id="billing-address">
							<div class="col-md-6">
								<hr />
								<div role="form">
								<?php

									$_options	= array();
									$_options[] = array(
										'key'	=> 'billing_address_line_1',
										'label'	=> 'Address Line 1'
									);
									$_options[] = array(
										'key'	=> 'billing_address_line_2',
										'label'	=> 'Address Line 2'
									);
									$_options[] = array(
										'key'	=> 'billing_address_town',
										'label'	=> 'City/Town'
									);
									$_options[] = array(
										'key'	=> 'billing_address_state',
										'label'	=> 'Region/State'
									);
									$_options[] = array(
										'key'	=> 'billing_address_postcode',
										'label'	=> 'Postal Code'
									);
									$_options[] = array(
										'key'	=> 'billing_address_country',
										'label'	=> 'Country',
										'select' => $countries_flat
									);

									foreach ( $_options AS $opt ) :

										$_error				= form_error( $opt['key'], '<p class="help-block">', '</p>' );
										$_has_error			= $_error ? 'has-error' : '';
										$_has_feedback		= $_error ? 'has-feedback' : '';
										$_feedback_hidden	= $_has_feedback ? '' : 'hidden';
										$_active_user		= active_user( $opt['key'] );
										$_active_user		= is_string( $_active_user ) ? $_active_user : '';
										$_value				= set_value( $opt['key'], $_active_user );

										echo '<div class="form-group ' . $_has_error . ' ' . $_has_feedback . '">';
											echo '<label class="control-label" for="' . $opt['key'] . '">' . $opt['label'] . '</label>';

											if ( ! empty( $opt['select'] ) ) :

												echo '<select name="' . $opt['key'] . '" class="form-control select2" id="' . $opt['key'] . '">';
												echo '<option value="">Please Choose...</option>';
												foreach( $opt['select'] AS $value => $label ) :

													$_selected = $value == $_value ? 'selected="selected"' : '';
													echo '<option value="' . $value . '" ' . $_selected . '>' . $label .'</option>';

												endforeach;
												echo '</select>';

											else :

												echo '<input name="' . $opt['key'] . '" type="text" class="form-control" id="' . $opt['key'] . '" value="' . $_value . '">';

											endif;

											echo '<span class="glyphicon glyphicon-remove form-control-feedback ' . $_feedback_hidden . '"></span>';
											echo $_error;
										echo '</div>';

									endforeach;

								?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<button class="btn action-back btn-primary btn-warning">Back</button>
					<button class="btn action-continue btn-primary btn-success pull-right">Continue</button>
					<div class="clearfix"></div>
				</div>

			</div>

			<div class="panel panel-default" id="checkout-step-3">
				<div class="panel-heading">
					<h3 class="panel-title">
						Step 3 of 3: Payment Details
						<b class="validate-ok fa fa-check-circle fa-lg pull-right text-success hidden"></b>
						<b class="validate-fail fa fa-times-circle fa-lg pull-right text-danger hidden"></b>
					</h3>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
						<p>
							Please choose how you wish to pay.
						</p>
						<hr />
						<div class="row">
							<div class="col-md-5">
								<ul class="list-unstyled">
								<?php

									foreach( $payment_gateways AS $gateway ) :

										//	Forgive me Gods of CSS.
										?>
										<li>
											<table class="checkout-payment-gateway-layout">
												<tbody>
													<tr>
														<td class="pg-radio" rowspan="2">
															<?=form_radio( 'payment_gateway', $gateway->slug, set_radio( 'payment_gateway', $gateway->slug ) )?>
														</td>
														<td class="pg-img"><?=$gateway->img ? img( array( 'src' => cdn_serve( $gateway->img ), 'class' => 'img-responsive' ) ) : '' ?></td>
													</tr>
													<tr>
														<td class="pg-label">
															<?=$gateway->label?>
														</td>
													</tr>
												</tbody>
											</table>
										</li>
										<?php

									endforeach;

								?>
								</ul>
							</div>
							<div class="col-md-7">
								<div id="card-form">
									<div class="well well-sm">
										<div class="row">
											<div class="col-xs-12">
												<?=form_input( 'card_number', set_value( 'card_number' ), 'class="form-control card-number" placeholder="Card Number"' )?>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-9">
												<?php

													$_options = array(
														'Expire Month',
														'01 - Jan',
														'02 - Feb',
														'03 - Mar',
														'04 - Apr',
														'05 - May',
														'06 - Jun',
														'07 - Jul',
														'08 - Aug',
														'09 - Sep',
														'10 - Oct',
														'11 - Nov',
														'12 - Dec'
													);

													echo form_dropdown( 'card_expire_month', $_options, set_value( 'card_expire_month' ), 'class="form-control card-expire-month" placeholder="Expires (MM/YY)"' );

													$_options = range( date( 'Y' ), date( 'Y' ) + 10 );
													$_options = array( 'Expire Year' ) + array_combine( $_options, $_options );

													echo form_dropdown( 'card_expire_year', $_options, set_value( 'card_expire_year' ), 'class="form-control card-expire-year" placeholder="Expires (MM/YY)"' );

												?>
											</div>
											<div class="col-xs-3">
												<?=form_input( 'card_number', set_value( 'card_number' ), 'class="form-control card-cvc" placeholder="CVC"' )?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 hidden" id="checkout-card-form">
						<div role="form">
							<div class="form-group">
								<label for="address_1">Card Number</label>
								<input type="text" class="form-control" id="card" placeholder="">
							</div>
							<div class="form-group">
								<label for="address_1">Expiry Date</label>
								<div class="row">
									<div class="col-md-6">
										<select class="form-control" id="expiry-month">
											<option value="">Jan (01)</option>
										</select>
									</div>
									<div class="col-md-6">
										<select class="form-control" id="expiry-month">
											<option value="">2014</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="address_1">Security Code</label>
								<div class="row">
									<div class="col-md-6">
										<input type="text" class="form-control" id="address_3" placeholder="">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<button class="btn action-back btn-primary btn-warning">Back</button>
					<button type="submit" class="btn action-continue btn-primary btn-primary pull-right">Place Order &amp; Pay</button>
					<div class="clearfix"></div>
				</div>
			</div>


		</div>

	</div>
	<?=form_close()?>
</div>