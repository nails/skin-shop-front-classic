<div class="product-sort panel panel-default">
    <div class="mask">
        <span class="glyphicon glyphicon-refresh spin"></span>
    </div>
    <div class="panel-body small">
    <?php

        //  Build the URL, remove any pagination malarky
        $url = site_url(preg_replace('#/\\d+$#', '', uri_string()));

        echo form_open($url, 'method="GET"');

            //  Maintain any other get params
            $get = array_filter((array) $this->input->get());

            unset($get['per_page']);
            unset($get['sort']);

            $get = http_build_query($get);
            $get = explode('&', $get);

            foreach ($get as $param) {

                $param = explode('=', $param);

                if (count($param) == 2) {

                    echo form_hidden(urldecode($param[0]), urldecode($param[1]));
                }
            }

            // --------------------------------------------------------------------------

            echo '<div class="pull-left">';

                $options        = array();
                $options['20']  = '20 items';
                $options['40']  = '40 items';
                $options['80']  = '80 items';
                $options['100'] = '100 items';
                $options['all'] = 'All items';

                $selected = $product_pagination->per_page == '10000' ? 'all' : $product_pagination->per_page;

                echo form_dropdown('per_page', $options, $selected);

            echo '</div>';

            echo '<div class="pull-right">';

                echo 'Sort &nbsp;&nbsp;';

                $options                    = array();
                $options['recent']          = 'Recently Added';
                $options['price-low-high']  = 'Price: Low to High';
                $options['price-high-low']  = 'Price: High to Low';
                $options['a-z']         = 'A to Z';

                echo form_dropdown('sort', $options, $product_sort->sort);

                echo '<noscript>';
                    echo '<button type="submit" class="btn btn-primary btn-xs" style="margin-left:0.5em">';
                        echo 'Apply';
                    echo '</button>';
                echo '</noscript>';

            echo '</div>';

        echo form_close();
    ?>
    </div>
</div>