<hr class="hidden-md hidden-lg" />
<div class="sidebar-home col-md-3 col-md-pull-9">
<?php

    $this->load->view($skin_front->path . 'views/front/_components/sidebar_searchform');

    echo '<ul class="list-group">';

        if (!empty($categories)) {

            echo '<li class="list-group-item">';
                echo '<h3 class="list-group-item-heading">Categories</h3>';
                echo '<ul class="list-unstyled rsaquo-list">';

                    $hideEmpty = app_setting('hide_empty_categories', 'shop-' . $skin_front->slug);

                    foreach($categories as $category) {

                        if ($hideEmpty && empty($category->product_count)) {

                            continue;
                        }

                        echo '<li>';
                            echo anchor($category->url, $category->label);
                        echo '</li>';
                    }

                echo '</ul>';
            echo '</li>';
        }

        if (!empty($brands)) {

            echo '<li class="list-group-item">';
                echo '<h3 class="list-group-item-heading">Brands</h3>';
                echo '<ul class="list-unstyled rsaquo-list">';

                    $hideEmpty = app_setting('hide_empty_brands', 'shop-' . $skin_front->slug);

                    foreach ($brands as $brand) {

                        if ($hideEmpty && empty($brand->product_count)) {

                            continue;
                        }

                        echo '<li>';
                            echo anchor($brand->url, $brand->label);
                        echo '</li>';
                    }

                echo '</ul>';
            echo '</li>';
        }

        if (!empty($ranges)) {

            echo '<li class="list-group-item">';
                echo '<h3 class="list-group-item-heading">Ranges</h3>';
                echo '<ul class="list-unstyled rsaquo-list">';

                    $hideEmpty = app_setting('hide_empty_ranges', 'shop-' . $skin_front->slug);

                    foreach ($ranges as $range) {

                        if ($hideEmpty && empty($range->product_count)) {

                            continue;
                        }

                        echo '<li>';
                            echo anchor($range->url, $range->label);
                        echo '</li>';
                    }

                echo '</ul>';
            echo '</li>';
        }

        if (!empty($collections)) {

            echo '<li class="list-group-item">';
                echo '<h3 class="list-group-item-heading">Collections</h3>';
                echo '<ul class="list-unstyled rsaquo-list">';

                    $hideEmpty = app_setting('hide_empty_collections', 'shop-' . $skin_front->slug);

                    foreach ($collections as $collection) {

                        if ($hideEmpty && empty($collection->product_count)) {

                            continue;
                        }

                        echo '<li>';
                            echo anchor($collection->url, $collection->label);
                        echo '</li>';
                    }

                echo '</ul>';
            echo '</li>';
        }

    echo '</ul>';

?>
</div>