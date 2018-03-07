<div class="product-browser row">
    <div class="col-xs-12">
    <?php

        if (!empty($products)) {

            $productsPerRow = array();
            $class          = array();
            $counter        = 0;
            $rowOpen        = false;

            $productsPerRow['lg'] = 4;
            $productsPerRow['md'] = 4;
            $productsPerRow['sm'] = 2;
            $productsPerRow['xs'] = 2;

            foreach ($productsPerRow as $breakpoint => $value) {

                $class[] = 'col-' . $breakpoint . '-' . floor(12 / $value);
            }

            // --------------------------------------------------------------------------

            $this->load->view($skin->path . 'views/front/_components/browse_sorter');

            // --------------------------------------------------------------------------

            foreach ($products as $product) {

                if (empty($rowOpen)) {

                    $rowOpen = true;
                    echo '<div class="row">';
                }

                echo '<div class="product ' . implode(' ', $class) . '">';

                    $this->load->view($skin->path . 'views/front/_components/browse_products_single', array('product' => $product));

                echo '</div>';


                if ($counter % $productsPerRow['lg'] == $productsPerRow['lg'] - 1) {

                    $rowOpen = false;
                    echo '</div>';
                }

                $counter++;
            }

            if (!empty($rowOpen)) {

                $rowOpen = false;
                echo '</div>';
            }

            // --------------------------------------------------------------------------

            echo '<hr />';
            $this->load->view($skin->path . 'views/front/_components/browse_sorter');
            $this->load->view($skin->path . 'views/front/_components/browse_pagination');

        } else {

            echo '<p class="alert alert-warning">';

                if ($this->input->get('s')) {

                    echo 'Sorry, no products were found for "' . $this->input->get('s') . '".';

                } else {

                    echo 'Sorry, no products were found.';
                }

            echo '</p>';
        }

    ?>
    </div>
</div>