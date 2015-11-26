<div class="nails-skin-shop-front-classic browse search">
    <div class="row">
        <div class="col-md-9 col-md-push-3">
            <?php

            $this->load->view($skin->path . 'views/front/_components/browse_products');

            ?>
        </div>
        <?php

        $this->load->view($skin->path . 'views/front/_components/sidebar_search');

        ?>
    </div>
</div>