<div class="nails-skin-shop-front-classic browse product single">
    <div class="row">
    <?php

    $oView = \Nails\Factory::service('View');
    $oView->load($skin->path . 'views/front/_components/back_to_shop');
    $oView->load($skin->path . 'views/front/_components/product_single');

    ?>
    </div>
</div>