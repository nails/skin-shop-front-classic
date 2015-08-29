<?php
    //  Variants
    echo '<div class="well well-sm hidden-sm hidden-xs">';

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
                                echo anchor(
                                    $product->external_vendor_url,
                                    'Go to Seller <b class="glyphicon glyphicon-new-window"></b>',
                                    'class="btn btn-xs btn-primary pull-right shop-bs-popover" target="_blank" data-toggle="popover" title="This item is sold by ' . $product->external_vendor_label . '" data-content="This link will take you to the seller\'s website in a new window. You can come back at anytime."');
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

                                            echo '&nbsp;&nbsp;<b class="glyphicon glyphicon-map-marker" title="Collection Only"></b>';
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