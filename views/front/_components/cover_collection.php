<div class="row cover collection hidden-xs visible-sm visible-md visible-lg">
    <div class="col-xs-12">
        <?php

            if (!empty($collection->cover_id)) {

                $url   = cdnScale($collection->cover_id, 1000, 500);
                $style = 'style="background-image:url(' . $url . ');background-size:cover;"';

            } else {

                $style = '';
            }

            echo '<div class="background collection" ' . $style . '>';
                echo '<div class="overlay">';
                    echo '<h1>' . $collection->label . '</h1>';
                echo '</div>';
            echo '</div>';

            // --------------------------------------------------------------------------

            //  Prepare the breadcrumbs
            $crumbs   = array();
            $crumbs[] = array(
                'id'    => NULL,
                'label' => 'Collections',
                'url'   => appSetting('page_collection_listing', 'nailsapp/module-shop') ? $shop_url . 'collection' : NULL
            );

            $crumbs[] = array(
                'id'    => $collection->id,
                'label' => $collection->label,
                'url'   => $collection->url
            );

            $view = $skin->path . 'views/front/_components/browse_breadcrumb';
            $data = array('crumbs' => $crumbs, 'active_id' => $collection->id);
            $this->load->view($view, $data);

            // --------------------------------------------------------------------------

            if (trim(strip_tags($collection->description))) {

                echo '<div class="description">';
                    echo $collection->description;
                echo '</div>';
            }

        ?>
    </div>
</div>