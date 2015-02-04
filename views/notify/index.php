<?php

    if ($this->input->get('isFancybox')) {

        echo '<style type="text/css">';
            echo 'body,html { background:transparent; }';
        echo '</style>';
        echo '<div class="container">';
    }

    ?>
    <div class="row">
        <div class="col-xs-3">
        <?php

            if ($variant->featured_img) {

                $_url = cdn_thumb($variant->featured_img, 800, 800);

            } elseif ($product->featured_img) {

                $_url = cdn_thumb($product->featured_img, 800, 800);

            } else {

                $_url = $skin->url . 'assets/img/product-no-image.png';
            }

            echo '<img src="' . $_url . '" class="img-responsive img-thumbnail" />';

        ?>
        </div>
        <div class="col-xs-9">
            <p>
                <strong><?=$product->label?></strong> / <?=$variant->label?>
            </p>
            <hr />
            <?php

            if (empty($successfully_added)) {

                ?>
                <p>
                    To be informed when this item is back in stock, please leave
                    your email below.
                </p>
                <p>
                    We'll only use this address for the purposes
                    of informing you of the availability of stock for this particular
                    item and will remove it once we've informed you.
                </p>
                <?php

            } else {

                ?>
                <div class="alert alert-success">
                    <p>
                        <strong>Success!</strong> You were added to the notification list successfully!
                    </p>
                </div>
                <p>
                    If you wish to add another person or email address to the notification
                    list, you can do so using the form below.
                </p>
                <?php
            }

            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <hr />
            <?php

                $_get = $this->input->get('isFancybox') ? '?isFancybox=1' : '';

                echo form_open(uri_string() . $_get);

                    ?>
                    <div class="well well-sm">
                        <?=form_email('email', active_user('email'), 'class="form-control" placeholder="Your email address"')?>
                    </div>
                    <p class="text-center">
                        <button type="submit" class="btn btn-success btn-lg">
                            Notify Me
                        </button>
                    </p>
                    <?php

                echo form_close();

            ?>
        </div>
    </div>
    <?php

    if ($this->input->get('isFancybox')) {

        echo '</div>';
    }

?>