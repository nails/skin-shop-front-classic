<div class="nails-shop-skin-front-classic browse tag single">
<?php

    $this->load->view($skin->path . 'views/front/_components/cover_tag');

    echo '<div class="row">';

        echo '<div class="col-md-9 col-md-push-3">';

            $this->load->view($skin->path . 'views/front/_components/browse_products');

        echo '</div>';

        $this->load->view($skin->path . 'views/front/_components/sidebar_tag');

    echo '</div>';

?>
</div>