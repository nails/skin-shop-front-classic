<div class="nails-skin-shop-front-classic browse category">
    <div class="row">
    <?php

    $oView = \Nails\Factory::service('View');
    $oView->load($skin->path . 'views/front/_components/browse_products');
    $oView->load($skin->path . 'views/front/_components/sidebar_home');

    ?>
    </div>
</div>