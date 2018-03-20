<div class="nails-skin-shop-front-classic browse tag single">
    <?php

    $oView = \Nails\Factory::service('View');
    $oView->load($skin->path . 'views/front/_components/cover_tag');

    ?>
    <div class="row">
        <div class="col-md-9 col-md-push-3">
            <?php

            $oView->load($skin->path . 'views/front/_components/browse_products');

            ?>
        </div>
        <?php

        $oView->load($skin->path . 'views/front/_components/sidebar_tag');

        ?>
    </div>
</div>