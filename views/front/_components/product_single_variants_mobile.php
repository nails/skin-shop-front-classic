<div class="hidden-md hidden-lg">
    <div class="product-options">
    <?php

    if ($product->is_external) {

        ?>
        <div class="row">
            <div class="col-xs-12">
                <a href="<?=$product->external_vendor_url?>" class="btn btn-xs btn-primary btn-block btn-basket" target="_blank">
                    Go to Seller <b class="glyphicon glyphicon-new-window"></b>
                </a>
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

                        //  @todo: price inc/ex tax
                        //  @todo: respect omit_variant_tax_pricing setting
                        //  @todo: change primary image on variation change
                        //  @todo: gracefully handle a single variation

                        switch ($variant->stock_status) {

                                case 'IN_STOCK':

                                    ?>
                                    <option value="<?=$variant->id?>" data-quantity="<?=$range?>">
                                        <?=$variant->label?> - <?=$variant->price->price->user_formatted->value?>
                                    </option>
                                    <?php
                                    break;

                                case 'TO_ORDER':
                                    //  @todo
                                    break;

                                case 'OUT_OF_STOCK':

                                    ?>
                                    <option value="<?=$variant->id?>" data-quantity="<?=$range?>" disabled="disabled">
                                        <?=$variant->label?> - Out of Stock!
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
        <input type="submit" name="submit" value="Add to Basket" id="add-basket-submit" class="btn btn-primary btn-basket btn-block disabled">
        </form>
        <?php

    }

    ?>
    </div>
</div>