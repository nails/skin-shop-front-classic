<div class="row cover tag hidden-xs visible-sm visible-md visible-lg">
    <div class="col-xs-12">
        <?php

            if (!empty($tag->cover_id)) {

                $url    = cdnScale($tag->cover_id, 1000, 500);
                $style  = 'style="background-image:url(' . $url . ');background-size:cover;"';

            } else {

                $style = '';
            }

            echo '<div class="background tag" ' . $style . '>';
                echo '<div class="overlay">';
                    echo '<h1>' . $tag->label . '</h1>';
                echo '</div>';
            echo '</div>';

            // --------------------------------------------------------------------------

            //  Prepare the breadcrumbs
            $crumbs   = array();
            $crumbs[] = array(
                'id'    => null,
                'label' => 'Tags',
                'url'   => app_setting('page_tag_listing', 'shop') ? $shop_url . 'tag' : null
            );

            $crumbs[] = array(
                'id'    => $tag->id,
                'label' => $tag->label,
                'url'   => $tag->url
            );

            $view = $skin->path . 'views/front/_components/browse_breadcrumb';
            $data = array('crumbs' => $crumbs, 'active_id' => $tag->id);
            $this->load->view($view, $data);

            // --------------------------------------------------------------------------

            if (trim(strip_tags($tag->description))) {

                echo '<div class="description">';
                    echo $tag->description;
                echo '</div>';
            }

        ?>
    </div>
</div>