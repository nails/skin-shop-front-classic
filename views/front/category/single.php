<div class="nails-skin-shop-front-classic browse category single">
<?php

    $this->load->view($skin->path . 'views/front/_components/cover_category');

    echo '<div class="row">';

        echo '<div class="col-md-9 col-md-push-3">';

            $this->load->view($skin->path . 'views/front/_components/browse_products');

        echo '</div>';

        $this->load->view($skin->path . 'views/front/_components/sidebar_category');

    echo '</div>';

?>
</div>