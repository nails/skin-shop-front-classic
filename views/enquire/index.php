<?php

    if ($this->input->get('is_fancybox')) {

        echo '<style type="text/css">';
            echo 'body,html { background:transparent; }';
        echo '</style>';
        echo '<div class="container">';
    }

    ?>
    <div class="row">
        <?php

            if ($variant) {

                echo '<div class="col-xs-3">';

                    if ($variant->featured_img) {

                        $url = cdn_thumb($variant->featured_img, 800, 800);

                    } elseif ($product->featured_img) {

                        $url = cdn_thumb($product->featured_img, 800, 800);

                    } else {

                        $url = $skin->url . 'assets/img/product-no-image.png';
                    }

                    echo '<img src="' . $url . '" class="img-responsive img-thumbnail" />';

                echo '</div>';
                echo '<div class="col-xs-9">';

            } else {

                echo '<div class="col-md-12">';
            }

            echo '<p>';
                echo '<strong>' . $product->label . '</strong>';
            echo '</p>';
            echo '<p>';
                echo 'Complete the form below as fully as you can and one of the team will get back in touch to discuss your delivery options. Your details will only be used for the purposes of contacting you with regards this item.';
            echo '</p>';

            echo '<hr />';

            if ($this->input->get('is_fancybox') && !empty($error)) {

                echo '<p class="alert alert-danger">';
                    echo $error;
                echo '</p>';
            }

            ?>
            <div class="row">
                <div class="col-xs-12">
                    <?php

                        if (!empty($success)) {

                            echo '<p class="alert alert-success">';
                                echo '<strong>Success!</strong> Your enquiry was received successfully.';
                            echo '</p>';
                            echo '<p>';
                                echo 'Thank you for your enquiry, we will get back to you as soon as we can.';
                            echo '</p>';

                        } else {

                            $get = $this->input->get('is_fancybox') ? '?is_fancybox=1' : '';

                            echo form_open(uri_string() . $get);

                                ?>
                                <div class="well well-sm">
                                    <div class="form-horizontal">
                                        <?php

                                            echo form_hidden('product_id', $product->id);

                                            $options = array();
                                            foreach ($product->variations as $v) {

                                                if ($v->shipping->collection_only) {

                                                    $options[$v->id] = $v->label;
                                                }
                                            }

                                            echo' <div class="form-group">';
                                                echo' <label class="col-xs-3 control-label">Item*</label>';
                                                echo' <div class="col-xs-9">';
                                                    echo' <select name="variant_id" class="form-control">';

                                                        foreach ($options as $v_id => $v_label) {

                                                            echo '<option value="' . $v_id . '">';
                                                                echo $v_label;
                                                            echo '</option>';
                                                        }

                                                    echo '</select>';
                                                echo '</div>';
                                            echo '</div>';

                                        ?>
                                        <div class="form-group <?=form_error('name') ? 'has-error' : ''?>">
                                            <label class="col-xs-3 control-label">Name*</label>
                                            <div class="col-xs-9">
                                                <input name="name" type="text" class="form-control" placeholder="Your name" value="<?=set_value('name', active_user('first_name,last_name'))?>">
                                                <?=form_error('name', '<p class="help-block">', '</p>')?>
                                            </div>
                                        </div>
                                        <div class="form-group <?=form_error('email') ? 'has-error' : ''?>">
                                            <label class="col-xs-3 control-label">Email*</label>
                                            <div class="col-xs-9">
                                                <input name="email" type="email" class="form-control" placeholder="Email" value="<?=set_value('email', active_user('email'))?>">
                                                <?=form_error('email', '<p class="help-block">', '</p>')?>
                                            </div>
                                        </div>
                                        <div class="form-group <?=form_error('telephone') ? 'has-error' : ''?>">
                                            <label class="col-xs-3 control-label">Telephone</label>
                                            <div class="col-xs-9">
                                                <input name="telephone" type="text" class="form-control" placeholder="Your telephone number" value="<?=set_value('telephone')?>">
                                                <?=form_error('telephone', '<p class="help-block">', '</p>')?>
                                            </div>
                                        </div>
                                        <div class="form-group <?=form_error('address') ? 'has-error' : ''?>">
                                            <label class="col-xs-3 control-label">Address*</label>
                                            <div class="col-xs-9">
                                                <textarea name="address" type="text" class="form-control" placeholder="Your address (including postcode)"><?=set_value('address')?></textarea>
                                                <?=form_error('address', '<p class="help-block">', '</p>')?>
                                            </div>
                                        </div>
                                        <div class="form-group <?=form_error('notes') ? 'has-error' : ''?>">
                                            <label class="col-xs-3 control-label">Notes</label>
                                            <div class="col-xs-9">
                                                <textarea name="notes" type="text" class="form-control" placeholder="Any details about delivery we should know about (e.g stairs)"><?=set_value('notes')?></textarea>
                                                <?=form_error('notes', '<p class="help-block">', '</p>')?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-center">
                                    <button type="submit" class="btn btn-success btn-lg">
                                        Send Enquiry
                                    </button>
                                </p>
                                <?php

                            echo form_close();
                        }

                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php

    if ($this->input->get('is_fancybox')) {

        echo '</div>';
    }

?>