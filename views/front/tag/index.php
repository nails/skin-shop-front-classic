<div class="nails-skin-shop-front-classic browse tag">
    <div class="row">
        <div class="col-md-12">
            <h1><?=$shop_name . ': Tags'?></h1>
            <?php

                //  Prepare the breadcrumbs
                $crumbs   = array();
                $crumbs[] = array(
                    'id'    => null,
                    'label' => 'Tags',
                    'url'   => $shop_url . 'tag'
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

    if (!empty($tags)) {

        $perRow  = 2;
        $counter = 0;
        $rowOpen = false;

        foreach ($tags as $tag) {

            if (empty($rowOpen)) {

                $rowOpen = true;
                echo '<div class="row">';
            }

            $background = $tag->cover_id ? 'style="background-image: url(' . cdnCrop($tag->cover_id, 800, 800) . ')"' : '';

            echo '<div class="col-sm-6">';
                echo '<div class="panel panel-default tag" ' . $background . '>';
                    echo '<div class="panel-body small">';
                        echo '<div class="mask"></div>';
                        echo '<p><strong>' . anchor($tag->url, $tag->label) . '</strong></p>';
                        echo $tag->seo_description ? '<p>' . $tag->seo_description . '</p>' : '';
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
                echo '<p>No Tags were found.</p>';
            echo '</div>';
        echo '</div>';
    }

    ?>
</div>