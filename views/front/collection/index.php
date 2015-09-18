<div class="nails-shop-skin-front-classic browse collection">
    <div class="row">
        <div class="col-md-12">
            <h1><?=$shop_name . ': Collections'?></h1>
            <?php

                //  Prepare the breadcrumbs
                $crumbs    = array();
                $crumbs[] = array(
                    'id'    => null,
                    'label' => 'Collections',
                    'url'   => $shop_url . 'collection'
               );

                $this->load->view(
                    $skin->path . 'views/front/_components/browse_breadcrumb',
                    array(
                        'crumbs' => $crumbs,
                        'active_id' => null
                    )
                );

            ?>
        </div>
    </div>
    <?php

        if (!empty($collections)) {

            $perRow  = 2;
            $counter = 0;
            $rowOpen = false;

            foreach ($collections as $collection) {

                if (empty($rowOpen)) {

                    $rowOpen = true;
                    echo '<div class="row">';
                }

                $background = $collection->cover_id ? 'style="background-image: url(' . cdnCrop($collection->cover_id, 800, 800) . ')"' : '';

                echo '<div class="col-sm-6">';
                    echo '<div class="panel panel-default collection" ' . $background . '>';
                        echo '<div class="panel-body small">';
                            echo '<div class="mask"></div>';
                            echo '<p><strong>' . anchor($collection->url, $collection->label) . '</strong></p>';
                            echo $collection->seo_description ? '<p>' . $collection->seo_description . '</p>' : '';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';

                if ($counter % $perRow == $perRow-1) {

                    $rowOpen = false;
                    echo '</div>';
                }

                $counter++;
            }

            if (!empty($rowOpen)) {

                $rowOpen = false;
                echo '</div>';
            }

        } else {

            echo '<div class="row">';
                echo '<div class="col-md-12">';
                    echo '<p>No Collections were found.</p>';
                echo '</div>';
            echo '</div>';
        }

    ?>
</div>