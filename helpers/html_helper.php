<?php

if(!function_exists('html_escape')) {
    function html_escape($input) {
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }
}