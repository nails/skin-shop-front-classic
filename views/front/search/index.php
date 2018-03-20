<div class="nails-skin-shop-front-classic browse search">
    <div class="row">
        <div class="col-md-9 col-md-push-3">
            <?php

            $oView = \Nails\Factory::service('View');
            $oView->load($skin->path . 'views/front/_components/browse_products');

            ?>
        </div>
        <?php

        $oView->load($skin->path . 'views/front/_components/sidebar_search');

        ?>
    </div>
</div>