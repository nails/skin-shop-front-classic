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

        //  Featured Image & Gallery
        echo '<div class="col-md-4">';

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
            echo '<div class="hidden-md hidden-lg clearfix">';

                echo '<div class="row featured-image-xs-sm">';

                    if ($gallery) {

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

                    if ($gallery) {

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

            //  Medium and Large breakpoints
            echo '<div class="hidden-sm hidden-xs clearfix">';

                echo '<div class="text-center featured-image-md-lg">';

                    if (!empty($featuredImg['url'])) {

                        echo '<a href="' . $featuredImg['url'] . '" class="featured-img-link" target="_blank">';
                    }

                    echo img(array('src' => $featuredImg['thumb'], 'class' => 'img-responsive img-thumbnail featured-img-img'));

                    if (!empty($featuredImg['url'])) {

                        echo '</a>';
                    }

                echo '</div>';

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

            echo '</div>';

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

        // --------------------------------------------------------------------------

        //  Right hand column
        echo '<div class="col-md-8">';

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
                            echo 'Items marked with <b class="glyphicon glyphicon-map-marker"></b> are only available for collection.';
                            if (app_setting('warehouse_collection_delivery_enquiry', 'shop')) {

                                echo anchor($shop_url . 'enquire/delivery/' . $product->id, 'Delivery Enquiry', 'class="btn btn-primary btn-sm pull-right fancybox" data-width="750" data-height="575" data-fancybox-type="iframe"');
                            }
                        echo '</p>';
                        break;
                    }
                }
            }

            // --------------------------------------------------------------------------

            //  Variants
            echo '<div class="well well-sm">';

                echo '<table class="table table-variants">';
                    echo '<thead>';
                        echo '<tr>';
                            echo '<th class="col-xs-5">Item</th>';
                            echo '<th class="col-xs-3">Price</th>';
                            echo '<th class="col-xs-4">Quantity</th>';
                        echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    foreach ($product->variations as $variant) {

                        if (!empty($variant->gallery)) {

                            echo '<tr class="variant has-img" data-image="' . cdn_thumb($variant->gallery[0], 800, 800) . '" itemprop="offers" itemscope itemtype="http://schema.org/Offer">';

                        } else {

                            echo '<tr class="variant" itemprop="offers" itemscope itemtype="http://schema.org/Offer">';
                        }

                            if ($product->is_external) {

                                echo '<td>';
                                    echo '<p itemprop="itemOffered">' . $variant->label . '</p>';
                                    echo '<meta itemprop="sku" content="' . $variant->sku . '" />';
                                    if (!empty($variant->gallery)) {
                                        echo '<meta itemprop="image" content="' . cdn_thumb($variant->gallery[0], 800, 800) . '" />';
                                    }
                                echo '</td>';
                                echo '<td>';
                                    echo '<p itemprop="price">' . $variant->price->price->user_formatted->value . '</p>';
                                echo '</td>';
                                echo '<td>';
                                    echo '<p>';
                                        echo anchor($product->external_vendor_url, 'Go to Seller <b class="fa fa-external-link"></b>', 'class="btn btn-xs btn-primary pull-right shop-bs-popover" target="_blank" data-toggle="popover" title="This item is sold by ' . $product->external_vendor_label . '" data-content="This link will take you to the seller\'s website in a new window. You can come back at anytime."');
                                    echo '</p>';
                                echo '</td>';

                            } else {

                                //  Calculate quantity ranges
                                $maxPerOrder = $product->type->max_per_order;
                                $available   = $variant->quantity_available;

                                //  Number of items to show if the quantity is "unlimited"
                                $unlimited = 10;

                                if (is_null($available) && empty($maxPerOrder)) {

                                    //  Unlimited quantity available, with no maximum per order
                                    $range = array_combine(range(1, $unlimited), range(1, $unlimited));

                                } elseif (is_null($available) && !empty($maxPerOrder)) {

                                    //  Unlimited quantity available, with maximum per order
                                    $range = array_combine(range(1, $maxPerOrder), range(1, $maxPerOrder));

                                } elseif (is_numeric($available) && !empty($maxPerOrder)) {

                                    //  Limited quantity available, with maximum per order
                                    if ($available >= $maxPerOrder) {

                                        //  There are more available than the maximum per order
                                        $range = array_combine(range(1, $maxPerOrder), range(1, $maxPerOrder));

                                    } else {

                                        //  There are fewer available than the maximum per order
                                        $range = array_combine(range(1, $available), range(1, $available));
                                    }

                                } elseif (is_numeric($available) && empty($maxPerOrder)) {

                                    //  Limited quantity available, with no maximum per order
                                    $range = array_combine(range(1, $available), range(1, $available));

                                } else {

                                    //  Shouldn't happen.
                                    $range = array(0);
                                }

                                switch ($variant->stock_status) {

                                    case 'IN_STOCK':

                                        echo '<td>';
                                            echo '<p>';

                                                echo '<span itemprop="itemOffered">' . $variant->label . '</span>';
                                                echo '<meta itemprop="sku" content="' . $variant->sku . '" />';
                                                if (!empty($product->gallery)) {
                                                    echo '<meta itemprop="image" content="' . cdn_thumb($product->gallery[0], 800, 800) . '" />';
                                                }

                                                if ($variant->shipping->collection_only) {

                                                    echo '&nbsp;&nbsp;<b class="glyphicon glyphicon-map-marker"></b>';
                                                }

                                            echo '</p>';
                                        echo '</td>';
                                        echo '<td>';

                                            if (app_setting('price_exclude_tax', 'shop')) {

                                                //  Product prices include taxes
                                                echo '<p>';
                                                    echo '<span itemprop="price">' . $variant->price->price->user_formatted->value . '</span>';
                                                echo '</p>';

                                                if (!app_setting('omit_variant_tax_pricing', 'shop-' . $skin->slug) && $variant->price->price->user->value != $variant->price->price->user->value_inc_tax) {

                                                    echo '<p class="text-muted">';
                                                        echo '<small>';
                                                            echo '<em>Inc. Tax: ' . $variant->price->price->user_formatted->value_inc_tax . '</em>';
                                                        echo '</small>';
                                                    echo '</p>';
                                                }

                                            } else {

                                                echo '<p>';
                                                    echo '<span itemprop="price">' . $variant->price->price->user_formatted->value . '</span>';
                                                echo '</p>';

                                                if (!app_setting('omit_variant_tax_pricing', 'shop-' . $skin->slug) && $variant->price->price->user->value != $variant->price->price->user->value_ex_tax) {

                                                    echo '<p class="text-muted">';
                                                        echo '<small>';
                                                            echo '<em>Ex. Tax: ' . $variant->price->price->user_formatted->value_ex_tax . '</em>';
                                                        echo '</small>';
                                                    echo '</p>';
                                                }
                                            }

                                        echo '</td>';
                                        echo '<td>';

                                            if (!$this->shop_basket_model->isInBasket($variant->id)) {

                                                echo form_open($shop_url . 'basket/add', 'method="GET"');
                                                    echo form_hidden('return', $product->url);
                                                    echo form_hidden('variant_id', $variant->id);
                                                    echo form_dropdown('quantity', $range);
                                                    echo form_submit('submit', 'Add to Basket', 'class="btn btn-xs btn-primary pull-right"');
                                                echo form_close();

                                            } else {

                                                echo form_open($shop_url . 'basket/remove', 'method="GET"');
                                                    echo form_hidden('return', $product->url);
                                                    echo form_hidden('variant_id', $variant->id);
                                                    echo $this->shop_basket_model->getVariantQuantity($variant->id);
                                                    echo anchor($shop_url . 'basket', 'View Basket', 'class="btn btn-xs btn-success pull-right btn-basket"');
                                                    echo form_submit('submit', 'Remove', 'class="btn btn-xs btn-danger pull-right btn-remove"');
                                                echo form_close();
                                            }

                                        echo '</td>';
                                        break;

                                    case 'TO_ORDER':

                                        echo '<td>';
                                            echo '<p>' . $variant->label . '</p>';
                                            echo '<meta itemprop="sku" content="' . $variant->sku . '" />';
                                            if (!empty($product->gallery)) {
                                                echo '<meta itemprop="image" content="' . cdn_thumb($product->gallery[0], 800, 800) . '" />';
                                            }
                                            echo '<p class="text-muted">';
                                                echo '<small>';
                                                    echo '<em>Lead time: ' . $variant->lead_time . '</em>';
                                                echo '</small>';
                                            echo '</p>';
                                        echo '</td>';
                                        echo '<td>';

                                            if (app_setting('price_exclude_tax', 'shop')) {

                                                //  Product prices include taxes
                                                echo '<p>';
                                                    echo '<span itemprop="price">' . $variant->price->price->user_formatted->value . '</span>';
                                                echo '</p>';

                                                if (!app_setting('omit_variant_tax_pricing', 'shop-' . $skin->slug) && $variant->price->price->user->value != $variant->price->price->user->value_inc_tax) {

                                                    echo '<p class="text-muted">';
                                                        echo '<small>';
                                                            echo '<em>Inc. Tax: ' . $variant->price->price->user_formatted->value_inc_tax . '</em>';
                                                        echo '</small>';
                                                    echo '</p>';
                                                }

                                            } else {

                                                echo '<p>';
                                                    echo '<span itemprop="price">' . $variant->price->price->user_formatted->value . '</span>';
                                                echo '</p>';

                                                if (!app_setting('omit_variant_tax_pricing', 'shop-' . $skin->slug) && $variant->price->price->user->value != $variant->price->price->user->value_ex_tax) {

                                                    echo '<p class="text-muted">';
                                                        echo '<small>';
                                                            echo '<em>Ex. Tax: ' . $variant->price->price->user_formatted->value_ex_tax . '</em>';
                                                        echo '</small>';
                                                    echo '</p>';
                                                }
                                            }

                                        echo '</td>';
                                        echo '<td>';

                                            if (!$this->shop_basket_model->isInBasket($variant->id)) {

                                                echo form_open($shop_url . 'basket/add', 'method="GET"');
                                                    echo form_hidden('return', $product->url);
                                                    echo form_hidden('variant_id', $variant->id);
                                                    echo form_dropdown('quantity', $range);
                                                    echo form_submit('submit', 'Add to Basket', 'class="btn btn-xs btn-primary pull-right"');
                                                echo form_close();

                                            } else {

                                                echo form_open($shop_url . 'basket/remove', 'method="GET"');
                                                    echo form_hidden('return', $product->url);
                                                    echo form_hidden('variant_id', $variant->id);
                                                    echo $this->shop_basket_model->getVariantQuantity($variant->id);
                                                    echo anchor($shop_url . 'basket', 'View Basket', 'class="btn btn-xs btn-success pull-right btn-basket"');
                                                    echo form_submit('submit', 'Remove', 'class="btn btn-xs btn-danger pull-right btn-remove"');
                                                echo form_close();
                                            }

                                        echo '</td>';
                                        break;

                                    case 'OUT_OF_STOCK':

                                        echo '<td>';
                                            echo '<p><strike>' . $variant->label . '</strike></p>';
                                            echo '<meta itemprop="sku" content="' . $variant->sku . '" />';
                                            if (!empty($product->gallery)) {
                                                echo '<meta itemprop="image" content="' . cdn_thumb($product->gallery[0], 800, 800) . '" />';
                                            }
                                        echo '</td>';
                                        echo '<td>';
                                            echo '<p><strike><span itemprop="price">' . $variant->price->price->user_formatted->value . '</span></strike></p>';
                                        echo '</td>';
                                        echo '<td>';
                                            echo '<p>';
                                                echo '<em><span itemprop="availability">Out of Stock</span></em>';
                                                echo anchor($shop_url . 'notify/' . $variant->id, 'Notify Me', 'class="btn btn-xs btn-default pull-right fancybox" data-width="750" data-height="350" data-fancybox-type="iframe"');
                                            echo '</p>';
                                        echo '</td>';
                                        break;
                                }

                            }

                        echo '</tr>';

                    }

                    echo '</tbody>';
                echo '</table>';

            echo '</div>';

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

            /**
             * TODO Markup here because I think it looks OK and can be used when product
             * reviews get implemented (if they get implemented)
             */
            if (!empty($product_reviews)) {

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

                                                echo '<span class="fa fa-star-half"></span>';

                                            } else {

                                                echo '<span class="fa fa-star></span>';
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

    echo '</div>';

?>
</div>