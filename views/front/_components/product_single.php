<div class="product col-xs-12" itemscope itemtype="http://schema.org/Product">
    <meta itemprop="url" content="<?=$product->url?>">
    <div itemprop="seller" itemscope itemtype="http://schema.org/Organisation">
        <meta itemprop="name" content="<?=lang('site_title')?>">
        <meta itemprop="address" content="<?=appSetting('invoice_address', 'nailsapp/module-shop')?>">
        <meta itemprop="vatID" content="<?=appSetting('invoice_vat_no', 'nailsapp/module-shop')?>">
    </div>
    <div class="product-label">
        <h1 class="text-center hidden-md hidden-lg">
            <span itemprop="name">
                <?=$product->label?>
            </span>
        </h1>
        <h1 class="hidden-xs hidden-sm">
            <?=$product->label?>
        </h1>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-8 col-md-push-4">
            <?php

            //  Gallery
            $this->load->view($skin->path . 'views/front/_components/product_single_gallery_mobile');

            //  Variants (mobile)
            $this->load->view($skin->path . 'views/front/_components/product_single_variants_mobile');

            //  Description
            ?>
            <div class="product-description">
                <span itemprop="description">
                    <?=$product->description?>
                </span>
            </div>
            <?php

            //  Social Likes

            //  Defaults
            $layout      = '';
            $singleTitle = shopSkinSetting('social_layout_single_text', 'front') ? shopSkinSetting('social_layout_single_text', 'front') : 'Share';
            $counters    = shopSkinSetting('social_counters', 'front') ? 'data-zeroes="yes"' : 'data-counters="no"';
            $twitterVia  = shopSkinSetting('social_twitter_via', 'front') ? shopSkinSetting('social_twitter_via', 'front') : '';

            //  Layout
            switch (shopSkinSetting('social_layout', 'front')) {

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

            $enabled = array();
            if (shopSkinSetting('social_facebook_enabled', 'front')) {
                $enabled[] =  '<div class="facebook" title="Share link on Facebook">Facebook</div>';
            }
            if (shopSkinSetting('social_twitter_enabled', 'front')) {
                $enabled[] =  '<div class="twitter" data-via="' . $twitterVia . '" title="Share link on Twitter">Twitter</div>';
            }
            if (shopSkinSetting('social_googleplus_enabled', 'front')) {
                $enabled[] = '<div class="plusone" title="Share link on Google+">Google+</div>';
            }
            if (shopSkinSetting('social_pinterest_enabled', 'front') && $product->featured_img) {
                $enabled[] = '<div class="pinterest" data-media="' . cdnServe($product->featured_img) . '" title="Share image on Pinterest">Pinterest</div>';
            }

            $enabled = array_filter($enabled);

            $aAttr = array(
                'class="product-social social-likes ' . $layout . '"',
                $counters,
                'data-url="' . $product->url . '"',
                'data-single-title="' . $singleTitle . '"',
                'data-title="' . $product->label . '"'
            );

            if ($enabled) {
                echo '<div ' . implode(' ', $aAttr) . '>';
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

                        ?>
                        <p class="alert alert-warning">
                            Items marked with <b class="glyphicon glyphicon-map-marker" title="Collection Only"></b>
                            are only available for collection.
                            <?php

                            if (appSetting('warehouse_collection_delivery_enquiry', 'nailsapp/module-shop')) {

                                echo anchor(
                                    $shop_url . 'enquire/delivery/' . $product->id,
                                    'Delivery Enquiry',
                                    'class="btn btn-primary btn-sm pull-right fancybox" data-width="750" data-height="575" data-fancybox-type="iframe"'
                                );
                            }
                            ?>
                        </p>
                        <?php

                        break;
                    }
                }
            }

            // --------------------------------------------------------------------------

            //  Variants (Desktop)
            $this->load->view($skin->path . 'views/front/_components/product_single_variants_desktop');

            // --------------------------------------------------------------------------

            //  Attributes
            if (!empty($product->attributes)) {

                ?>
                <table class="table table-bordered table-striped product-attributes">
                    <thead>
                        <tr>
                            <th>Attribute</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($product->attributes as $attribute) {

                            ?>
                            <tr>
                                <td><?=$attribute->label?></td>
                                <td><?=$attribute->value?></td>
                            </tr>
                            <?php
                        }

                        ?>
                    </tbody>
                </table>
                <?php
            }

            // --------------------------------------------------------------------------

            //  Related Products
            if (!empty($relatedProducts)) {

                ?>
                <div class="related-products">
                    <hr />
                    <h4>Related Products</h4>
                    <div class="product-browser">
                        <div class="row">
                            <?php

                            foreach ($relatedProducts as $related) {

                                ?>
                                <div class="product col-xs-6 col-md-3">
                                    <div class="product-inner">
                                        <?php

                                        if ($related->featured_img) {

                                            $url = cdnCrop($related->featured_img, 360, 360);

                                        } else {

                                            $url = $skin->url . 'assets/img/product-no-image.png';
                                        }

                                        ?>
                                        <div class="product-image">
                                            <?php

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

                                                if (shopSkinSetting('browse_product_ribbon_mode', 'front') == 'corner') {

                                                    ?>
                                                    <div class="ribbon corner">
                                                        <div class="ribbon-wrapper">
                                                            <div class="ribbon-text">
                                                                <?=count($related->variations)?> options
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php

                                                } else {

                                                    ?>
                                                    <div class="ribbon horizontal">
                                                        <?=count($related->variations)?> options available
                                                    </div>
                                                    <?php
                                                }
                                            }

                                            ?>
                                        </div>
                                        <p>
                                            <?=anchor($related->url, $related->label)?>
                                        </p>
                                        <p>
                                            <span class="badge">
                                                <?php

                                                if (appSetting('price_exclude_tax', 'nailsapp/module-shop')) {

                                                    echo $related->price->user_formatted->price_string_ex_tax;

                                                } else {

                                                    echo $related->price->user_formatted->price_string_inc_tax;
                                                }

                                                ?>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <?php
                            }

                            ?>
                        </div>
                    </div>
                </div>
                <?php
            }

            // --------------------------------------------------------------------------

            /**
             * @todo Markup here because I think it looks OK and can be used when product
             * reviews get implemented (if they get implemented)
             */
            if (!empty($productReviews)) {

                ?>
                <div class="product-reviews">
                    <hr />
                    <h4>Customer Reviews</h4>
                    <?php

                    foreach ($product_reviews as $review) {

                        ?>
                        <div class="well">
                            <div class="row">
                                <div class="col-xs-2">
                                    <?php

                                    if ($review->user->profile_img) {

                                        $url = cdnCrop($review->user->profile_img, 250, 250);

                                    } else {

                                        $url = cdnBlankAvatar(250, 250, $review->user->gender);
                                    }

                                    echo img(
                                        array(
                                            'src' => $url,
                                            'class="img-responsive img-thumbnail img-circle"'
                                        )
                                    );

                                    ?>
                                </div>
                                <div class="col-xs-10">
                                    <h5>
                                        <?=$review->user->first_name . ' ' . $review->user->last_name?>
                                    </h5>
                                    <p>
                                        <?php

                                        foreach ($reviw->stars as $star) {

                                            if ($star->is_half) {

                                                echo '<span class="glyphicon glyphicon-star-empty"></span>';

                                            } else {

                                                echo '<span class="glyphicon glyphicon-star></span>';
                                            }
                                        }

                                        ?>
                                    </p>
                                    <hr />
                                    <?=auto_typography($review->body)?>
                                    <p>
                                        <small>
                                            <em>
                                                <?=toUserDatetime($review->created)?>
                                            </em>
                                        </small>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php

                    }

                    ?>
                </div>
                <?php
            }

            ?>
        </div>
        <div class="col-md-4 col-md-pull-8">
            <?php

            $this->load->view($skin->path . 'views/front/_components/product_single_gallery_desktop');

            //  Tags
            if (!empty($product->tags)) {

                ?>

                <hr />
                <h4>Tags</h4>
                <ul class="list-inline">
                    <?php

                    foreach ($product->tags as $tag) {

                        ?>
                        <li>
                            <?php

                            $url   = $this->shop_tag_model->formatUrl($tag->slug);
                            $label = '<span class="badge">' . $tag->label . '</span>';
                            echo anchor($url, $label);

                            ?>
                        </li>
                        <?php
                    }

                    ?>
                </ul>
                <?php

            }

            // --------------------------------------------------------------------------

            //  Categories
            if (!empty($product->categories)) {

                ?>
                <hr />
                <h4>Categories</h4>
                <ul class="list-unstyled">
                    <?php

                    foreach ($product->categories as $category) {

                        ?>
                        <li>
                            <?=anchor($this->shop_category_model->formatUrl($category->slug), $category->label)?>
                        </li>
                        <?php
                    }

                    ?>
                </ul>
                <?php
            }

            // --------------------------------------------------------------------------

            //  Brands
            if (!empty($product->brands)) {

                ?>
                <hr />
                <h4>Brands</h4>
                <ul class="list-unstyled">
                    <?php

                    foreach ($product->brands as $brand) {

                        ?>
                        <li>
                            <?=anchor($this->shop_brand_model->formatUrl($brand->slug), $brand->label)?>
                        </li>
                        <?php
                    }

                    ?>
                </ul>
                <?php
            }

            // --------------------------------------------------------------------------

            //  Ranges
            if (!empty($product->collections)) {

                ?>
                <hr />
                <h4>Collections</h4>
                <ul class="list-unstyled">
                    <?php

                    foreach ($product->collections as $collection) {

                        ?>
                        <li>
                            <?=anchor($this->shop_collection_model->formatUrl($collection->slug), $collection->label)?>
                        </li>
                        <?php
                    }

                    ?>
                </ul>
                <?php
            }

            // --------------------------------------------------------------------------

            //  Ranges
            if (!empty($product->ranges)) {

                ?>
                <hr />
                <h4>Ranges</h4>
                <ul class="list-unstyled">
                    <?php

                    foreach ($product->ranges as $range) {

                        ?>
                        <li>
                            <?=anchor($this->shop_range_model->formatUrl($range->slug), $range->label)?>
                        </li>
                        <?php
                    }

                    ?>
                </ul>
                <?php
            }

            ?>
        </div>
    </div>
</div>
