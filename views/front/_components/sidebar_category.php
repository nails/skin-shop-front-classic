<div class="sidebar-filter col-md-3 col-md-pull-9 hidden-xs hidden-sm">
    <?php

        $this->load->view($skin->path . 'views/front/_components/sidebar_searchform');
        $this->load->view($skin->path . 'views/front/_components/sidebar_basket');

    ?>
    <ul class="list-group">
        <li class="list-group-item">
            <?php

                echo '<p>';
                    echo '<strong>Categories</strong>';
                echo '</p>';

                $indent = 0;

                echo '<ul class="list-unstyled rsaquo-list category-nav">';

                    //  Home first
                    echo '<li class="level-' . $indent . '">';
                        echo anchor($shop_url, $shop_name);
                    echo '</li>';

                    $indent++;

                    foreach ($category->breadcrumbs as $crumb) {

                        if ($crumb->id == $category->id) {

                            echo '<li class="level-' . $indent . ' current">';
                                echo '<strong>' . $crumb->label . '</strong>';
                            echo '</li>';

                        } else {

                            echo '<li class="level-' . $indent . '">';
                                echo anchor($this->shop_category_model->format_url($crumb->slug), $crumb->label);
                            echo '</li>';
                        }

                        $indent++;
                    }

                    $hideEmpty = appSetting('hide_empty_categories', 'shop-' . $skin->slug);

                    foreach ($category->children as $crumb) {

                        if ($hideEmpty && empty($crumb->product_count)) {

                            continue;
                        }

                        echo '<li class="level-' . $indent . '">';
                            echo anchor($this->shop_category_model->format_url($crumb->slug), $crumb->label);
                        echo '</li>';
                    }

                    //  Bring the indent back down a level
                    $indent--;

                    $hideEmpty = appSetting('hide_empty_categories', 'shop-' . $skin->slug);

                    foreach ($category_siblings as $crumb) {

                        if ($hideEmpty && empty($crumb->product_count)) {

                            continue;
                        }

                        echo '<li class="level-' . $indent . '">';
                            echo anchor($this->shop_category_model->format_url($crumb->slug), $crumb->label);
                        echo '</li>';
                    }

                echo '</ul>';

            ?>
        </li>
    </ul>
    <?php

        $this->load->view($skin->path . 'views/front/_components/sidebar_filters');

    ?>
</div>