<div class="nails-shop-skin-front-classic browse range">
    <div class="row">
        <div class="col-md-12">
            <h1><?=$shop_name . ': Ranges'?></h1>
            <?php

                //  Prepare the breadcrumbs
                $crumbs   = array();
                $crumbs[] = array(
                    'id'    => null,
                    'label' => 'Ranges',
                    'url'   => $shop_url . 'range'
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

        if (!empty($ranges)) {

            $perRow  = 2;
            $counter = 0;
            $rowOpen = false;

            foreach ($ranges as $range) {

                if (empty($rowOpen)) {

                    $rowOpen = true;
                    echo '<div class="row">';
                }

                $background = $range->cover_id ? 'style="background-image: url(' . cdnCrop($range->cover_id, 800, 800) . ')"' : '';

                echo '<div class="col-sm-6">';
                    echo '<div class="panel panel-default range" ' . $background . '>';
                        echo '<div class="panel-body small">';
                            echo '<div class="mask"></div>';
                            echo '<p><strong>' . anchor($range->url, $range->label) . '</strong></p>';
                            echo $range->seo_description ? '<p>' . $range->seo_description . '</p>' : '';
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
                    echo '<p>No Ranges were found.</p>';
                echo '</div>';
            echo '</div>';
        }

    ?>
</div>