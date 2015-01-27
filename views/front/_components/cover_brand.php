<div class="row cover category">
    <div class="col-xs-12">
        <?php

            if (!empty($brand->cover_id)) {

                $url   = cdn_scale($brand->cover_id, 1000, 500);
                $style = 'style="background-image:url(' . $url . ');background-size:cover;"';

            } else {

                $style = '';
            }

            echo '<div class="background brand" ' . $style . '>';
                echo '<div class="overlay">';
                    echo '<h2>' . $brand->label . '</h2>';
                echo '</div>';
            echo '</div>';

            // --------------------------------------------------------------------------

            //  Prepare the breadcrumbs
            $crumbs    = array();
            $crumbs[]  = array(
                'id'    => null,
                'label' => 'Brands',
                'url'   => app_setting('page_brand_listing', 'shop') ? $shop_url . 'brand' : null
            );

            $crumbs[]  = array(
                'id'    => $brand->id,
                'label' => $brand->label,
                'url'   => $brand->url
            );

            $view = $skin->path . 'views/front/_components/browse_breadcrumb';
            $data = array('crumbs' => $crumbs, 'active_id' => $brand->id);

            $this->load->view($view, $data);

            // --------------------------------------------------------------------------

            if (trim(strip_tags($brand->description))) {

                echo '<div class="description">';
                    echo $brand->description;
                echo '</div>';
            }

        ?>
    </div>
</div>