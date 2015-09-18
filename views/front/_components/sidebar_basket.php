<?php

if (!app_setting('hide_sidebar_basket_btn', 'shop-' . $skin->slug)) {

    $basketCount = getBasketCount();

    if ($basketCount) {

        $this->load->helper('inflector');
        $basket    = getBasket();
        $returnUrl = uri_string();

        if ($this->input->server('QUERY_STRING')) {

            $returnUrl .= '?' . $this->input->server('QUERY_STRING');
        }

        ?>
        <div class="panel panel-default sidebar-basket small">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="glyphicon glyphicon-shopping-cart"></i>
                    <?php

                        if ($basketCount > 1) {

                            echo $basketCount . ' items in basket';

                        } else {

                            echo '1 item in basket';
                        }

                    ?>
                    <span class="pull-right clickable">
                        <i class="glyphicon glyphicon-chevron-up"></i>
                    </span>
                </h3>
            </div>
            <div class="panel-body">
                <ul class="list-unstyled">
                    <?php

                        foreach ($basket->items AS $item) {

                            if ($item->variant->featured_img) {

                                $imgUrl = cdnCrop($item->variant->featured_img, 50, 50);

                            } elseif ($item->product->featured_img) {

                                $imgUrl = cdnCrop($item->product->featured_img, 50, 50);

                            } else {

                                $imgUrl = '';
                            }

                            ?>
                            <li class="row product <?=$imgUrl ? 'has-img' : ''?>">
                            <?php

                                if ($item->variant->featured_img) {

                                    echo '<img src="' . $imgUrl . '" class="product-img img-thumbnail" />';

                                } elseif ($item->product->featured_img) {

                                    echo '<img src="' . $imgUrl . '" class="product-img img-thumbnail" />';

                                } else {

                                }

                                echo anchor($item->product->url, $item->product_label);

                                if ($item->product_label != $item->variant_label) {
                                    echo '<br /><small><em>' . $item->variant_label . '</em></small>';
                                }

                                echo '<span class="product-details small">';
                                    echo 'Quantity: <span class="pull-right">';
                                        echo anchor($shop_url . 'basket/decrement?variant_id=' . $item->variant->id . '&return=' . $returnUrl, '<b class="decrement glyphicon glyphicon-minus-sign"></b>');
                                        echo $item->quantity;
                                        echo anchor($shop_url . 'basket/increment?variant_id=' . $item->variant->id . '&return=' . $returnUrl, '<b class="increment glyphicon glyphicon-plus-sign"></b>');
                                    echo '</span>';
                                    echo '<br />Price: <span class="pull-right">' . $item->variant->price->price->user_formatted->value . '</span>';
                                    if ($item->variant->ship_collection_only) {
                                        echo '<br />This item is collect only';
                                    }
                                echo '</span>';

                            ?>
                            </li>
                            <?php

                        }

                    ?>
                    <li class="row totals">
                        <p>
                            Sub Total
                            <span class="pull-right">
                                <?=$basket->totals->user_formatted->item?>
                            </span>
                        </p>
                        <p>
                            Shipping
                            <span class="pull-right">
                            <?php

                                if ($basket->shipping->type === 'COLLECT') {

                                    echo 'Collection';

                                } else {

                                    if (empty($basket->totals->user->shipping)) {

                                        echo 'Free';

                                    } else {

                                        echo $basket->totals->user_formatted->shipping;
                                    }
                                }

                            ?>
                            </span>
                        </p>
                        <p>
                            Tax
                            <span class="pull-right">
                                <?=$basket->totals->user_formatted->tax?>
                            </span>
                        </p>
                        <p>
                            Total
                            <span class="pull-right">
                                <?=$basket->totals->user_formatted->grand?>
                            </span>
                        </p>
                    </li>
                    <li class="row basket-buttons">
                        <p>
                        <?php

                            echo anchor($shop_url . 'basket', 'View Basket', 'class="btn btn-sm btn-block btn-default"');
                            echo anchor($shop_url . 'checkout', 'Checkout', 'class="btn btn-block btn-primary"');

                        ?>
                        </p>
                    </li>
                </ul>
            </div>
        </div>
        <?php

    }
}
