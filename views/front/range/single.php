<div class="nails-shop-skin-front-classic browse range single">
<?php

    $this->load->view($skin->path . 'views/front/_components/cover_range');

    echo '<div class="row">';

        echo '<div class="col-md-9 col-md-push-3">';

            $this->load->view($skin->path . 'views/front/_components/browse_products');

        echo '</div>';

        $this->load->view($skin->path . 'views/front/_components/sidebar_range');

    echo '</div>';

?>
</div>