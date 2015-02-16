<div class="nails-shop-skin-front-classic browse brand">
    <div class="row">
        <div class="col-md-12">
            <h1><?=$shop_name . ': Brands'?></h1>
            <?php

                //  Prepare the breadcrumbs
                $crumbs    = array();
                $crumbs[] = array(
                    'id'    => null,
                    'label' => 'Brands',
                    'url'   => $shop_url . 'brand'
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

        if (!empty($brands)) {

            $perRow  = 2;
            $counter = 0;
            $rowOpen = false;

            foreach ($brands as $brand) {

                if (empty($rowOpen)) {

                    $rowOpen = true;
                    echo '<div class="row">';
                }

                $background = $brand->cover_id ? 'style="background-image: url(' . cdn_thumb($brand->cover_id, 800, 800) . ')"' : '';

                echo '<div class="col-sm-6">';
                    echo '<div class="panel panel-default brand" ' . $background . '>';
                        echo '<div class="panel-body small">';
                            echo '<div class="mask"></div>';
                            echo '<p><strong>' . anchor($brand->url, $brand->label) . '</strong></p>';
                            echo $brand->seo_description ? '<p>' . $brand->seo_description . '</p>' : '';
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
                    echo '<p>No Brands were found.</p>';
                echo '</div>';
            echo '</div>';
        }

    ?>
</div>