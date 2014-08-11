<div class="nails-skin-shop-classic checkout">
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

						echo '<p>Simply complete the forms below and then click or tap the "Confirm &amp; Pay" button.</p>';

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

			<div class="progress">
				<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%;">
					Step 1 of 3
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Step 1 of 3: Contact &amp; Delivery Details</h3>
				</div>
				<div class="panel-body">
					<div class="col-md-6">
						<h4>Delivery address</h4>
						<hr>
						<form role="form">
							<div class="form-group">
								<label for="address_1">Address Line 1</label>
								<input type="text" class="form-control" id="address_1" placeholder="">
							</div>
							<div class="form-group">
								<label for="address_1">Address Line 2</label>
								<input type="text" class="form-control" id="address_2" placeholder="">
							</div>
							<div class="form-group">
								<label for="address_1">Address Line 2</label>
								<input type="text" class="form-control" id="address_3" placeholder="">
							</div>
							<div class="form-group">
								<label for="address_city">City</label>
								<input type="text" class="form-control" id="city" placeholder="">
							</div>
							<div class="form-group">
								<label for="address_region">Region</label>
								<input type="text" class="form-control" id="region" placeholder="">
							</div>
							<div class="form-group">
								<label for="address_postcode">Postal Code</label>
								<input type="text" class="form-control" id="address_postcode" placeholder="">
							</div>
						</form>
					</div>
					<div class="col-md-6">
						<h4>Contact information</h4>
						<hr>
						<form role="form">
							<div class="form-group">
								<label for="first_name">First Name</label>
								<input type="text" class="form-control" id="first_name" placeholder="">
							</div>
							<div class="form-group">
								<label for="last_name">Surname</label>
								<input type="text" class="form-control" id="last_name" placeholder="">
							</div>
							<div class="form-group">
								<label for="email">Email address</label>
								<input type="email" class="form-control" id="email" placeholder="">
							</div>
							<div class="form-group">
								<label for="telephone">Telephone</label>
								<input type="text" class="form-control" id="telephone" placeholder="">
							</div>
						</form>
					</div>
				</div>
				<div class="panel-footer">
					<a href="#" class="btn btn-primary btn-success pull-right">Continue</a>
					<div class="clearfix"></div>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Step 2 of 3: Billing Details</h3>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
						<h4>Billing address</h4>
						<hr>
						<input type="checkbox" checked="checked"> My billing address is the same as my delivery address<br><br>

						<hr class="billing-address">

						<div class="row billing-address">
							<div class="col-md-6">
								<form role="form">
									<div class="form-group">
										<label for="address_1">Address Line 1</label>
										<input type="text" class="form-control" id="address_1" placeholder="">
									</div>
									<div class="form-group">
										<label for="address_1">Address Line 2</label>
										<input type="text" class="form-control" id="address_2" placeholder="">
									</div>
									<div class="form-group">
										<label for="address_1">Address Line 2</label>
										<input type="text" class="form-control" id="address_3" placeholder="">
									</div>
									<div class="form-group">
										<label for="address_city">City</label>
										<input type="text" class="form-control" id="city" placeholder="">
									</div>
									<div class="form-group">
										<label for="address_region">Region</label>
										<input type="text" class="form-control" id="region" placeholder="">
									</div>
									<div class="form-group">
										<label for="address_postcode">Postal Code</label>
										<input type="text" class="form-control" id="address_postcode" placeholder="">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<a href="#" class="btn btn-primary btn-success pull-right">Continue</a>
					<div class="clearfix"></div>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Step 3 of 3: Payment Details</h3>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
						<h4>Payment method<img src="<?=$skin->url . 'assets/img/checkout-cards.png'?>" class="pull-right"></h4>
						<p>
							We accept all major credit and debit cards. Payments are collected safely and securely via WorldPay. We do not directly store any card
							details on our website.
						</p>
						<hr>
					</div>
					<div class="col-md-6">
						<form role="form">
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
						</form>
					</div>
				</div>
				<div class="panel-footer">
					<div class="terms pull-left">
						<input type="checkbox" checked="checked"> I have read and I agree to the <a href="#">terms and conditions</a>.
					</div>
					<a href="#" class="btn btn-primary btn-warning btn-lg pull-right">Confirm &amp; Pay</a>
					<div class="clearfix"></div>
				</div>
			</div>


		</div>

	</div>
</div>