<?php

    //  Featured Image
    $featuredImg = array('url' => '', 'thumb' => '');

    if ($product->featured_img) {

        $featuredImg['url']   = cdn_serve($product->featured_img);
        $featuredImg['thumb'] = cdn_thumb($product->featured_img, 800, 800);
        echo '<meta itemprop="image" content="' . cdn_thumb($product->featured_img, 800, 800) . '" />';

    } else {

        $featuredImg['thumb'] = $skin->url . 'assets/img/product-no-image.png';
    }

    // --------------------------------------------------------------------------

    //  Gallery
    $gallery = array();
    foreach ($product->gallery as $object_id) {

        $gallery[] = array(
            'url'   => cdn_serve($object_id),
            'thumb' => cdn_thumb($object_id, 800, 800)
       );
    }

    // --------------------------------------------------------------------------

    //  Extra small and Small breakpoints
    echo '<div class="visible-xs visible-sm hidden-md hidden-lg clearfix">';

        echo '<div class="row featured-image-xs-sm">';

            if (count($gallery) > 1) {

                echo '<div class="col-xs-9">';

            } else {

                echo '<div class="col-xs-12">';
            }

                if (!empty($featuredImg['url'])) {

                    echo '<a href="' . $featuredImg['url'] . '" class="featured-img-link">';
                }

                echo img(
                    array(
                        'src' => $featuredImg['thumb'],
                        'class' => 'img-responsive img-thumbnail featured-img-img'
                    )
                );

                if (!empty($featuredImg['url'])) {

                    echo '</a>';
                }

            echo '</div>';

            if (count($gallery) > 1) {

                echo '<div class="gallery-scroll gallery-xs-sm">';

                    foreach ($gallery as $item) {

                        echo '<div class="text-center gallery-item">';

                        if (!empty($item['url'])) {

                            echo '<a href="' . $item['url'] . '" class="gallery-link">';
                        }

                        echo img(
                            array(
                                'src' => $item['thumb'],
                                'class' => 'center-block img-responsive img-thumbnail gallery-img'
                            )
                        );

                        if (!empty($item['url'])) {

                            echo '</a>';
                        }

                        echo '</div>';
                    }

                echo '</div>';

            }

        echo '</div>';

    echo '</div>';
