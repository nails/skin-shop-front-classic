<div class="well well-sm hidden-sm hidden-xs">
    <table class="table table-variants">
        <thead>
            <tr>
                <th class="col-xs-5">Item</th>
                <th class="col-xs-3">Price</th>
                <th class="col-xs-4">Quantity</th>
            </tr>
        </thead>
        <tbody>
        <?php

        foreach ($product->variations as $variant) {

            if (!empty($variant->gallery)) {

                $aAttr = array(
                    'class="variant has-img"',
                    'data-image="' . cdnCrop($variant->gallery[0], 800, 800) . '"',
                    'itemprop="offers"',
                    'itemscope itemtype="http://schema.org/Offer"'
                );

            } else {

                $aAttr = array(
                    'class="variant"',
                    'itemprop="offers"',
                    'itemscope itemtype="http://schema.org/Offer"'
                );
            }

            echo '<tr ' . implode(' ', $aAttr) . '>';

            if ($product->is_external) {

                ?>
                <td>
                    <p itemprop="itemOffered">
                        <?=$variant->label?>
                    </p>
                    <meta itemprop="sku" content="<?=$variant->sku?>" />
                    <?php

                    if (!empty($variant->gallery)) {
                        echo '<meta itemprop="image" content="' . cdnCrop($variant->gallery[0], 800, 800) . '" />';
                    }

                    ?>
                </td>
                <td>
                    <p itemprop="price">
                    <?php

                    if (app_setting('price_exclude_tax', 'shop')) {
                        echo $variant->price->price->user_formatted->value_ex_tax;
                    } else {
                        echo $variant->price->price->user_formatted->value_inc_tax;
                    }

                    ?>
                    </p>
                </td>
                <td>
                    <p>
                        <?php

                        $sBtnTxt = 'Go to Seller <b class="glyphicon glyphicon-new-window"></b>';
                        $aAttr = array(
                            'class="btn btn-xs btn-primary pull-right shop-bs-popover"',
                            'target="_blank"',
                            'data-toggle="popover"',
                            'title="This item is sold by ' . $product->external_vendor_label . '"',
                            'data-content="This link will take you to the seller\'s website in a new window. You can come back at anytime."'
                        );
                        echo anchor($product->external_vendor_url, $sBtnText, implode(' ', $aAttr));

                        ?>
                    </p>
                </td>
                <?php

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

                        ?>
                        <td>
                            <p>
                                <span itemprop="itemOffered">
                                    <?=$variant->label?>
                                </span>
                                <meta itemprop="sku" content="<?=$variant->sku?>" />
                                <?php

                                if (!empty($product->gallery)) {
                                    echo '<meta itemprop="image" content="' . cdnCrop($product->gallery[0], 800, 800) . '" />';
                                }

                                if ($variant->shipping->collection_only) {

                                    echo '&nbsp;&nbsp;<b class="glyphicon glyphicon-map-marker" title="Collection Only"></b>';
                                }

                                ?>
                            </p>
                        </td>
                        <td>
                            <?php

                            if (app_setting('price_exclude_tax', 'shop')) {

                                ?>
                                <p>
                                    <span itemprop="price">
                                    <?php

                                    if (app_setting('price_exclude_tax', 'shop')) {
                                        echo $variant->price->price->user_formatted->value_ex_tax;
                                    } else {
                                        echo $variant->price->price->user_formatted->value_inc_tax;
                                    }

                                    ?>
                                    </span>
                                </p>
                                <?php

                                if (!app_setting('omit_variant_tax_pricing', 'shop-' . $skin->slug)) {

                                    ?>
                                    <p class="text-muted">
                                        <small>
                                            <em>
                                                Inc. Tax: <?=$variant->price->price->user_formatted->value_inc_tax?>
                                            </em>
                                        </small>
                                    </p>
                                    <?php
                                }

                            } else {

                                ?>
                                <p>
                                    <span itemprop="price">
                                    <?php

                                    if (app_setting('price_exclude_tax', 'shop')) {
                                        echo $variant->price->price->user_formatted->value_ex_tax;
                                    } else {
                                        echo $variant->price->price->user_formatted->value_inc_tax;
                                    }

                                    ?>
                                    </span>
                                </p>
                                <?php

                                if (!app_setting('omit_variant_tax_pricing', 'shop-' . $skin->slug)) {

                                    ?>
                                    <p class="text-muted">
                                        <small>
                                            <em>
                                                Ex. Tax: <?=$variant->price->price->user_formatted->value_ex_tax?>
                                            </em>
                                        </small>
                                    </p>
                                    <?php
                                }
                            }

                            ?>
                        </td>
                        <td>
                            <?php

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

                            ?>
                        </td>
                        <?php

                        break;

                    case 'TO_ORDER':

                        ?>
                        <td>
                            <p>
                                <?=$variant->label?>
                            </p>
                            <meta itemprop="sku" content="<?=$variant->sku?>" />
                            <?php

                            if (!empty($product->gallery)) {
                                echo '<meta itemprop="image" content="' . cdnCrop($product->gallery[0], 800, 800) . '" />';
                            }

                            ?>
                            <p class="text-muted">
                                <small>
                                    <em>
                                        Lead time: <?=$variant->lead_time?>
                                    </em>
                                </small>
                            </p>
                        </td>
                        <td>
                            <?php

                            if (app_setting('price_exclude_tax', 'shop')) {

                                ?>
                                <p>
                                    <span itemprop="price">
                                    <?php

                                    if (app_setting('price_exclude_tax', 'shop')) {
                                        echo $variant->price->price->user_formatted->value_ex_tax;
                                    } else {
                                        echo $variant->price->price->user_formatted->value_inc_tax;
                                    }

                                    ?>
                                    </span>
                                </p>
                                <?php

                                if (!app_setting('omit_variant_tax_pricing', 'shop-' . $skin->slug)) {

                                    ?>
                                    <p class="text-muted">
                                        <small>
                                            <em>
                                                Inc. Tax: <?=$variant->price->price->user_formatted->value_inc_tax?>
                                            </em>
                                        </small>
                                    </p>
                                    <?php
                                }

                            } else {

                                ?>
                                <p>
                                    <span itemprop="price">
                                    <?php

                                    if (app_setting('price_exclude_tax', 'shop')) {
                                        echo $variant->price->price->user_formatted->value_ex_tax;
                                    } else {
                                        echo $variant->price->price->user_formatted->value_inc_tax;
                                    }

                                    ?>
                                    </span>
                                </p>
                                <?php

                                if (!app_setting('omit_variant_tax_pricing', 'shop-' . $skin->slug)) {

                                    ?>
                                    <p class="text-muted">
                                        <small>
                                            <em>
                                                Ex. Tax: <?=$variant->price->price->user_formatted->value_ex_tax?>
                                            </em>
                                        </small>
                                    </p>
                                    <?php
                                }
                            }

                            ?>
                        </td>
                        <td>
                            <?php

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

                            ?>

                        </td>
                        <?php

                        break;

                    case 'OUT_OF_STOCK':

                        ?>
                        <td>
                            <p>
                                <strike><?=$variant->label?></strike>
                            </p>
                            <meta itemprop="sku" content="<?=$variant->sku?>" />
                            <?php

                            if (!empty($product->gallery)) {
                                echo '<meta itemprop="image" content="' . cdnCrop($product->gallery[0], 800, 800) . '" />';
                            }

                            ?>
                        </td>
                        <td>
                            <p>
                                <strike>
                                    <span itemprop="price">
                                        <?php

                                        if (app_setting('price_exclude_tax', 'shop')) {
                                            echo $variant->price->price->user_formatted->value_ex_tax;
                                        } else {
                                            echo $variant->price->price->user_formatted->value_inc_tax;
                                        }

                                        ?>
                                    </span>
                                </strike>
                            </p>
                        </td>
                        <td>
                            <p>
                                <em>
                                    <span itemprop="availability">Out of Stock</span>
                                </em>
                                <?=anchor(
                                    $shop_url . 'notify/' . $variant->id,
                                    'Notify Me',
                                    'class="btn btn-xs btn-default pull-right fancybox" data-width="750" data-height="350" data-fancybox-type="iframe"'
                                )?>
                            </p>
                        </td>
                        <?php

                        break;
                }
            }
            echo '</tr>';
        }

        ?>
        </tbody>
    </table>
</div>