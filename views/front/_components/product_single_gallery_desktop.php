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

    //  Medium and Large breakpoints
    echo '<div class="hidden-xs hidden-sm visible-md visible-lg clearfix">';

        echo '<div class="text-center featured-image-md-lg">';

            if (!empty($featuredImg['url'])) {

                echo '<a href="' . $featuredImg['url'] . '" class="featured-img-link" target="_blank">';
            }

            echo img(array('src' => $featuredImg['thumb'], 'class' => 'img-responsive img-thumbnail featured-img-img'));

            if (!empty($featuredImg['url'])) {

                echo '</a>';
            }

        echo '</div>';

        if (count($gallery) > 1) {

            echo '<div class="row text-center gallery-md-lg">';
            foreach ($gallery as $item) {

                echo '<div class="col-md-4 col-lg-4 gallery-item">';
                if (!empty($item['url'])) {

                    echo '<a href="' . $item['url'] . '" class="gallery-link" target="_blank">';
                }

                echo img(array('src' => $item['thumb'], 'class' => 'img-responsive img-thumbnail gallery-img'));

                if (!empty($item['url'])) {

                    echo '</a>';
                }
                echo '</div>';
            }
            echo '</div>';
        }

    echo '</div>';