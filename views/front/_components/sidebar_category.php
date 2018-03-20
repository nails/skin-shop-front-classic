<div class="sidebar-filter col-md-3 col-md-pull-9 hidden-xs hidden-sm">
    <?php

    $oView = \Nails\Factory::service('View');
    $oView->load($skin->path . 'views/front/_components/sidebar_searchform');
    $oView->load($skin->path . 'views/front/_components/sidebar_basket');

    ?>
    <ul class="list-group">
        <li class="list-group-item">
            <p>
                <strong>Categories</strong>
            </p>
            <ul class="list-unstyled rsaquo-list category-nav">
                <li class="level-' . $indent . '">
                    <?=anchor($shop_url, $shop_name)?>
                </li>
                <?php

                $indent = 1;

                foreach ($category->breadcrumbs as $crumb) {

                    if ($crumb->id == $category->id) {

                        ?>
                        <li class="level-<?=$indent?> current">
                            <strong><?=$crumb->label?></strong>
                        </li>
                        <?php

                    } else {

                        ?>
                        <li class="level-<?=$indent?> current">
                            <?=anchor($this->shop_category_model->formatUrl($crumb->slug), $crumb->label)?>
                        </li>
                        <?php
                    }

                    $indent++;
                }

                $hideEmpty = shopSkinSetting('hide_empty_categories', 'front');

                foreach ($category->children as $crumb) {

                    if ($hideEmpty && empty($crumb->product_count)) {

                        continue;
                    }

                    echo '<li class="level-' . $indent . '">';
                        echo anchor($this->shop_category_model->formatUrl($crumb->slug), $crumb->label);
                    echo '</li>';
                }

                //  Bring the indent back down a level
                $indent--;

                $hideEmpty = shopSkinSetting('hide_empty_categories', 'front');

                foreach ($category_siblings as $crumb) {

                    if ($hideEmpty && empty($crumb->product_count)) {

                        continue;
                    }

                    ?>
                    <li class="level-<?=$indent?> current">
                        <?=anchor($this->shop_category_model->formatUrl($crumb->slug), $crumb->label)?>
                    </li>
                    <?php
                }

                ?>
            </ul>
        </li>
    </ul>
    <?php

    $oView->load($skin->path . 'views/front/_components/sidebar_filters');

    ?>
</div>