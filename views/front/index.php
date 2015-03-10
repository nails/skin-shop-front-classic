<div class="nails-shop-skin-front-classic browse index">
    <div class="row">
    <?php

		$this->load->view($skin->path . 'views/front/_components/sidebar_home');
        echo '<div class="col-md-9">';
            $this->load->view($skin->path . 'views/front/_components/browse_products');
        echo '</div>';

    ?>
    </div>
</div>