<p>
	A new delivery enquiry has been placed on <?=APP_NAME?>'s store for item listed below.
<p>
<p>
	Please find details below:
</p>
<table class="default-style">
	<tbody>
		<tr>
			<td class="left-header-cell">
				Product
			</td>
			<td>
			<?php

				echo '<strong>' . $product->label . '</strong>';
				if ( ! empty( $variant->label ) ) :

					echo ' / ' . $variant->label;
					echo ! empty( $variant->sku ) ? '<br />SKU: ' . $variant->sku : '';

				endif;

			?>
			</td>
		</tr>
		<tr>
			<td class="left-header-cell">
				Name
			</td>
			<td>
				<?=!empty( $customer->name ) ? $customer->name : '-'?>
			</td>
		</tr>
		<tr>
			<td class="left-header-cell">
				Email
			</td>
			<td>
				<?=!empty( $customer->email ) ? $customer->email : '-'?>
			</td>
		</tr>
		<tr>
			<td class="left-header-cell">
				Telephone
			</td>
			<td>
				<?=!empty( $customer->telephone ) ? $customer->telephone : '-'?>
			</td>
		</tr>
		<tr>
			<td class="left-header-cell">
				Address
			</td>
			<td>
				<?=!empty( $customer->address ) ? nl2br( $customer->address ) : '-'?>
			</td>
		</tr>
		<tr>
			<td class="left-header-cell">
				Notes
			</td>
			<td>
				<?=!empty( $customer->notes ) ? $customer->notes : '-'?>
			</td>
		</tr>
	</tbody>
</table>