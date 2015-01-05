<div class="product-browser row">
    <div class="col-xs-12">
    <?php

        if (!empty($products)) {

            $productsPerRow = array();
            $class          = array();
            $counter        = 0;
            $rowOpen       = FALSE;

            $productsPerRow['lg'] = 4;
            $productsPerRow['md'] = 4;
            $productsPerRow['sm'] = 2;
            $productsPerRow['xs'] = 1;

            foreach ($productsPerRow as $breakpoint => $value) {

                $class[] = 'col-' . $breakpoint . '-' . floor(APP_BOOTSTRAP_GRID / $value);
            }

            // --------------------------------------------------------------------------

            $this->load->view($skin_front->path . 'views/front/_components/browse_sorter');

            // --------------------------------------------------------------------------

            foreach ($products as $product) {

                if (empty($rowOpen)) {

                    $rowOpen = TRUE;
                    echo '<div class="row">';
                }

                echo '<div class="product ' . implode(' ', $class) . '">';

                    $this->load->view($skin_front->path . 'views/front/_components/browse_products_single', array('product' => $product));

                echo '</div>';


                if ($counter % $productsPerRow['lg'] == $productsPerRow['lg'] - 1) {

                    $rowOpen = FALSE;
                    echo '</div>';
                }

                $counter++;
            }

            if (!empty($rowOpen)) {

                $rowOpen = FALSE;
                echo '</div>';
            }

            // --------------------------------------------------------------------------

            echo '<hr />';
            $this->load->view($skin_front->path . 'views/front/_components/browse_sorter');
            $this->load->view($skin_front->path . 'views/front/_components/browse_pagination');

        } else {

            echo '<p class="alert alert-warning">';

                if ($this->input->get('s')) {

                    echo '<strong>Sorry,</strong> no products were found for "' . $this->input->get('s') . '".';

                } else {

                    echo '<strong>Sorry,</strong> no products were found.';
                }

            echo '</p>';
        }

    ?>
    </div>
</div>