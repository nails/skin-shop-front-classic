<div class="nails-skin-shop-front-classic browse brand single">
<?php

$oView = \Nails\Factory::service('View');

$oView->load($skin->path . 'views/front/_components/cover_brand');

echo '<div class="row">';
echo '<div class="col-md-9 col-md-push-3">';
$oView->load($skin->path . 'views/front/_components/browse_products');
echo '</div>';
$oView->load($skin->path . 'views/front/_components/sidebar_brand');
echo '</div>';

?>
</div>