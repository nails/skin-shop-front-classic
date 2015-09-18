<div class="hidden-md hidden-lg">
    <div class="product-options">
    <?php

    if ($product->is_external) {

        ?>
        <div class="row">
            <div class="col-xs-12">
            <?php

            anchor(
                $product->external_vendor_url,
                'Go to Seller <b class="glyphicon glyphicon-new-window"></b>',
                'class="btn btn-xs btn-primary btn-block btn-basket-lg" target="_blank"'
            );

            ?>
            </div>
        </div>
        <?php

    } else {

        ?>
        <div class="row">
            <div class="col-xs-8">
                <label class="block-label">Option</label>
            </div>
            <div class="col-xs-4">
                <label class="block-label">Quantity</label>
            </div>
        </div>
        <?=form_open($shop_url . 'basket/add', 'method="GET"')?>
        <?=form_hidden('return', $product->url)?>
        <div class="row">
            <div class="col-xs-8">
                <select id="add-basket-variant-id" class="form-control" name="variant_id">
                    <?php

                    $appSettingExTax = app_setting('price_exclude_tax', 'shop');
                    $appSettingOmitTax = app_setting('omit_variant_tax_pricing', 'shop-' . $skin->slug);

                    foreach ($product->variations as $variant) {

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

                        $range = count($range);
                        $variantPrice = $variant->price->price;
                        $priceTaxIncDiffer = $variantPrice->user->value != $variantPrice->user->value_inc_tax;
                        $priceTaxExDiffer = $variantPrice->user->value != $variantPrice->user->value_ex_tax;

                        switch ($variant->stock_status) {

                            case 'IN_STOCK':

                                if (!empty($variant->gallery)) {

                                    echo '<option value="' . $variant->id . '" ';
                                    echo 'data-quantity="' . $range . '" ';
                                    echo 'data-image="' . cdnCrop($variant->gallery[0], 800, 800) . '">';

                                } else {

                                    echo '<option value="' . $variant->id . '" data-quantity="' . $range . '">';
                                }

                                echo $variant->label . ' - ';

                                if ($appSettingExTax) {

                                    //  Product prices include taxes
                                    echo $variantPrice->user_formatted->value;

                                    if (!$appSettingOmitTax && $priceTaxIncDiffer) {

                                        echo ' (Inc. Tax: ' . $variantPrice->user_formatted->value_inc_tax . ')';
                                    }

                                } else {

                                    echo $variantPrice->user_formatted->value;

                                    if (!$appSettingOmitTax && $priceTaxExDiffer) {

                                        echo ' (Ex. Tax: ' . $variantPrice->user_formatted->value_ex_tax . ')';
                                    }
                                }

                                ?>
                                </option>
                                <?php

                                break;

                            case 'TO_ORDER':

                                echo '<option value="' . $variant->id . '" ';
                                echo 'data-quantity="' . $range . '" ';
                                echo 'data-image="' . cdnCrop($variant->gallery[0], 800, 800) . '">';

                                echo $variant->label;

                                if ($appSettingExTax) {

                                    //  Product prices include taxes
                                    echo $variantPrice->user_formatted->value;

                                    if (!$appSettingOmitTax && $priceTaxIncDiffer) {

                                        echo ' (Inc. Tax: ' . $variantPrice->user_formatted->value_inc_tax . ')';
                                    }

                                } else {

                                    echo $variantPrice->user_formatted->value;

                                    if (!$appSettingOmitTax && $priceTaxExDiffer) {

                                        echo ' (Ex. Tax: ' . $variantPrice->user_formatted->value_ex_tax . ')';
                                    }
                                }

                                echo ' - Lead time: ' . $variant->lead_time;

                                echo '</option>';
                                break;

                            case 'OUT_OF_STOCK':

                                ?>
                                <option value="<?=$variant->id?>" data-quantity="<?=$range?>" disabled="disabled">
                                    <?=$variant->label?> - <?=$variant->price->price->user_formatted->value;?>
                                    - Out of Stock
                                </option>
                                <?php
                                break;
                        }

                        ?>
                        </div>
                        <?php

                    }

                    ?>
                </select>
            </div>
            <div class="col-xs-4">
                <select name="quantity" class="form-control" id="add-basket-variant-quantity" disabled="disabled">
                </select>
            </div>
        </div>
        <?php

        echo form_submit(
            'submit',
            'Add to Basket',
            'id="add-basket-submit" class="btn btn-primary btn-basket-lg btn-block disabled"'
        );

        echo form_close();
    }

    ?>
    </div>
</div>
