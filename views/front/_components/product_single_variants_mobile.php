<div class="hidden-md hidden-lg">
    <div class="product-options">
        <div class="row">
            <div class="col-xs-8">
                <label class="block-label">Option</label>
            </div>
            <div class="col-xs-4 text-center">
                <label class="block-label">Quantity</label>
            </div>
        </div>
        <?php foreach ($product->variations as $variant) { ?>
            <?php if ($product->is_external) { ?>
                <div class="row product-row">
                    <div class="col-xs-8">
                        <?php echo $variant->label ?>
                        <?php echo $variant->price->price->user_formatted->value ?>
                    </div>
                    <div class="col-xs-4 text-center">1</div>
                </div>
                <?php echo anchor(
                           $product->external_vendor_url,
                            'Go to Seller <b class="glyphicon glyphicon-new-window"></b>',
                            'class="btn btn-xs btn-primary btn-block btn-basket" target="_blank" ');
                }
            else {

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
                } ?>

                <div class="row product-row">
                    <?php switch ($variant->stock_status) {
                        case 'IN_STOCK': ?>
                            <div class="col-xs-8">
                                <select name="" id="">
                                    <?php foreach ($product->variations as $variant) { ?>
                                        <option value="small"><?php echo $variant->label . " - " . $variant->price->price->user_formatted->value; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-xs-4 text-center">
                                <?php if (!$this->shop_basket_model->isInBasket($variant->id)) {

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
                                    } ?>
                            </div>
                        <?php break;
                        case 'OUT_OF_STOCK': ?>
                            <div class="col-xs-8">
                                <strike>
                                    <?php foreach ($product->variations as $variant) { ?>
                                        <?php echo $variant->label . " - " . $variant->price->price->user_formatted->value; ?>
                                    <?php } ?>
                                </strike>
                            </div>
                            <div class="col-xs-4">
                                <em><span itemprop="availability">Out of Stock</span></em>
                            </div>
                        <?php break;
                        echo anchor($shop_url . 'notify/' . $variant->id, 'Notify Me', 'class="btn btn-default fancybox" data-width="750" data-height="350" data-fancybox-type="iframe"');
                    } ?>
                </div>


            <?php } ?>
        <?php } ?>
        <?php if (!$product->is_external) { ?>
            <input type="submit" name="submit" value="Add to Basket" class="btn btn-primary btn-basket btn-block">
        <?php } ?>
    </div>
</div>