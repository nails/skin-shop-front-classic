<div class="product-inner">
    <?php

    if ($product->featured_img) {

        $url = cdnCrop($product->featured_img, 360, 360);

    } else {

        $url = $skin->url . 'assets/img/product-no-image.png';
    }

    ?>
    <div class="product-image">
        <?php

        echo anchor(
            $product->url,
            img(
                array(
                    'src' => $url,
                    'class' => 'img-responsive img-thumbnail center-block',
                    'width' => 360,
                    'height' => 360
                )
            )
        );

        if (count($product->variations) > 1) {

            if (appSetting('browse_product_ribbon_mode', 'shop-' . $skin->name) == 'corner') {

                ?>
                <div class="ribbon corner">
                    <div class="ribbon-wrapper">
                        <div class="ribbon-text">
                            <?=count($product->variations)?> options
                        </div>
                    </div>
                </div>
                <?php

            } else {

                ?>
                <div class="ribbon horizontal">
                    <?=count($product->variations)?> options available
                </div>
                <?php
            }
        }

        ?>
    </div>
    <p>
        <?=anchor($product->url, $product->label)?>
    </p>
    <p>
        <span class="badge">
            <?php

            if (appSetting('price_exclude_tax', 'shop')) {

                echo $product->price->user_formatted->price_string_ex_tax;

            } else {

                echo $product->price->user_formatted->price_string_inc_tax;
            }

            ?>
        </span>
    </p>
</div>