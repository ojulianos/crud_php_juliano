<?php

if(!function_exists('selected')) {
    function selected($current, $selected) {
        if($current == $selected) {
            return 'selected';
        }
        return '';
    }
}