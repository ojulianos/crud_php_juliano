<?php

if (!function_exists('asset')) {
    function asset($filename = '')
    {
        return URL . 'assets/' . $filename;
    }
}

if(!function_exists('add_js')) {
    function add_js($input_file) {
        if(!is_array($input_file)){
            echo '<script src="'.asset($input_file).'"></script>';
            return;
        }
        
        foreach($input_file as $js_file){
            echo '<script src="'.asset($js_file).'"></script>';
        }
    }
}

if(!function_exists('add_css')) {
    function add_css($input_file) {
        if(!is_array($input_file)){
            echo '<link href="'.asset($input_file).'" rel="stylesheet">';
            return;
        }
        
        foreach($input_file as $css_file){
            echo '<link href="'.asset($css_file).'" rel="stylesheet">';
        }
    }
}