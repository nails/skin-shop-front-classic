A new delivery enquiry has been placed on <?=APP_NAME?>'s store for item listed below.

Please find details below:

---------------

Product:
<?php

echo $product->label;
if ( ! empty( $variant->label ) ) :

	echo ' / ' . $variant->label;
	echo ! empty( $variant->sku ) ? "\n" . 'SKU: ' . $variant->sku : '';

endif;

?>


Name:
<?=!empty( $customer->name ) ? $customer->name : '-'?>


Email:
<?=!empty( $customer->email ) ? $customer->email : '-'?>


Telephone:
<?=!empty( $customer->telephone ) ? $customer->telephone : '-'?>


Address:
<?=!empty( $customer->address ) ? $customer->address : '-'?>


Notes:
<?=!empty( $customer->notes ) ? $customer->notes : '-'?>
