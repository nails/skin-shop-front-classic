<div class="product col-xs-12" itemscope itemtype="http://schema.org/Product">
    <meta itemprop="url" content="<?=$product->url?>">
    <div itemprop="seller" itemscope itemtype="http://schema.org/Organisation">
        <meta itemprop="name" content="<?=lang( 'site_title' )?>">
        <meta itemprop="address" content="<?=app_setting('invoice_address', 'shop')?>">
        <meta itemprop="vatID" content="<?=app_setting('invoice_vat_no', 'shop')?>">
    </div>
<?php

    echo '<div class="product-label">';
        echo '<h1 class="text-center hidden-md hidden-lg">';
            echo '<span itemprop="name">';
                echo $product->label;
            echo '</span>';
        echo '</h1>';

        echo '<h1 class="hidden-xs hidden-sm">';
            echo $product->label;
        echo '</h1>';
    echo '</div>';

    echo '<hr />';

    echo '<div class="row">';

        //  Right hand column
        echo '<div class="col-md-8 col-md-push-4">';

            $this->load->view($skin->path . 'views/front/_components/product_single_gallery_mobile');

            // --------------------------------------------------------------------------

            //  Variants (mobile)
            $this->load->view($skin->path . 'views/front/_components/product_single_variants_mobile');

            // --------------------------------------------------------------------------

            //  Description
            echo '<div class="product-description">';
                echo '<span itemprop="description">';
                    echo $product->description;
                echo '</span>';
            echo '</div>';

            // --------------------------------------------------------------------------

            //  Social Likes

            //  Defaults
            $layout      = '';
            $singleTitle = app_setting('social_layout_single_text', 'shop-' . $skin->slug) ? app_setting('social_layout_single_text', 'shop-' . $skin->slug) : 'Share';
            $counters    = app_setting('social_counters', 'shop-' . $skin->slug) ? 'data-zeroes="yes"' : 'data-counters="no"';
            $twitterVia  = app_setting('social_twitter_via', 'shop-' . $skin->slug) ? app_setting('social_twitter_via', 'shop-' . $skin->slug) : '';

            //  Layout
            switch (app_setting('social_layout', 'shop-' . $skin->slug)) {

                case 'HORIZONTAL':

                    $layout = '';
                    break;

                case 'VERTICAL':

                    $layout = 'social-likes_vertical';
                    break;

                case 'SINGLE':

                    $layout = 'social-likes_single';
                    break;
            }

            $enabled   = array();
            $enabled[] = app_setting('social_facebook_enabled', 'shop-' . $skin->slug) ? '<div class="facebook" title="Share link on Facebook">Facebook</div>' : '';
            $enabled[] = app_setting('social_twitter_enabled', 'shop-' . $skin->slug) ? '<div class="twitter" data-via="' . $twitterVia . '" title="Share link on Twitter">Twitter</div>' : '';
            $enabled[] = app_setting('social_googleplus_enabled', 'shop-' . $skin->slug) ? '<div class="plusone" title="Share link on Google+">Google+</div>' : '';
            $enabled[] = app_setting('social_pinterest_enabled', 'shop-' . $skin->slug) && $product->featured_img ? '<div class="pinterest" data-media="' . cdn_serve($product->featured_img) . '" title="Share image on Pinterest">Pinterest</div>' : '';

            $enabled = array_filter($enabled);

            if ($enabled) {

                echo '<div class="product-social social-likes ' . $layout . '" ' . $counters . ' data-url="' . $product->url . '" data-single-title="' . $singleTitle . '" data-title="' . $product->label . '">';
                foreach ($enabled as $enabled) {

                    echo $enabled;
                }
                echo '</div>';
            }

            // --------------------------------------------------------------------------

            //  Collection only items?
            if (!$product->is_external) {

                foreach ($product->variations as $variant) {

                    if ($variant->shipping->collection_only) {

                        echo '<p class="alert alert-warning">';
                            echo 'Items marked with <b class="glyphicon glyphicon-map-marker" title="Collection Only"></b> are only available for collection.';
                            if (app_setting('warehouse_collection_delivery_enquiry', 'shop')) {

                                echo anchor($shop_url . 'enquire/delivery/' . $product->id, 'Delivery Enquiry', 'class="btn btn-primary btn-sm pull-right fancybox" data-width="750" data-height="575" data-fancybox-type="iframe"');
                            }
                        echo '</p>';
                        break;
                    }
                }
            }

            // --------------------------------------------------------------------------

            //  Variants (Desktop)
            $this->load->view($skin->path . 'views/front/_components/product_single_variants');

            // --------------------------------------------------------------------------

            //  Attributes
            if (!empty($product->attributes)) {

                echo '<table class="table table-bordered table-striped product-attributes">';
                    echo '<thead>';
                        echo '<tr>';
                            echo '<th>Attribute</th>';
                            echo '<th>Value</th>';
                        echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                        foreach ($product->attributes as $attribute) {

                            echo '<tr>';
                                echo '<td>' . $attribute->label . '</td>';
                                echo '<td>' . $attribute->value . '</td>';
                            echo '</tr>';
                        }

                    echo '</tbody>';

                echo '</table>';
            }

            // --------------------------------------------------------------------------

            //  Related Products
            if (!empty($relatedProducts)) {

                //  Reviews
                echo '<div class="related-products">';

                    echo '<hr />';
                    echo '<h4>Related Products</h4>';

                    echo '<div class="product-browser">';

                        echo '<div class="row">';

                            foreach ($relatedProducts as $related) {

                                echo '<div class="product col-xs-6 col-md-3">';

                                    echo '<div class="product-inner">';

                                        if ($related->featured_img) {

                                            $url = cdn_thumb($related->featured_img, 360, 360);

                                        } else {

                                            $url = $skin->url . 'assets/img/product-no-image.png';
                                        }

                                        echo '<div class="product-image">';

                                            echo anchor(
                                                $related->url,
                                                img(
                                                    array(
                                                        'src' => $url,
                                                        'class' => 'img-responsive img-thumbnail center-block'
                                                    )
                                                )
                                            );

                                            if (count($related->variations) > 1) {

                                                if (app_setting('browse_product_ribbon_mode', 'shop-' . $skin->slug) == 'corner') {

                                                    echo '<div class="ribbon corner">';
                                                        echo '<div class="ribbon-wrapper">';
                                                            echo '<div class="ribbon-text">' . count($related->variations) . ' options' . '</div>';
                                                        echo '</div>';
                                                    echo '</div>';

                                                } else {

                                                    echo '<div class="ribbon horizontal">';
                                                        echo count($related->variations) . ' options available';
                                                    echo '</div>';
                                                }
                                            }

                                        echo '</div>';

                                        echo '<p>' . anchor($related->url, $related->label) . '</p>';
                                        echo '<p>';
                                            echo '<span class="badge">' . $related->price->user_formatted->price_string . '</span>';
                                        echo '</p>';

                                    echo '</div>';

                                echo '</div>';
                            }

                        echo '</div>';

                    echo '</div>';

                echo '</div>';
            }

            // --------------------------------------------------------------------------

            /**
             * @todo Markup here because I think it looks OK and can be used when product
             * reviews get implemented (if they get implemented)
             */
            if (!empty($productReviews)) {

                //  Reviews
                echo '<div class="product-reviews">';

                    echo '<hr />';
                    echo '<h4>Customer Reviews</h4>';

                    foreach ($product_reviews as $review) {

                        echo '<div class="well">';
                            echo '<div class="row">';
                                echo '<div class="col-xs-2">';

                                    if ($review->user->profile_img) {

                                        $url = cdn_thumb($review->user->profile_img, 250, 250);

                                    } else {

                                        $url = cdn_blank_avatar(250, 250, $review->user->gender);
                                    }

                                    echo img(
                                        array(
                                            'src' => $url,
                                            'class="img-responsive img-thumbnail img-circle"'
                                        )
                                    );

                                echo '</div>';
                                echo '<div class="col-xs-10">';
                                    echo '<h5>' . $review->user->first_name . ' ' . $review->user->last_name . '</h5>';
                                    echo '<p>';

                                        foreach ($reviw->stars as $star) {

                                            if ($star->is_half) {

                                                echo '<span class="glyphicon glyphicon-star-empty"></span>';

                                            } else {

                                                echo '<span class="glyphicon glyphicon-star></span>';
                                            }
                                        }

                                    echo '</p>';
                                    echo '<hr />';
                                    echo auto_typography($review->body);
                                    echo '<p>';
                                        echo '<small>';
                                            echo '<em>' . toUserDatetime($review->created) . '</em>';
                                        echo '</small>';
                                    echo '</p>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    }
                echo '</div>';
            }
        echo '</div>';

        //  Featured Image & Gallery
        echo '<div class="col-md-4 col-md-pull-8">';

            $this->load->view($skin->path . 'views/front/_components/product_single_gallery_desktop');

            // --------------------------------------------------------------------------

            //  Tags
            if (!empty($product->tags)) {

                echo '<hr />';
                echo '<h4>Tags</h4>';
                echo '<ul class="list-inline">';

                foreach ($product->tags as $tag) {

                    echo '<li>';
                        $url   = $this->shop_tag_model->format_url($tag->slug);
                        $label = '<span class="badge">' . $tag->label . '</span>';
                        echo anchor($url, $label);
                    echo '</li>';
                }

                echo '</ul>';
            }

            // --------------------------------------------------------------------------

            //  Categories
            if (!empty($product->categories)) {

                echo '<hr />';
                echo '<h4>Categories</h4>';
                echo '<ul class="list-unstyled">';

                foreach ($product->categories as $category) {

                    echo '<li>';
                        echo anchor($this->shop_category_model->format_url($category->slug), $category->label);
                    echo '</li>';
                }

                echo '</ul>';
            }

            // --------------------------------------------------------------------------

            //  Brands
            if (!empty($product->brands)) {

                echo '<hr />';
                echo '<h4>Brands</h4>';
                echo '<ul class="list-unstyled">';

                foreach ($product->brands as $brand) {

                    echo '<li>';
                        echo anchor($this->shop_brand_model->format_url($brand->slug), $brand->label);
                    echo '</li>';
                }

                echo '</ul>';
            }

            // --------------------------------------------------------------------------

            //  Ranges
            if (!empty($product->collections)) {

                echo '<hr />';
                echo '<h4>Collections</h4>';
                echo '<ul class="list-unstyled">';

                foreach ($product->collections as $collection) {

                    echo '<li>';
                        echo anchor($this->shop_collection_model->format_url($collection->slug), $collection->label);
                    echo '</li>';
                }

                echo '</ul>';
            }

            // --------------------------------------------------------------------------

            //  Ranges
            if (!empty($product->ranges)) {

                echo '<hr />';
                echo '<h4>Ranges</h4>';
                echo '<ul class="list-unstyled">';

                foreach ($product->ranges as $range) {

                    echo '<li>';
                        echo anchor($this->shop_range_model->format_url($range->slug), $range->label);
                    echo '</li>';
                }

                echo '</ul>';
            }

        echo '</div>';

    echo '</div>';

?>
</div>