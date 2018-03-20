<div class="row cover category hidden-xs visible-sm visible-md visible-lg">
    <div class="col-xs-12">
        <?php

            if (!empty($brand->cover_id)) {

                $url   = cdnScale($brand->cover_id, 1000, 500);
                $style = 'style="background-image:url(' . $url . ');background-size:cover;"';

            } else {

                $style = '';
            }

            echo '<div class="background brand" ' . $style . '>';
                echo '<div class="overlay">';
                    echo '<h1>' . $brand->label . '</h1>';
                echo '</div>';
            echo '</div>';

            // --------------------------------------------------------------------------

            //  Prepare the breadcrumbs
            $crumbs   = array();
            $crumbs[] = array(
                'id'    => null,
                'label' => 'Brands',
                'url'   => appSetting('page_brand_listing', 'nailsapp/module-shop') ? $shop_url . 'brand' : null
            );

            $crumbs[] = array(
                'id'    => $brand->id,
                'label' => $brand->label,
                'url'   => $brand->url
            );

            $view = $skin->path . 'views/front/_components/browse_breadcrumb';
            $data = array('crumbs' => $crumbs, 'active_id' => $brand->id);

            $oView = \Nails\Factory::service('View');
            $oView->load($view, $data);

            // --------------------------------------------------------------------------

            if (trim(strip_tags($brand->description))) {

                echo '<div class="description">';
                    echo $brand->description;
                echo '</div>';
            }

        ?>
    </div>
</div>