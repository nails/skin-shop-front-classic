<div class="row cover category hidden-xs visible-sm visible-md visible-lg">
    <div class="col-xs-12">
        <?php

            if (!empty($category->cover_id)) {

                $url    = cdn_scale($category->cover_id, 1000, 500);
                $style  = 'style="background-image:url(' . $url . ');background-size:cover;"';

            } else {

                $style = '';
            }

            echo '<div class="background category" ' . $style . '>';
                echo '<div class="overlay">';
                    echo '<h1>' . $category->label . '</h1>';
                echo '</div>';
            echo '</div>';

            // --------------------------------------------------------------------------

            //  Prepare the breadcrumbs
            $crumbs = array();

            foreach ($category->breadcrumbs as $crumb) {

                $crumbs[] = array(
                    'id'    => $crumb->id,
                    'label' => $crumb->label,
                    'url'   => $this->shop_category_model->format_url($crumb->slug)
                );
            }

            $view = $skin->path . 'views/front/_components/browse_breadcrumb';
            $data = array('crumbs' => $crumbs, 'active_id' => $category->id);
            $this->load->view($view, $data);

            // --------------------------------------------------------------------------

            if (trim(strip_tags($category->description))) {

                echo '<div class="description">';
                    echo $category->description;
                echo '</div>';
            }

        ?>
    </div>
</div>