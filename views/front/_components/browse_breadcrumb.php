<?php

    echo '<ol class="breadcrumb">';

        echo '<li class="crumb home">';
            echo '<span class="fa fa-home text-muted"></span>';
            echo anchor($shop_url, $shop_name);
        echo '</li>';

        if (!empty($crumbs)) {

            foreach ($crumbs as $crumb) {

                echo '<li class="crumb">';

                    if ($crumb['id'] == $active_id) {

                        echo $crumb['label'];

                    } else {

                        echo anchor($crumb['url'], $crumb['label']);
                    }

                echo '</li>';
            }
        }

    echo '</ol>';