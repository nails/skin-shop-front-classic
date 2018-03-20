<div class="nails-skin-shop-front-classic browse index">
    <div class="row">
    <?php

    $oView = \Nails\Factory::service('View');
    $oView->load($skin->path . 'views/front/_components/sidebar_home');
    echo '<div class="col-md-9">';
    $oView->load($skin->path . 'views/front/_components/browse_products');
    echo '</div>';

    ?>
    </div>
</div>