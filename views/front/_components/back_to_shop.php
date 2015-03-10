<?php

    if (!empty($goBackUrl)) {

    	echo '<div class="col-xs-12">';
	        echo '<ol class="breadcrumb">';
	            echo '<li class="crumb home">';
	                echo '<span class="fa fa-angle-left text-muted"></span>';
	                echo '<a href="' . $goBackUrl . '">Go back</a>';
	            echo '</li>';
        	echo '</ol>';
        echo '</div>';
    }
