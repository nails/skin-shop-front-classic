<?php

    if ($product->featured_img) {

        $url = cdn_thumb($product->featured_img, 360, 360);

    } else {

        $url = $skin_front->url . 'assets/img/product-no-image.png';
    }

    echo '<div class="product-image">';
        echo anchor($product->url, img(array('src' => $url, 'class' => 'img-responsive img-thumbnail center-block')));

        if (count($product->variations) > 1) {

            if (app_setting('browse_product_ribbon_mode', 'shop-' . $skin_front->slug) == 'corner') {

                echo '<div class="ribbon corner">';
                    echo '<div class="ribbon-wrapper">';
                        echo '<div class="ribbon-text">';
                            echo count($product->variations) . ' options';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';

            } else {

                echo '<div class="ribbon horizontal">';
                    echo count($product->variations) . ' options available';
                echo '</div>';
            }
        }

    echo '</div>';

    echo '<p>' . anchor($product->url, $product->label) . '</p>';
    echo '<p>';
        echo '<span class="badge">' . $product->price->user_formatted->price_string . '</span>';
    echo '</p>';
    echo '<hr class="hidden-sm hidden-md hidden-lg" />';