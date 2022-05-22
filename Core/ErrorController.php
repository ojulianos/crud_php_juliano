<?php

namespace Core;

class ErrorController
{
    public function index($type, $return)
    {
        // load views
        require APP . 'Views/_templates/header.phtml';
        require APP . 'Views/error/index.phtml';
        require APP . 'Views/_templates/footer.phtml';
    }
}