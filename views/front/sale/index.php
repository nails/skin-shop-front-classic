<div class="nails-shop-skin-front-classic browse sale">
    <div class="row">
        <div class="col-md-12">
            <h1><?=$shop_name . ': Sales'?></h1>
            <?php

                //  Prepare the breadcrumbs
                $crumbs   = array();
                $crumbs[] = array(
                    'id'    => null,
                    'label' => 'Sales',
                    'url'   => $shop_url . 'sale'
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

        if (!empty($sales)) {

            $perRow  = 2;
            $counter = 0;
            $rowOpen = false;

            foreach ($sales as $sale) {

                if (empty($rowOpen)) {

                    $rowOpen = true;
                    echo '<div class="row">';
                }

                $background = $sale->cover_id ? 'style="background-image: url(' . cdn_thumb($sale->cover_id, 800, 800) . ')"' : '';

                echo '<div class="col-sm-6">';
                    echo '<div class="panel panel-default sale" ' . $background . '>';
                        echo '<div class="panel-body small">';
                            echo '<div class="mask"></div>';
                            echo '<p><strong>' . anchor($sale->url, $sale->label) . '</strong></p>';
                            echo $sale->seo_description ? '<p>' . $sale->seo_description . '</p>' : '';
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
                    echo '<p>No Sales were found.</p>';
                echo '</div>';
            echo '</div>';
        }

    ?>
</div>