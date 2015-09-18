<div class="sidebar-filter col-md-3 col-md-pull-9 hidden-xs hidden-sm">
<?php

    if (!empty($brand->logo_id)) {

        echo '<div class="brand-logo">';
            echo '<img src="' . cdnScale($brand->logo_id, 350, 350). '" class="img-responsive img-thumbnail" />';
        echo '</div>';
    }

    $this->load->view($skin->path . 'views/front/_components/sidebar_searchform');
    $this->load->view($skin->path . 'views/front/_components/sidebar_basket');
    $this->load->view($skin->path . 'views/front/_components/sidebar_filters');

?>
</div>