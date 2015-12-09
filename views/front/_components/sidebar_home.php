<div class="sidebar-home col-md-3">

<?php

    $this->load->view($skin->path . 'views/front/_components/sidebar_searchform');
    $this->load->view($skin->path . 'views/front/_components/sidebar_basket');

    if (!empty($categories)) {

        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Categories
                    <span class="pull-right clickable">
                        <i class="glyphicon glyphicon-chevron-down"></i>
                    </span>
                </h3>
            </div>
            <div class="panel-body">
            <?php

                echo '<ul class="list-unstyled rsaquo-list">';

                    $hideEmpty = shopSkinSetting('hide_empty_categories', 'front');

                    foreach ($categories as $category) {

                        if ($hideEmpty && empty($category->product_count)) {

                            continue;
                        }

                        echo '<li>';
                            echo anchor($category->url, $category->label);
                        echo '</li>';
                    }

                echo '</ul>';

            ?>
            </div>
        </div>


    <?php

    }

    if (!empty($brands)) {

        ?>
        <div class="panel panel-default">
            <div class="panel-heading panel-collapsed">
                <h3 class="panel-title">
                    Brands
                    <span class="pull-right clickable">
                        <i class="glyphicon glyphicon-chevron-up"></i>
                    </span>
                </h3>
            </div>
            <div class="panel-body" style="display:none;">
            <?php

                echo '<ul class="list-unstyled rsaquo-list">';

                    $hideEmpty = shopSkinSetting('hide_empty_brands', 'front');

                    foreach ($brands as $brand) {

                        if ($hideEmpty && empty($brand->product_count)) {

                            continue;
                        }

                        echo '<li>';
                            echo anchor($brand->url, $brand->label);
                        echo '</li>';
                    }

                echo '</ul>';

            ?>
            </div>
        </div>
        <?php

    }

    if (!empty($ranges)) {

        ?>
        <div class="panel panel-default">
            <div class="panel-heading panel-collapsed">
                <h3 class="panel-title">
                    Ranges
                    <span class="pull-right clickable">
                        <i class="glyphicon glyphicon-chevron-up"></i>
                    </span>
                </h3>
            </div>
            <div class="panel-body" style="display:none;">
            <?php

                echo '<ul class="list-unstyled rsaquo-list">';

                    $hideEmpty = shopSkinSetting('hide_empty_ranges', 'front');

                    foreach ($ranges as $range) {

                        if ($hideEmpty && empty($range->product_count)) {

                            continue;
                        }

                        echo '<li>';
                            echo anchor($range->url, $range->label);
                        echo '</li>';
                    }

                echo '</ul>';

            ?>
            </div>
        </div>
        <?php

    }

    if (!empty($collections)) {

        ?>
        <div class="panel panel-default">
            <div class="panel-heading panel-collapsed">
                <h3 class="panel-title">
                    Collections
                    <span class="pull-right clickable">
                        <i class="glyphicon glyphicon-chevron-up"></i>
                    </span>
                </h3>
            </div>
            <div class="panel-body" style="display:none;">
            <?php

                echo '<ul class="list-unstyled rsaquo-list">';

                    $hideEmpty = shopSkinSetting('hide_empty_collections', 'front');

                    foreach ($collections as $collection) {

                        if ($hideEmpty && empty($collection->product_count)) {

                            continue;
                        }

                        echo '<li>';
                            echo anchor($collection->url, $collection->label);
                        echo '</li>';
                    }

                echo '</ul>';

            ?>
            </div>
        </div>
        <?php

    }

    if (!empty($shop_pages)) {

        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Pages
                    <span class="pull-right clickable">
                        <i class="glyphicon glyphicon-chevron-down"></i>
                    </span>
                </h3>
            </div>
            <div class="panel-body">
                <ul class="list-unstyled rsaquo-list">
                <?php

                foreach ($shop_pages as $aPage) {

                    ?>
                    <li>
                        <?=anchor($aPage['url'], $aPage['title'])?>
                    </li>
                    <?php
                }

                ?>
                </ul>
            </div>
        </div>
        <?php

    }

?>
</div>