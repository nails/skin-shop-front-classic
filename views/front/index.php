<div class="nails-shop-skin-front-classic browse index">
    <div class="row">
    <?php

        echo '<div class="col-md-9 col-md-push-3">';
            $this->load->view($skin->path . 'views/front/_components/browse_products');
        echo '</div>';
        $this->load->view($skin->path . 'views/front/_components/sidebar_home');

    ?>
    </div>
</div>